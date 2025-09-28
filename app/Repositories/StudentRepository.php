<?php
namespace App\Repositories;

use App\Models\Student;
use Illuminate\Support\Facades\Schema;

class StudentRepository
{
    public function all()
    {
        return Student::with('guardian.user')->get();
    }

    public function create(array $data)
    {
        // Some installations used `registration_no` previously. Detect which column exists.
        $rollColumn = Schema::hasColumn('students', 'roll_number') ? 'roll_number' : (Schema::hasColumn('students', 'registration_no') ? 'registration_no' : 'roll_number');

        // Detect class column; some schemas may use different names (class_name, grade, section)
        $classColumn = null;
        foreach (['class', 'class_name', 'grade', 'section'] as $col) {
            if (Schema::hasColumn('students', $col)) {
                $classColumn = $col;
                break;
            }
        }
        // fallback to 'class' for payload key if none found; DB insert will then fail and reveal misconfigured schema
        if (!$classColumn) {
            $classColumn = 'class';
        }

        $payload = [
            'name' => $data['name'] ?? null,
            $rollColumn => $data['roll_number'] ?? ($data['registration_no'] ?? null),
            $classColumn => $data['class'] ?? null,
            'parent_id' => $data['parent_id'] ?? null,
        ];

        $student = Student::create($payload);
        return $student->load('guardian');
    }

    public function update(Student $student, array $data)
    {
        // Handle legacy column naming between 'roll_number' and 'registration_no'
        $rollColumn = Schema::hasColumn('students', 'roll_number') ? 'roll_number' : (Schema::hasColumn('students', 'registration_no') ? 'registration_no' : 'roll_number');

        // Detect class column for update as well
        $classColumn = null;
        foreach (['class', 'class_name', 'grade', 'section'] as $col) {
            if (Schema::hasColumn('students', $col)) {
                $classColumn = $col;
                break;
            }
        }
        if (!$classColumn) {
            $classColumn = 'class';
        }

        $updatePayload = [
            'name' => $data['name'] ?? $student->name,
            $rollColumn => $data['roll_number'] ?? ($data['registration_no'] ?? ($student->{$rollColumn} ?? null)),
            $classColumn => $data['class'] ?? ($student->{$classColumn} ?? null),
            'parent_id' => $data['parent_id'] ?? $student->parent_id,
        ];

        $student->update($updatePayload);

        return $student->load('guardian');
    }

    public function delete(Student $student)
    {
        return $student->delete();
    }
}
