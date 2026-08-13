<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Support role:guardian|parent style via comma or pipe in route definition
        $normalized = [];
        foreach ($roles as $role) {
            foreach (preg_split('/[|,]/', $role) as $part) {
                $part = trim($part);
                if ($part !== '') {
                    $normalized[] = $part;
                }
            }
        }

        if (!$user->hasAnyRole($normalized)) {
            return response()->json(['message' => 'Forbidden. Required role: ' . implode('|', $normalized)], 403);
        }

        return $next($request);
    }
}
