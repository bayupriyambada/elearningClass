<?php

namespace App\Models;

use App\Models\User;
use App\Models\submit;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class assignment extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'assignments';

    protected $fillable = [
        'id', 'title', 'subject', 'url', 'classes_id', 'user_id', 'due_date', 'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select("id", "username", "fullname");
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'classes_id', 'id');
    }
    public function submitAssignment()
    {
        return $this->hasMany(submit::class);
    }
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';
}
