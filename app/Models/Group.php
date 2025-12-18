<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name'];

    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'group_student',
            'group_id',
            'student_id'
        );
    }
}
