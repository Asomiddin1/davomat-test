<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'title',
        'body',
        'sender_id',
        'target_type', // 'student', 'group', 'all'
        'target_id',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // Kim yuborgan
    public function sender()
    {
        return $this->belongsTo(\App\Models\User::class, 'sender_id');
    }

    // Talabaga yuborilgan bo‘lsa → Student modeli
    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class, 'target_id');
    }

    // Guruhga yuborilgan bo‘lsa → Group modeli
    public function group()
    {
        return $this->belongsTo(\App\Models\Group::class, 'target_id');
    }

    // Blade'da qulay ishlatish uchun accessorlar
    public function getTargetLabelAttribute()
    {
        if ($this->target_type === 'all') {
            return 'Hammaga';
        }

        if ($this->target_type === 'student') {
            return 'Talaba: ' . ($this->student?->fullname ?? '-');
        }

        if ($this->target_type === 'group') {
            return 'Guruh: ' . ($this->group?->name ?? '-');
        }

        return '-';
    }
}