<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Classes;
use App\Models\attendance;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        "id",
        'username',
        'fullname',
        'email',
        'password',
        'registrationCode',
        'phone',
        'address',
        'role_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
    public function attendances()
    {
        return $this->hasMany(attendance::class);
    }

    public function scopeRoleTeachers()
    {
        return $this->where('role_id', 2);
    }
    public function scopeRoleStudents()
    {
        return $this->where('role_id', 3);
    }

    public function taskLessons()
    {
        return $this->hasMany(TaskSubLesson::class);
    }

    public $incrementing = false;
    protected $keyType = 'string';
}
