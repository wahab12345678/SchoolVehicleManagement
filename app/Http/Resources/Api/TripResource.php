<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $latest = $this->relationLoaded('locations')
            ? $this->locations->sortByDesc('recorded_at')->first()
            : $this->locations()->latest('recorded_at')->first();

        return [
            'id' => $this->id,
            'status' => $this->status,
            'direction' => $this->direction,
            'school_id' => $this->school_id,
            'pickup_started_at' => optional($this->pickup_started_at)?->toIso8601String(),
            'arrived_at' => optional($this->arrived_at)?->toIso8601String(),
            'boarded_at' => optional($this->boarded_at)?->toIso8601String(),
            'started_at' => optional($this->started_at)?->toIso8601String(),
            'ended_at' => optional($this->ended_at)?->toIso8601String(),
            'created_at' => optional($this->created_at)?->toIso8601String(),
            'student' => $this->whenLoaded('student', function () {
                return [
                    'id' => $this->student->id,
                    'name' => $this->student->name,
                    'roll_number' => $this->student->roll_number,
                    'class' => $this->student->class,
                    'latitude' => $this->student->latitude,
                    'longitude' => $this->student->longitude,
                    'school_id' => $this->student->school_id,
                ];
            }),
            'driver' => $this->whenLoaded('driver', function () {
                return [
                    'id' => $this->driver->id,
                    'name' => $this->driver->name,
                    'phone' => $this->driver->phone,
                ];
            }),
            'vehicle' => $this->whenLoaded('vehicle', function () {
                return [
                    'id' => $this->vehicle->id,
                    'number_plate' => $this->vehicle->number_plate,
                    'model' => $this->vehicle->model,
                    'type' => $this->vehicle->type,
                ];
            }),
            'route' => $this->whenLoaded('route', function () {
                return [
                    'id' => $this->route->id,
                    'name' => $this->route->name,
                    'description' => $this->route->description,
                ];
            }),
            'current_location' => $latest ? [
                'latitude' => $latest->latitude,
                'longitude' => $latest->longitude,
                'accuracy' => $latest->accuracy,
                'heading' => $latest->heading,
                'speed' => $latest->speed,
                'recorded_at' => optional($latest->recorded_at)?->toIso8601String(),
            ] : null,
        ];
    }
}
