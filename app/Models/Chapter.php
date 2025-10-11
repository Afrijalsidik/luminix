<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Field yang bisa diisi mass assignment
     */
    protected $fillable = [
        'course_id',
        'title',
        'content',
        'order',
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Relasi: Chapter belongs to Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relasi: Chapter punya banyak Progress records
     */
    public function progress()
    {
        return $this->hasMany(ChapterProgress::class);
    }

    /**
     * Cek apakah chapter ini sudah diselesaikan oleh user tertentu
     */
    public function isCompletedBy($userId)
    {
        return $this->progress()
            ->where('user_id', $userId)
            ->where('is_completed', true)
            ->exists();
    }

    /**
     * Get progress record untuk user tertentu
     */
    public function getProgressFor($userId)
    {
        return $this->progress()
            ->where('user_id', $userId)
            ->first();
    }

    /**
     * Auto-set order saat create jika tidak diisi
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($chapter) {
            if (empty($chapter->order)) {
                // Set order ke angka terakhir + 1
                $lastOrder = static::where('course_id', $chapter->course_id)
                    ->max('order');
                $chapter->order = $lastOrder + 1;
            }
        });
    }
}