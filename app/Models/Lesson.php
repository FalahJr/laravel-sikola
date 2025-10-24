<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
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
     * Get the user (teacher) that owns this lesson.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lesson schedules for this lesson.
     */
    public function lessonSchedules()
    {
        return $this->hasMany(LessonSchedule::class, 'lesson_id');
    }

    /**
     * Get the materials for this lesson.
     */
    public function materials()
    {
        return $this->hasMany(Materi::class, 'lesson_id');
    }

    /**
     * Get the lesson attendances through lesson schedules.
     */
    public function attendances()
    {
        return $this->hasManyThrough(
            LessonAttendance::class,
            LessonSchedule::class,
            'lesson_id', // Foreign key on lesson_schedule table
            'lesson_schedule_id', // Foreign key on lesson_attendance table
            'id', // Local key on lesson table
            'id' // Local key on lesson_schedule table
        );
    }
}
