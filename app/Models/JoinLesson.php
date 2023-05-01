<?php

namespace App\Models;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JoinLesson extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['id', 'user_id', 'lesson_id', 'isJoin'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
