<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocodeController extends Controller
{
    /** Prefer Lahore area results (left, top, right, bottom). */
    private const LAHORE_VIEWBOX = '74.10,31.72,74.55,31.30';

    public function search(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        if (strlen($q) < 3) {
            return response()->json(['data' => []]);
        }

        // Bias search to Pakistan / Lahore so USA results don't appear.
        $searchQuery = $this->localizeQuery($q);

        try {
            $results = $this->nominatimSearch($searchQuery, true);

            // If nothing in Lahore viewbox, still search Pakistan-wide.
            if ($results->isEmpty()) {
                $results = $this->nominatimSearch($searchQuery, false);
            }

            // Last fallback: area keywords only (city/locality).
            if ($results->isEmpty()) {
                $parts = preg_split('/\s+/', $q) ?: [];
                if (count($parts) > 1) {
                    $fallback = implode(' ', array_slice($parts, -2)) . ' Lahore Pakistan';
                    $results = $this->nominatimSearch($fallback, true);
                    if ($results->isEmpty()) {
                        $results = $this->nominatimSearch($fallback, false);
                    }
                }
            }

            return response()->json(['data' => $results->values()]);
        } catch (\Throwable $e) {
            Log::error('Geocode search exception: ' . $e->getMessage());

            return response()->json([
                'message' => 'Place search error: ' . $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }

    private function localizeQuery(string $q): string
    {
        $lower = mb_strtolower($q);

        if (!str_contains($lower, 'pakistan') && !str_contains($lower, 'lahore')) {
            return $q . ' Lahore Pakistan';
        }

        if (!str_contains($lower, 'pakistan')) {
            return $q . ' Pakistan';
        }

        return $q;
    }

    private function nominatimSearch(string $q, bool $preferLahore)
    {
        $params = [
            'q' => $q,
            'format' => 'json',
            'addressdetails' => 1,
            'limit' => 8,
            'countrycodes' => 'pk', // Pakistan only
        ];

        if ($preferLahore) {
            $params['viewbox'] = self::LAHORE_VIEWBOX;
            $params['bounded'] = 0; // prefer Lahore, don't hard-block outside
        }

        // XAMPP/Windows often lacks CA certs → cURL error 60 without this.
        $response = Http::timeout(20)
            ->withoutVerifying()
            ->withHeaders([
                'User-Agent' => 'SchoolVehicleManagement/1.0 (admin-map-picker)',
                'Accept' => 'application/json',
            ])
            ->get('https://nominatim.openstreetmap.org/search', $params);

        if (!$response->successful()) {
            Log::warning('Nominatim search failed', [
                'status' => $response->status(),
                'q' => $q,
            ]);

            return collect();
        }

        return collect($response->json() ?? [])
            ->map(function ($item) {
                $countryCode = strtolower((string) data_get($item, 'address.country_code', ''));

                return [
                    'label' => $item['display_name'] ?? '',
                    'latitude' => isset($item['lat']) ? (float) $item['lat'] : null,
                    'longitude' => isset($item['lon']) ? (float) $item['lon'] : null,
                    'type' => $item['type'] ?? null,
                    'country_code' => $countryCode,
                ];
            })
            ->filter(function ($item) {
                if ($item['latitude'] === null || $item['longitude'] === null || $item['label'] === '') {
                    return false;
                }
                // Extra safety: drop non-Pakistan if country present
                if ($item['country_code'] !== '' && $item['country_code'] !== 'pk') {
                    return false;
                }

                return true;
            })
            ->map(function ($item) {
                unset($item['country_code']);

                return $item;
            })
            ->values();
    }
}
