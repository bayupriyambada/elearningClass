<?php

namespace App\Models;

use App\Models\JoinLesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory, HasUuids;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'lesson_categories_id', 'user_id', 'passcode', "version", "kkm"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lessonCategory()
    {
        return $this->belongsTo(lesson_categories::class, 'lesson_categories_id', 'id');
    }
    public function subLesson()
    {
        return $this->hasMany(SubLesson::class);
    }

    public function joinLesson()
    {
        return $this->hasMany(JoinLesson::class);
    }
}
