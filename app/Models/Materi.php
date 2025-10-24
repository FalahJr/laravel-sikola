<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $lesson_id
 * @property string $judul
 * @property string $deskripsi
 * @property string $file
 * @property string $gambar
 * @property string $created_at
 * @property string $updated_at
 * @property Lesson $lesson
 */
class Materi extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'materi';

    /**
     * @var array
     */
    protected $fillable = ['lesson_id', 'judul', 'deskripsi', 'file', 'gambar', 'created_at', 'updated_at'];

    /**
     * Get the lesson that this material belongs to.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    /**
     * Get the user (teacher) through the lesson relationship.
     */
    public function user()
    {
        return $this->hasOneThrough(User::class, Lesson::class, 'id', 'id', 'lesson_id', 'user_id');
    }
}
