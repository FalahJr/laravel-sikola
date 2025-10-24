<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'class';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the users that belong to this class.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'class_id');
    }

    /**
     * Get the lesson schedules for this class.
     */
    public function lessonSchedules()
    {
        return $this->hasMany(LessonSchedule::class, 'class_id');
    }

    /**
     * Get the assignments for this class.
     */
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'class_id');
    }
}
