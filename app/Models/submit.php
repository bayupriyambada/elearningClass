<?php

namespace App\Models;

use App\Models\User;
use App\Models\grade;
use App\Models\assignment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class submit extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'url', 'user_id', 'isSubmit', 'assignment_id', 'sent_assignment'];

    public function isSubmitValidation($submit)
    {
        return $submit->where("isSubmit", 1);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select("id", "username", "fullname");
    }
    public function assignment()
    {
        return $this->belongsTo(assignment::class);
    }
    public function grade()
    {
        return $this->hasMany(grade::class);
    }
}
