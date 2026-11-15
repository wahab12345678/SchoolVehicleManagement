<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
    ];

    /**
     * Attribute casting for common types.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'id' => 'integer',
    ];
}
