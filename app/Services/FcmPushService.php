<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FcmPushService
{
    public function sendToUser(User $user, string $title, string $body, array $data = []): int
    {
        $tokens = $user->deviceTokens()->pluck('token')->filter()->values();

        if ($tokens->isEmpty()) {
            Log::info('FCM skipped: no device tokens', [
                'user_id' => $user->id,
                'title' => $title,
            ]);
            return 0;
        }

        $sent = 0;
        foreach ($tokens as $token) {
            if ($this->sendToToken($token, $title, $body, $data)) {
                $sent++;
            }
        }

        return $sent;
    }

    public function sendToToken(string $token, string $title, string $body, array $data = []): bool
    {
        $serverKey = config('services.fcm.server_key');

        if (!$serverKey) {
            Log::info('FCM not configured; notification logged only', [
                'title' => $title,
                'body' => $body,
                'data' => $data,
                'token_preview' => substr($token, 0, 12) . '...',
            ]);
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'key=' . $serverKey,
                'Content-Type' => 'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', [
                'to' => $token,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                    'sound' => 'default',
                ],
                'data' => array_merge($data, [
                    'title' => $title,
                    'body' => $body,
                ]),
                'priority' => 'high',
            ]);

            if (!$response->successful()) {
                Log::warning('FCM send failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return false;
            }

            $json = $response->json();
            if (($json['failure'] ?? 0) > 0) {
                Log::warning('FCM delivery failure', ['response' => $json]);
                // Drop invalid tokens so future sends stay clean
                $results = $json['results'] ?? [];
                foreach ($results as $result) {
                    if (!empty($result['error']) && in_array($result['error'], ['NotRegistered', 'InvalidRegistration'], true)) {
                        \App\Models\DeviceToken::where('token', $token)->delete();
                    }
                }
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            Log::error('FCM exception: ' . $e->getMessage());
            return false;
        }
    }
}
