<?php

namespace App\Models;

use App\Models\TaskSubLesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubLesson extends Model
{
    use HasFactory, HasUuids;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'lesson_id', 'user_id', 'title', 'content', 'isPublish'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }
    public function taskLesson()
    {
        return $this->hasMany(TaskSubLesson::class);
    }
}
