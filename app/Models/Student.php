<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'student_id',
        'fullname',
        'email',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groups()
    {
        return $this->belongsToMany(
            Group::class,
            'group_student',
            'student_id',
            'group_id'
        );
    }
}
