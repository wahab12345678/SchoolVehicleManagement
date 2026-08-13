<?php

namespace App\Services;

use App\Models\Trip;
use Illuminate\Support\Facades\Log;

class TripNotificationService
{
    public function __construct(private FcmPushService $fcm)
    {
    }

    public function notifyPickupStarted(Trip $trip): void
    {
        if ($trip->notified_pickup_at) {
            return;
        }

        $studentName = $trip->student?->name ?? 'your child';
        $driverName = $trip->driver?->name ?? 'Driver';

        $this->notifyGuardian(
            $trip,
            'Driver is on the way',
            "{$driverName} is on the way to pick up {$studentName}.",
            'pickup_started'
        );

        $trip->forceFill(['notified_pickup_at' => now()])->saveQuietly();
    }

    public function notifyArrived(Trip $trip): void
    {
        if ($trip->notified_arrived_at) {
            return;
        }

        $studentName = $trip->student?->name ?? 'your child';
        $driverName = $trip->driver?->name ?? 'Driver';

        $this->notifyGuardian(
            $trip,
            'Driver has arrived',
            "{$driverName} has arrived outside for {$studentName}.",
            'arrived'
        );

        $trip->forceFill(['notified_arrived_at' => now()])->saveQuietly();
    }

    public function notifyBoarded(Trip $trip): void
    {
        if ($trip->notified_boarded_at) {
            return;
        }

        $studentName = $trip->student?->name ?? 'your child';

        $this->notifyGuardian(
            $trip,
            'Trip started',
            "{$studentName} is on the way. You can track live location now.",
            'boarded'
        );

        $trip->forceFill(['notified_boarded_at' => now()])->saveQuietly();
    }

    public function notifyCompleted(Trip $trip): void
    {
        if ($trip->notified_completed_at) {
            return;
        }

        $studentName = $trip->student?->name ?? 'your child';

        $this->notifyGuardian(
            $trip,
            'Trip completed',
            "{$studentName} has reached school safely. Trip completed.",
            'completed'
        );

        $trip->forceFill(['notified_completed_at' => now()])->saveQuietly();
    }

    private function notifyGuardian(Trip $trip, string $title, string $body, string $event): void
    {
        $trip->loadMissing(['student.guardian.user', 'driver']);

        $guardianUser = $trip->student?->guardian?->user;

        if (!$guardianUser) {
            Log::warning('Trip notification skipped: no guardian user', [
                'trip_id' => $trip->id,
                'event' => $event,
            ]);
            return;
        }

        $data = [
            'type' => 'trip_status',
            'event' => $event,
            'trip_id' => (string) $trip->id,
            'student_id' => (string) $trip->student_id,
            'status' => (string) $trip->status,
        ];

        Log::info('Trip notification', [
            'trip_id' => $trip->id,
            'guardian_user_id' => $guardianUser->id,
            'title' => $title,
            'body' => $body,
            'data' => $data,
        ]);

        $this->fcm->sendToUser($guardianUser, $title, $body, $data);
    }
}
