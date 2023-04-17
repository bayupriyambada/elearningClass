<?php

namespace App\Models;

use App\Models\User;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_attendance', 'isAbsensi', 'user_id', 'classes_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select("id", "username", "fullname");
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
}
