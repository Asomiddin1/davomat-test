<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'teacher_id',
        'subject_id', // <- endi subject_id ishlatiladi
        'lesson_date',
        'weekday',
        'start_time',
        'end_time',
        'room',       // xonani ham qo‘shish kerak
    ];

    // Group bilan bog‘lanish
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    // Teacher bilan bog‘lanish
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // Subject bilan bog‘lanish
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
