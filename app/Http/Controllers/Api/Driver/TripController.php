<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TripResource;
use App\Models\Trip;
use App\Models\TripLocation;
use App\Services\TripNotificationService;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function __construct(private TripNotificationService $notifier)
    {
    }

    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Trip::with(['student', 'vehicle', 'route', 'driver'])
            ->where('driver_id', $request->user()->id)
            ->latest();

        if ($status === 'active') {
            $query->active();
        } elseif ($status) {
            $query->where('status', $status);
        }

        return TripResource::collection($query->paginate(20));
    }

    public function show(Request $request, Trip $trip)
    {
        $this->authorizeDriver($request, $trip);

        $trip->load(['student', 'vehicle', 'route', 'driver', 'locations' => function ($q) {
            $q->latest('recorded_at')->limit(1);
        }]);

        return new TripResource($trip);
    }

    public function startPickup(Request $request, Trip $trip)
    {
        $this->authorizeDriver($request, $trip);

        if ($trip->status !== 'pending') {
            return $this->invalidTransition($trip, 'pending');
        }

        $trip->update([
            'status' => 'en_route',
            'pickup_started_at' => now(),
        ]);

        $this->notifier->notifyPickupStarted($trip->fresh(['student.guardian.user', 'driver']));

        return response()->json([
            'message' => 'Pickup started. Guardian notified: driver is on the way.',
            'data' => new TripResource($trip->fresh(['student', 'vehicle', 'route', 'driver'])),
        ]);
    }

    public function arrive(Request $request, Trip $trip)
    {
        $this->authorizeDriver($request, $trip);

        if (!in_array($trip->status, ['en_route', 'pending'], true)) {
            return $this->invalidTransition($trip, 'en_route');
        }

        $trip->update([
            'status' => 'arrived',
            'pickup_started_at' => $trip->pickup_started_at ?? now(),
            'arrived_at' => now(),
        ]);

        $this->notifier->notifyArrived($trip->fresh(['student.guardian.user', 'driver']));

        return response()->json([
            'message' => 'Marked arrived. Guardian notified.',
            'data' => new TripResource($trip->fresh(['student', 'vehicle', 'route', 'driver'])),
        ]);
    }

    public function board(Request $request, Trip $trip)
    {
        $this->authorizeDriver($request, $trip);

        if (!in_array($trip->status, ['arrived', 'en_route'], true)) {
            return $this->invalidTransition($trip, 'arrived');
        }

        $now = now();
        $trip->update([
            'status' => 'in_progress',
            'boarded_at' => $now,
            'started_at' => $trip->started_at ?? $now,
            'pickup_started_at' => $trip->pickup_started_at ?? $now,
        ]);

        $this->notifier->notifyBoarded($trip->fresh(['student.guardian.user', 'driver']));

        return response()->json([
            'message' => 'Student boarded. Live tracking started.',
            'data' => new TripResource($trip->fresh(['student', 'vehicle', 'route', 'driver'])),
        ]);
    }

    public function complete(Request $request, Trip $trip)
    {
        $this->authorizeDriver($request, $trip);

        if (!in_array($trip->status, ['in_progress', 'arrived', 'en_route'], true)) {
            return $this->invalidTransition($trip, 'in_progress');
        }

        $trip->update([
            'status' => 'completed',
            'ended_at' => now(),
            'started_at' => $trip->started_at ?? $trip->boarded_at ?? now(),
        ]);

        $this->notifier->notifyCompleted($trip->fresh(['student.guardian.user', 'driver']));

        return response()->json([
            'message' => 'Trip completed.',
            'data' => new TripResource($trip->fresh(['student', 'vehicle', 'route', 'driver'])),
        ]);
    }

    public function storeLocation(Request $request, Trip $trip)
    {
        $this->authorizeDriver($request, $trip);

        if (!in_array($trip->status, ['en_route', 'arrived', 'in_progress'], true)) {
            return response()->json([
                'message' => 'Location can only be sent while trip is active (en_route/arrived/in_progress).',
                'current_status' => $trip->status,
            ], 422);
        }

        $data = $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'accuracy' => 'nullable|numeric|min:0',
            'heading' => 'nullable|numeric|between:0,360',
            'speed' => 'nullable|numeric|min:0',
            'recorded_at' => 'nullable|date',
        ]);

        $location = TripLocation::create([
            'trip_id' => $trip->id,
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'accuracy' => $data['accuracy'] ?? null,
            'heading' => $data['heading'] ?? null,
            'speed' => $data['speed'] ?? null,
            'recorded_at' => $data['recorded_at'] ?? now(),
        ]);

        return response()->json([
            'message' => 'Location saved.',
            'data' => [
                'id' => $location->id,
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
                'accuracy' => $location->accuracy,
                'heading' => $location->heading,
                'speed' => $location->speed,
                'recorded_at' => optional($location->recorded_at)?->toIso8601String(),
            ],
        ], 201);
    }

    private function authorizeDriver(Request $request, Trip $trip): void
    {
        abort_unless($trip->driver_id === $request->user()->id, 403, 'This trip is not assigned to you.');
    }

    private function invalidTransition(Trip $trip, string $expected)
    {
        return response()->json([
            'message' => "Invalid status transition. Expected current status: {$expected}.",
            'current_status' => $trip->status,
        ], 422);
    }
}
