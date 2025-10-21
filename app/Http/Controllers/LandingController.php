<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display landing page
     */
    public function index()
    {
        // Ambil kursus yang published, terbaru, limit 6
        $featuredCourses = Course::published()
            ->with(['category', 'instructor'])
            ->withCount('enrollments')
            ->latest()
            ->limit(8)
            ->get();

        // Ambil semua kategori dengan jumlah kursus published
        $categories = Category::withCount([
            'courses' => function ($query) {
                $query->where('status', 'published');
            }
        ])
            ->having('courses_count', '>', 0)
            ->get();

        // Statistik
        $stats = [
            'total_courses' => Course::published()->count(),
            'total_students' => \App\Models\User::where('role', 'student')->count(),
            'total_instructors' => \App\Models\User::where('role', 'instructor')->count(),
        ];

        return view('landing', compact('featuredCourses', 'categories', 'stats'));
    }
}