<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $primaryKey = 'schools_id';

     protected $fillable = [
        'name',
        'phone',
        'address',
        'longitude',
        'latitude',
    ];
}
