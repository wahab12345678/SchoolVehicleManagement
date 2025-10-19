<?php

namespace App\Repositories;

use App\Models\School;

class SchoolRepository
{
    public function create(array $data)
    {
        return School::create($data);
    }

    public function update(School $school, array $data)
    {
        return $school->update($data);
    }

    public function delete(School $school)
    {
        return $school->delete();
    }

    public function find($id)
    {
        return School::find($id);
    }

    public function all()
    {
        return School::all();
    }
}