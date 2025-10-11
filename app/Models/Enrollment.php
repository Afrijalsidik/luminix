<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    /**
     * Field yang bisa diisi mass assignment
     */
    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'progress_percentage',
        'enrolled_at',
        'completed_at',
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
        'progress_percentage' => 'integer',
    ];

    /**
     * Relasi: Enrollment belongs to User (Student)
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Enrollment belongs to Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Update progress percentage berdasarkan completed chapters
     */
    public function updateProgress()
    {
        $totalChapters = $this->course->chapters()->count();

        if ($totalChapters == 0) {
            $this->progress_percentage = 0;
            $this->save();
            return;
        }

        // Hitung jumlah chapter yang sudah diselesaikan
        $completedChapters = ChapterProgress::where('user_id', $this->user_id)
            ->whereHas('chapter', function ($query) {
                $query->where('course_id', $this->course_id);
            })
            ->where('is_completed', true)
            ->count();

        // Hitung persentase
        $percentage = round(($completedChapters / $totalChapters) * 100);

        $this->progress_percentage = $percentage;

        // Auto-complete jika sudah 100%
        if ($percentage >= 100) {
            $this->status = 'completed';
            $this->completed_at = now();
        }

        $this->save();
    }

    /**
     * Scope: Hanya enrollment yang active
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope: Hanya enrollment yang completed
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Cek apakah enrollment sudah selesai
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}