<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Contact;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_can_be_created()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Hello there',
        ];

        $response = $this->postJson(route('contact.store'), $payload);

        $response->assertStatus(201)
                 ->assertJson(['ok' => true]);

        $this->assertDatabaseHas('contacts', ['email' => 'john@example.com']);
    }

    public function test_contact_requires_email()
    {
        $payload = [
            'name' => 'Missing Email',
            'message' => 'No email present',
        ];

        $response = $this->postJson(route('contact.store'), $payload);

        $response->assertStatus(422);
    }
}
