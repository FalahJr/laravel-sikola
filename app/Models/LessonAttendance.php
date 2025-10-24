<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonAttendance extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson_attendance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lesson_schedule_id',
        'user_id',
        'status',
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
     * Define the possible status values.
     */
    const STATUS_HADIR = 'Hadir';
    const STATUS_TIDAK_HADIR = 'Tidak Hadir';

    /**
     * Get the lesson schedule that this attendance belongs to.
     */
    public function lessonSchedule()
    {
        return $this->belongsTo(LessonSchedule::class, 'lesson_schedule_id');
    }

    /**
     * Get the user (student) that this attendance belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lesson through lesson schedule.
     */
    public function lesson()
    {
        return $this->hasOneThrough(
            Lesson::class,
            LessonSchedule::class,
            'id', // Foreign key on lesson_schedule table
            'id', // Foreign key on lesson table
            'lesson_schedule_id', // Local key on lesson_attendance table
            'lesson_id' // Local key on lesson_schedule table
        );
    }

    /**
     * Get the class through lesson schedule.
     */
    public function class()
    {
        return $this->hasOneThrough(
            Classes::class,
            LessonSchedule::class,
            'id', // Foreign key on lesson_schedule table
            'id', // Foreign key on class table
            'lesson_schedule_id', // Local key on lesson_attendance table
            'class_id' // Local key on lesson_schedule table
        );
    }

    /**
     * Scope to filter by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to get present students.
     */
    public function scopePresent($query)
    {
        return $query->where('status', self::STATUS_HADIR);
    }

    /**
     * Scope to get absent students.
     */
    public function scopeAbsent($query)
    {
        return $query->where('status', self::STATUS_TIDAK_HADIR);
    }
}
