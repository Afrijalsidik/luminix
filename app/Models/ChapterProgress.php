<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterProgress extends Model
{
    use HasFactory;

    /**
     * Nama tabel (karena Laravel expect 'chapter_progresses')
     */
    protected $table = 'chapter_progress';

    /**
     * Field yang bisa diisi mass assignment
     */
    protected $fillable = [
        'user_id',
        'chapter_id',
        'is_completed',
        'completed_at',
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    /**
     * Relasi: ChapterProgress belongs to User (Student)
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: ChapterProgress belongs to Chapter
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    /**
     * Mark chapter sebagai complete dan update enrollment progress
     */
    public function markAsCompleted()
    {
        $this->is_completed = true;
        $this->completed_at = now();
        $this->save();

        // Update enrollment progress
        $this->updateEnrollmentProgress();
    }

    /**
     * Mark chapter sebagai incomplete
     */
    public function markAsIncomplete()
    {
        $this->is_completed = false;
        $this->completed_at = null;
        $this->save();

        // Update enrollment progress
        $this->updateEnrollmentProgress();
    }

    /**
     * Update progress di enrollment setelah chapter complete/incomplete
     */
    protected function updateEnrollmentProgress()
    {
        $courseId = $this->chapter->course_id;

        $enrollment = Enrollment::where('user_id', $this->user_id)
            ->where('course_id', $courseId)
            ->first();

        if ($enrollment) {
            $enrollment->updateProgress();
        }
    }

    /**
     * Auto-update enrollment progress setelah save
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($progress) {
            // Trigger update enrollment progress setiap kali progress berubah
            $progress->updateEnrollmentProgress();
        });
    }
}