<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory, HasUuids;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'lesson_categories_id', 'user_id', 'passcode'];

    public function users()
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
}
