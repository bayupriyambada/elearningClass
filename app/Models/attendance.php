<?php

namespace App\Models;

use App\Models\User;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class attendance extends Model
{
    use HasFactory, HasUuids;


    protected $fillable = [
        'id', 'date_attendance', 'isAbsensi', 'user_id', 'classes_id'
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select("id", "username", "fullname");
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classes_id', 'id');
    }

    public $incrementing = false;
    protected $keyType = 'string';
}
