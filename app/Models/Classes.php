<?php

namespace App\Models;

use App\Models\User;
use App\Models\material;
use App\Models\assignment;
use App\Models\attendance;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'classes';

    protected $fillable = [
        'id', 'name', 'subject', 'code', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function attendances()
    {
        return $this->hasMany(attendance::class);
    }

    public function materials()
    {
        return $this->hasMany(material::class);
    }
    public function assignments()
    {
        return $this->hasMany(assignment::class);
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
