<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'roll_number',
        'class',
        'parent_id'
    ];

    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'parent_id');
    }
}
