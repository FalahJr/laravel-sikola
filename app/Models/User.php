<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $nama_lengkap
 * @property integer $nomor_induk
 * @property string $role
 * @property string $alamat
 * @property string $created_at
 * @property string $updated_at
 * @property Materi[] $materis
 * @property Notifikasi[] $notifikasis
 */
class User extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user';

    /**
     * @var array
     */
    protected $fillable = ['email', 'password', 'nama_lengkap', 'nomor_induk', 'role', 'alamat', 'class_id', 'jurusan', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materis()
    {
        return $this->hasMany('App\Models\Materi');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifikasis()
    {
        return $this->hasMany('App\Models\Notifikasi');
    }

    /**
     * Get the class that the user belongs to.
     */
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    /**
     * Get the lessons created by this user (if teacher).
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Get the lesson attendances for this user.
     */
    public function lessonAttendances()
    {
        return $this->hasMany(LessonAttendance::class);
    }

    /**
     * Get the assignment submissions for this user.
     */
    public function assignmentSubmissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
