<?php

namespace App\Models;

use App\Models\SubLesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskSubLesson extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['id', 'url_submit', 'sub_lesson_id', 'user_id', 'information', 'grade'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(SubLesson::class);
    }
    public function subLesson()
    {
        return $this->belongsTo(SubLesson::class);
    }
}
