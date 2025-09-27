<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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

        // Optionally: dispatch notification to admin here (mail/notification)

        return response()->json([
            'ok' => true,
            'id' => $contact->id,
        ], 201);
    }
}
