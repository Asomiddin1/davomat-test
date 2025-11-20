<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable ustunlar (bir vaqtda to‘ldiriladiganlar)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * JSON yoki array ko‘rinishida yashiriladigan maydonlar
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Avtomatik cast bo‘ladigan turlar
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Laravel 10+ versiyalarda avtomatik hash
        ];
    }

    /**
     * 🔐 Rollarni tekshirish uchun qulay helperlar
     */
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isParent(): bool
    {
        return $this->role === 'parent';
    }
}
