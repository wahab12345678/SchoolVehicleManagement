<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Update the authenticated user's profile photo.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function updatePhoto(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'photo' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp,gif',
                'max:5120', // 5MB maximum
            ],
        ], [
            'photo.required' => 'Please select an image file to upload.',
            'photo.image' => 'The uploaded file must be a valid image.',
            'photo.mimes' => 'Profile picture must be a file of type: jpeg, png, jpg, webp, gif.',
            'photo.max' => 'Profile picture must not exceed 5MB in size.',
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            // Delete old avatar if it exists and is stored on the public disk
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Generate a secure, unique filename
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = 'avatar_' . $user->id . '_' . time() . '_' . Str::random(8) . '.' . $extension;

            // Store in the avatars directory on the public disk
            $path = $file->storeAs('avatars', $filename, 'public');

            // Update user record
            $user->avatar = $path;
            $user->save();

            $avatarUrl = $user->avatar_url;

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profile picture updated successfully!',
                    'avatar_url' => $avatarUrl,
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'avatar' => $user->avatar,
                    ],
                ]);
            }

            return back()->with('success', 'Profile picture updated successfully!');
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'No image file was received.',
            ], 422);
        }

        return back()->with('error', 'No image file was received.');
    }

    /**
     * Remove the authenticated user's custom profile photo and revert to default.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function destroyPhoto(Request $request): JsonResponse|RedirectResponse
    {
        $user = Auth::user();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->avatar = null;
        $user->save();

        $defaultUrl = $user->avatar_url;

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile picture removed and reset to default.',
                'avatar_url' => $defaultUrl,
            ]);
        }

        return back()->with('success', 'Profile picture removed successfully.');
    }
}
