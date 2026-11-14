<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class GeocodeSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_place_search_uses_google_places_and_returns_coordinates(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        config(['services.google_maps.api_key' => 'test-google-key']);

        Http::fake([
            'https://places.googleapis.com/v1/places:searchText' => Http::response([
                'places' => [[
                    'displayName' => ['text' => 'University of Central Punjab'],
                    'formattedAddress' => 'Khayaban-e-Jinnah, Lahore, Pakistan',
                    'location' => ['latitude' => 31.456, 'longitude' => 74.267],
                ]],
            ]),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.geocode.search', [
            'q' => 'University of Central Punjab',
        ]), ['Accept' => 'application/json']);

        $response->assertOk()->assertJsonPath('data.0.label', 'University of Central Punjab — Khayaban-e-Jinnah, Lahore, Pakistan')
            ->assertJsonPath('data.0.latitude', 31.456)
            ->assertJsonPath('data.0.longitude', 74.267);

        Http::assertSent(fn ($request) =>
            $request->url() === 'https://places.googleapis.com/v1/places:searchText'
            && $request['textQuery'] === 'University of Central Punjab'
            && $request->hasHeader('X-Goog-Api-Key', 'test-google-key')
        );
    }

    public function test_admin_can_search_places_without_a_google_api_key(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        config(['services.google_maps.api_key' => null]);

        Http::fake([
            'https://photon.komoot.io/api/*' => Http::response([
                'features' => [[
                    'properties' => [
                        'name' => 'University of Central Punjab',
                        'street' => 'Jinnah Avenue',
                        'county' => 'Lahore District',
                        'country' => 'Pakistan',
                        'countrycode' => 'PK',
                    ],
                    'geometry' => [
                        'coordinates' => [74.268077, 31.4472954],
                    ],
                ]],
            ]),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.geocode.search', [
            'q' => 'University of Central Punjab',
        ]), ['Accept' => 'application/json']);

        $response->assertOk()
            ->assertJsonPath('data.0.label', 'University of Central Punjab — Jinnah Avenue, Lahore District, Pakistan')
            ->assertJsonPath('data.0.latitude', 31.4472954)
            ->assertJsonPath('data.0.longitude', 74.268077);

        Http::assertSent(fn ($request) =>
            str_starts_with($request->url(), 'https://photon.komoot.io/api/')
            && $request['q'] === 'University of Central Punjab'
        );
    }

    public function test_admin_can_paste_google_maps_directions_link_to_set_destination_pin(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        Http::fake();

        $url = 'https://www.google.com/maps/dir//The+padel+yard,+512-+D+block+PIA+Main+Boulevard,+Johar+Town,+Lahore,+Pakistan/@22.0152725,96.1633051,15z/data=!4m8!4m7!1m0!1m5!1m1!1s0x39190113060fd357:0x8fe5e18737144383!2m2!1d74.2897296!2d31.455854';
        $response = $this->actingAs($admin)->get(route('admin.geocode.search', [
            'q' => $url,
        ]), ['Accept' => 'application/json']);

        $response->assertOk()
            ->assertJsonPath('data.0.label', 'The padel yard, 512- D block PIA Main Boulevard, Johar Town, Lahore, Pakistan')
            ->assertJsonPath('data.0.latitude', 31.455854)
            ->assertJsonPath('data.0.longitude', 74.2897296);

        Http::assertNothingSent();
    }
}