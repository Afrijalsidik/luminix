<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Field yang bisa diisi mass assignment
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Relasi: 1 Category punya banyak Courses
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Get jumlah kursus published dalam kategori ini
     */
    public function getPublishedCoursesCountAttribute()
    {
        return $this->courses()->where('status', 'published')->count();
    }

    /**
     * Auto-generate slug dari name sebelum save
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}