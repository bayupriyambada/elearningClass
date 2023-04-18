<?php

namespace App\Models;

use App\Models\submit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class grade extends Model
{
    use HasFactory;

    protected $fillable = ['submit_id', 'feedback', 'grade'];

    public function submit()
    {
        return $this->belongsTo(submit::class);
    }
}
