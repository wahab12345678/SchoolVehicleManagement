<?php

namespace Tests\Feature;

use App\Models\Driver;
use App\Models\DriverServiceArea;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class GuardianRiderSearchTest extends TestCase
{
    use RefreshDatabase;

    protected User $guardianUser;
    protected Guardian $guardian;
    protected Student $student;
    protected User $driverUser;
    protected Vehicle $vehicle;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'guardian']);
        Role::firstOrCreate(['name' => 'parent']);
        Role::firstOrCreate(['name' => 'driver']);

        // Create Guardian & Student
        $this->guardianUser = User::factory()->create(['name' => 'Test Guardian']);
        $this->guardianUser->assignRole('guardian');
        $this->guardian = Guardian::create([
            'user_id' => $this->guardianUser->id,
            'cnic' => '12345-1234567-9',
            'address' => 'Johar Town Phase 2, Lahore',
        ]);

        $this->student = Student::create([
            'name' => 'Zayd Khan',
            'roll_number' => 'R-2024-99',
            'class' => 'Grade 6',
            'parent_id' => $this->guardian->id,
        ]);

        // Create Driver & Vehicle
        $this->driverUser = User::factory()->create([
            'name' => 'Tariq Mehmood',
            'phone' => '03001234567',
        ]);
        $this->driverUser->assignRole('driver');

        $this->vehicle = Vehicle::create([
            'number_plate' => 'LHR-2024-55',
            'model' => 'Toyota HiAce 2022',
            'type' => 'van',
            'capacity' => 14,
            'driver_id' => $this->driverUser->id,
            'is_available' => true,
        ]);

        // Create Service Areas
        DriverServiceArea::create([
            'driver_id' => $this->driverUser->id,
            'area_name' => 'Johar Town',
            'city' => 'Lahore',
            'is_active' => true,
        ]);

        DriverServiceArea::create([
            'driver_id' => $this->driverUser->id,
            'area_name' => 'Faisal Town',
            'city' => 'Lahore',
            'is_active' => true,
        ]);
    }

    public function test_guest_cannot_access_find_rider_pages(): void
    {
        $this->get(route('guardian.riders.index'))->assertRedirect(route('login'));
        $this->get(route('guardian.riders.search'))->assertRedirect(route('login'));
        $this->post(route('guardian.riders.assign'))->assertRedirect(route('login'));
    }

    public function test_guardian_can_view_find_rider_index_page(): void
    {
        $response = $this->actingAs($this->guardianUser)->get(route('guardian.riders.index'));

        $response->assertStatus(200);
        $response->assertSee('Find a Rider / Driver');
        $response->assertSee('Tariq Mehmood');
        $response->assertSee('Johar Town');
        $response->assertSee('LHR-2024-55');
        $response->assertSee('14 Seats');
        $response->assertSee('Zayd Khan');
    }

    public function test_guardian_can_search_riders_by_area_via_ajax(): void
    {
        // Another driver in different area
        $otherDriver = User::factory()->create(['name' => 'Farhan Qureshi']);
        $otherDriver->assignRole('driver');
        DriverServiceArea::create([
            'driver_id' => $otherDriver->id,
            'area_name' => 'DHA Phase 6',
            'city' => 'Lahore',
            'is_active' => true,
        ]);

        // Search for Johar Town
        $response = $this->actingAs($this->guardianUser)
            ->get(route('guardian.riders.search', ['area' => 'Johar Town']), [
                'Accept' => 'application/json',
                'X-Requested-With' => 'XMLHttpRequest',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'count' => 1,
        ]);
        $response->assertJsonFragment(['name' => 'Tariq Mehmood']);
        $response->assertJsonMissing(['name' => 'Farhan Qureshi']);
    }

    public function test_guardian_can_filter_by_vehicle_type(): void
    {
        // Search for 'rickshaw' when driver only has 'van'
        $response = $this->actingAs($this->guardianUser)
            ->get(route('guardian.riders.search', ['vehicle_type' => 'rickshaw']), [
                'Accept' => 'application/json',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'count' => 0,
        ]);
    }

    public function test_guardian_can_assign_driver_to_student(): void
    {
        $response = $this->actingAs($this->guardianUser)
            ->post(route('guardian.riders.assign'), [
                'student_id' => $this->student->id,
                'driver_id' => $this->driverUser->id,
                'notes' => 'Please pickup at corner of street 4',
            ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->student->refresh();
        $this->assertEquals($this->driverUser->id, $this->student->driver_id);

        // Verify a trip was created/updated for this student
        $trip = Trip::where('student_id', $this->student->id)->latest()->first();
        $this->assertNotNull($trip);
        $this->assertEquals($this->driverUser->id, $trip->driver_id);
        $this->assertEquals($this->vehicle->id, $trip->vehicle_id);
        $this->assertEquals('pending', $trip->status);
    }

    public function test_guardian_cannot_assign_driver_to_another_guardians_student(): void
    {
        // Another guardian and child
        $otherGuardianUser = User::factory()->create();
        $otherGuardianUser->assignRole('guardian');
        $otherGuardian = Guardian::create([
            'user_id' => $otherGuardianUser->id,
            'cnic' => '22222-2222222-2',
            'address' => 'Gulberg',
        ]);
        $otherStudent = Student::create([
            'name' => 'Other Child',
            'roll_number' => 'R-888',
            'parent_id' => $otherGuardian->id,
        ]);

        // First guardian tries to assign driver to other student
        $response = $this->actingAs($this->guardianUser)
            ->post(route('guardian.riders.assign'), [
                'student_id' => $otherStudent->id,
                'driver_id' => $this->driverUser->id,
            ], ['Accept' => 'application/json']);

        $response->assertStatus(403);
    }

    public function test_cannot_assign_non_driver_user(): void
    {
        $nonDriver = User::factory()->create(); // no role

        $response = $this->actingAs($this->guardianUser)
            ->post(route('guardian.riders.assign'), [
                'student_id' => $this->student->id,
                'driver_id' => $nonDriver->id,
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['driver_id']);
    }

    public function test_driver_model_and_service_area_relationships(): void
    {
        $driver = Driver::find($this->driverUser->id);
        $this->assertNotNull($driver);
        $this->assertCount(2, $driver->serviceAreas);
        $this->assertEquals('Johar Town', $driver->serviceAreas->first()->area_name);

        $serviceArea = DriverServiceArea::first();
        $this->assertEquals($this->driverUser->id, $serviceArea->driver->id);
    }

    public function test_parent_role_can_view_find_rider_index_page(): void
    {
        $parentUser = User::factory()->create(['name' => 'Parent User']);
        $parentUser->assignRole('parent');
        Guardian::create([
            'user_id' => $parentUser->id,
            'cnic' => '11111-2222222-3',
            'address' => 'Gulberg, Lahore',
        ]);

        $response = $this->actingAs($parentUser)->get(route('guardian.riders.index'));
        $response->assertStatus(200);
        $response->assertViewIs('guardian.riders.index');
    }

    public function test_admin_role_can_view_find_rider_index_page(): void
    {
        $adminUser = User::factory()->create(['name' => 'Admin Super']);
        $adminUser->assignRole('admin');

        $response = $this->actingAs($adminUser)->get(route('guardian.riders.index'));
        $response->assertStatus(200);
        $response->assertViewIs('guardian.riders.index');
    }
}
