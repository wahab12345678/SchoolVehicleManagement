<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:191'],
            'email' => ['required', 'email', 'max:191'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        $contact = Contact::create($data);

        // Queue a mailable for admins/notify
        try {
            $admin = env('MAIL_ADMIN');
            if ($admin) {
                Mail::to($admin)->queue(new ContactMail($contact));
            } else {
                // fallback: queue without explicit recipient (uses Mailable defaults)
                Mail::queue(new ContactMail($contact));
            }
        } catch (\Throwable $e) {
            // don't block creation if mail fails; log if needed
            logger()->error('Failed to queue ContactMail: ' . $e->getMessage());
        }

        return response()->json([
            'ok' => true,
            'id' => $contact->id,
        ], 201);
    }
}
