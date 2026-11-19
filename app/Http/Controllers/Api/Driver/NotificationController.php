<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\Controller;
use App\Models\GuardianDriverMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * List incoming guardian notifications/messages for the driver.
     */
    public function index(Request $request): JsonResponse
    {
        $driver = $request->user();

        $query = GuardianDriverMessage::with(['guardianUser', 'student'])
            ->where('driver_id', $driver->id)
            ->orderByDesc('id');

        $unreadCount = GuardianDriverMessage::where('driver_id', $driver->id)
            ->unread()
            ->count();

        $notifications = $query->limit(50)->get()->map(function (GuardianDriverMessage $msg) {
            return $this->formatNotification($msg);
        });

        return response()->json([
            'success' => true,
            'unread_count' => $unreadCount,
            'total_count' => $notifications->count(),
            'data' => $notifications,
        ]);
    }

    /**
     * Mark a single notification as read.
     */
    public function markAsRead(Request $request, $id): JsonResponse
    {
        $driver = $request->user();

        $message = GuardianDriverMessage::where('driver_id', $driver->id)
            ->where('id', $id)
            ->firstOrFail();

        if (!$message->is_read) {
            $message->is_read = true;
            $message->read_at = now();
            $message->save();
        }

        $unreadCount = GuardianDriverMessage::where('driver_id', $driver->id)
            ->unread()
            ->count();

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read',
            'unread_count' => $unreadCount,
            'data' => $this->formatNotification($message),
        ]);
    }

    /**
     * Mark all notifications as read for this driver.
     */
    public function markAllRead(Request $request): JsonResponse
    {
        $driver = $request->user();

        GuardianDriverMessage::where('driver_id', $driver->id)
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read',
            'unread_count' => 0,
        ]);
    }

    /**
     * Driver acknowledges the guardian's request.
     */
    public function acknowledge(Request $request, $id): JsonResponse
    {
        $driver = $request->user();

        $message = GuardianDriverMessage::where('driver_id', $driver->id)
            ->where('id', $id)
            ->firstOrFail();

        $message->is_read = true;
        $message->read_at = $message->read_at ?? now();
        $message->status = 'acknowledged';
        $message->save();

        $unreadCount = GuardianDriverMessage::where('driver_id', $driver->id)
            ->unread()
            ->count();

        return response()->json([
            'success' => true,
            'message' => 'Request acknowledged',
            'unread_count' => $unreadCount,
            'data' => $this->formatNotification($message),
        ]);
    }

    protected function formatNotification(GuardianDriverMessage $msg): array
    {
        return [
            'id' => $msg->id,
            'type' => $msg->type,
            'title' => $msg->title,
            'message' => $msg->message,
            'is_read' => (bool) $msg->is_read,
            'read_at' => $msg->read_at?->toIso8601String(),
            'status' => $msg->status,
            'created_at' => $msg->created_at?->toIso8601String(),
            'formatted_time' => $msg->created_at?->diffForHumans(),
            'guardian' => $msg->guardianUser ? [
                'id' => $msg->guardianUser->id,
                'name' => $msg->guardianUser->name,
                'phone' => $msg->guardianUser->phone,
                'email' => $msg->guardianUser->email,
            ] : null,
            'student' => $msg->student ? [
                'id' => $msg->student->id,
                'name' => $msg->student->name,
                'roll_number' => $msg->student->roll_number,
                'class' => $msg->student->class,
            ] : null,
        ];
    }
}
