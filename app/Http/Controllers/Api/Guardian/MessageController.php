<?php

namespace App\Http\Controllers\Api\Guardian;

use App\Http\Controllers\Controller;
use App\Models\GuardianDriverMessage;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Send a message or request from guardian to a driver.
     */
    public function store(Request $request): JsonResponse
    {
        $guardianUser = $request->user();

        $data = $request->validate([
            'driver_id' => 'required|exists:users,id',
            'student_id' => 'nullable|exists:students,id',
            'type' => 'nullable|string|in:message,absence,delay,pickup_request,urgent',
            'title' => 'nullable|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        $driver = User::role('driver')->where('id', $data['driver_id'])->first();
        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => 'The selected recipient is not a valid driver.',
            ], 422);
        }

        $student = null;
        if (!empty($data['student_id'])) {
            $student = Student::find($data['student_id']);
        }

        $type = $data['type'] ?? 'message';
        $defaultTitles = [
            'absence' => 'Absence Notice: ' . ($student ? $student->name : 'Child'),
            'delay' => 'Pickup Delay: ' . ($student ? $student->name : 'Child'),
            'pickup_request' => 'Pickup Request: ' . ($student ? $student->name : 'Child'),
            'urgent' => 'Urgent Request from ' . $guardianUser->name,
            'message' => 'Message from ' . $guardianUser->name,
        ];

        $title = !empty($data['title']) ? $data['title'] : ($defaultTitles[$type] ?? 'Message from Guardian');

        $message = GuardianDriverMessage::create([
            'driver_id' => $driver->id,
            'guardian_user_id' => $guardianUser->id,
            'student_id' => $student?->id,
            'type' => $type,
            'title' => $title,
            'message' => $data['message'],
            'is_read' => false,
            'status' => 'pending',
        ]);

        // Real-time Push Notification to Driver's Mobile Device
        try {
            app(\App\Services\FcmPushService::class)->sendToUser(
                $driver,
                $message->title,
                $message->message,
                [
                    'type' => 'guardian_message',
                    'message_id' => (string) $message->id,
                    'request_type' => $message->type,
                    'guardian_name' => $guardianUser->name,
                    'student_name' => $student?->name ?? '',
                ]
            );
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('FCM driver notification failed: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Message sent to driver successfully',
            'data' => [
                'id' => $message->id,
                'title' => $message->title,
                'type' => $message->type,
                'message' => $message->message,
                'driver_name' => $driver->name,
                'created_at' => $message->created_at->toIso8601String(),
            ],
        ], 201);
    }
}
