<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Guardian;
use App\Models\Student;

class GuardianShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guardian_show_includes_associated_students()
    {
        // create a user and guardian
        $user = User::factory()->create();
        $guardian = Guardian::create([
            'user_id' => $user->id,
            'cnic' => '12345-1234567-1',
            'address' => '123 Test St',
        ]);

        // create students that reference guardian via parent_id
        $student = Student::create([
            'name' => 'Test Student',
            'roll_number' => 'R100',
            'class' => '5A',
            'parent_id' => $guardian->id,
        ]);

    // Disable auth/role middleware for this test so the view can be rendered in isolation
    $this->withoutMiddleware();

    // Sanity-check: ensure the guardian relation loads correctly from DB
    $loaded = Guardian::with('user', 'students')->find($guardian->id);
    $this->assertNotNull($loaded, 'Guardian not found after create');
    $this->assertEquals($user->id, $loaded->user_id, 'Guardian user_id mismatch');
    $this->assertCount(1, $loaded->students, 'Expected one student associated with guardian');

    // Inspect array form to ensure relations are present when model is converted
    $arr = $loaded->toArray();
    $this->assertArrayHasKey('id', $arr, 'Guardian array missing id');
    $this->assertArrayHasKey('user', $arr, 'Guardian array missing user relation');
    $this->assertArrayHasKey('students', $arr, 'Guardian array missing students relation');

    // Call the AJAX JSON endpoint so the controller returns JSON rather than rendering full blade layout
    $response = $this->get(route('admin.guardians.show', $guardian->id), ['X-Requested-With' => 'XMLHttpRequest']);

    $response->assertStatus(200);
    $response->assertJsonFragment(['id' => $guardian->id]);
    $response->assertJsonFragment(['name' => $user->name]);
    }
}
