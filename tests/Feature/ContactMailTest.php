<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactMailTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_queues_mailable()
    {
        Mail::fake();

        $payload = [
            'name' => 'Mailer Test',
            'email' => 'mailer@example.com',
            'message' => 'Please notify',
        ];

        $response = $this->postJson(route('contact.store'), $payload);

        $response->assertStatus(201)->assertJson(['ok' => true]);

        $this->assertDatabaseHas('contacts', ['email' => 'mailer@example.com']);

        Mail::assertQueued(ContactMail::class, function ($mail) use ($payload) {
            return $mail->contact->email === $payload['email'];
        });
    }
}
