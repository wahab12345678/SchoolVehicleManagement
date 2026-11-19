<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardianDriverMessage extends Model
{
    use HasFactory;

    protected $table = 'guardian_driver_messages';

    protected $fillable = [
        'driver_id',
        'guardian_user_id',
        'student_id',
        'type',
        'title',
        'message',
        'is_read',
        'read_at',
        'status',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function guardianUser()
    {
        return $this->belongsTo(User::class, 'guardian_user_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
