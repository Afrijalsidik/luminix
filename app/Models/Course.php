<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Field yang bisa diisi mass assignment
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'thumbnail',
        'status',
    ];

    /**
     * Relasi: Course belongs to User (Instructor)
     */
    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Course belongs to Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi: 1 Course punya banyak Chapters
     */
    public function chapters()
    {
        return $this->hasMany(Chapter::class)->orderBy('order', 'asc');
    }

    /**
     * Relasi: Many-to-Many Course ke Users melalui Enrollments
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Relasi: Students yang enroll ke kursus ini
     */
    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->withPivot('status', 'progress_percentage', 'enrolled_at', 'completed_at')
            ->withTimestamps();
    }

    /**
     * Scope: Hanya kursus yang published
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope: Hanya kursus yang draft
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Get total jumlah chapters
     */
    public function getTotalChaptersAttribute()
    {
        return $this->chapters()->count();
    }

    /**
     * Get total students enrolled
     */
    public function getTotalStudentsAttribute()
    {
        return $this->enrollments()->count();
    }

    /**
     * Cek apakah user sudah enroll ke kursus ini
     */
    public function isEnrolledBy($userId)
    {
        return $this->enrollments()
            ->where('user_id', $userId)
            ->exists();
    }

    /**
     * Auto-generate slug dari title sebelum save
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });

        static::updating(function ($course) {
            if ($course->isDirty('title')) {
                $course->slug = Str::slug($course->title);
            }
        });
    }
}