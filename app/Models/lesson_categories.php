<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lesson_categories extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'lesson_categories';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'name'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
