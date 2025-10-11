<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Filament: Tentukan siapa yang bisa akses admin panel
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Hanya admin dan instructor yang bisa akses Filament
        return in_array($this->role, ['admin', 'instructor']);
    }

    /**
     * Helper methods untuk cek role
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isInstructor()
    {
        return $this->role === 'instructor';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    /**
     * Relasi: User (instructor) punya banyak Courses
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Relasi: User (student) punya banyak Enrollments
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Relasi: Many-to-Many ke Courses melalui Enrollments
     */
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
            ->withPivot('status', 'progress_percentage', 'enrolled_at', 'completed_at')
            ->withTimestamps();
    }

    /**
     * Relasi: User punya banyak Chapter Progress
     */
    public function chapterProgress()
    {
        return $this->hasMany(ChapterProgress::class);
    }

    /**
     * Get completed courses untuk student
     */
    public function completedCourses()
    {
        return $this->enrolledCourses()
            ->wherePivot('status', 'completed');
    }

    /**
     * Get active courses untuk student
     */
    public function activeCourses()
    {
        return $this->enrolledCourses()
            ->wherePivot('status', 'active');
    }
}
