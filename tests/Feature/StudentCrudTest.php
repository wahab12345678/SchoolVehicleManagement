<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\User;

class StudentCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_and_show_student()
    {
        $user = User::factory()->create();
        $guardian = Guardian::create(['user_id' => $user->id]);

        // Disable middleware to allow creation without auth during tests
        $this->withoutMiddleware();

        $response = $this->post('/admin/students', [
            'name' => 'Alice',
            'roll_number' => 'R200',
            'class' => '6B',
            'parent_id' => $guardian->id,
        ]);

        $response->assertStatus(302); // redirect in non-ajax

        $student = Student::first();
        $this->assertNotNull($student);

        $json = $this->get('/admin/students/' . $student->id, ['X-Requested-With' => 'XMLHttpRequest']);
        $json->assertStatus(200);
        $json->assertJsonFragment(['name' => 'Alice']);
    }

    public function test_can_update_student()
    {
        $user = User::factory()->create();
        $guardian = Guardian::create(['user_id' => $user->id]);

        $student = Student::create([
            'name' => 'Old Name',
            'roll_number' => 'R300',
            'class' => '7A',
            'parent_id' => $guardian->id,
        ]);

        $this->withoutMiddleware();

        $response = $this->put('/admin/students/' . $student->id, [
            'name' => 'New Name',
            'roll_number' => 'R301',
            'class' => '7B',
            'parent_id' => $guardian->id,
        ], ['X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(200);
        $response->assertJsonFragment(['message' => 'Student updated successfully']);

        $student->refresh();
        $this->assertEquals('New Name', $student->name);
        $this->assertEquals('R301', $student->roll_number);
        $this->assertEquals('7B', $student->class);
    }

    public function test_can_delete_student()
    {
        $user = User::factory()->create();
        $guardian = Guardian::create(['user_id' => $user->id]);

        $student = Student::create([
            'name' => 'To Be Deleted',
            'roll_number' => 'R400',
            'class' => '8A',
            'parent_id' => $guardian->id,
        ]);

        $this->withoutMiddleware();

        $response = $this->delete('/admin/students/' . $student->id, [], ['X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(200);
        $response->assertJsonFragment(['message' => 'Student deleted successfully']);

        $this->assertNull(Student::find($student->id));
    }
}
