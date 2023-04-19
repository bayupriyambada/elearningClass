<?php

namespace App\Models;

use App\Models\Role;
use App\Models\submit;
use App\Models\Classes;
use App\Models\material;
use App\Models\assignment;
use App\Models\attendance;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'fullname',
        'email',
        'password',
        'registrationCode',
        'avatar',
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

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
    public function attendances()
    {
        return $this->hasMany(attendance::class);
    }
    public function materials()
    {
        return $this->hasMany(material::class);
    }
    public function assignments()
    {
        return $this->hasMany(assignment::class);
    }
    public function submitAssignment()
    {
        return $this->hasMany(submit::class);
    }
}
