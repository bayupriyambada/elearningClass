<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinLesson extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['id', 'user_id', 'lesson_id', 'isJoin'];
    public $incrementing = false;
    protected $keyType = 'string';
}
