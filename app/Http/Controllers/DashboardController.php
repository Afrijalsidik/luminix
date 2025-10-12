<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display student dashboard
     */
    public function index()
    {
        $user = auth()->user();

        // Redirect admin & instructor ke Filament
        if ($user->isAdmin() || $user->isInstructor()) {
            return redirect('/admin');
        }

        // Ambil enrolled courses dengan progress
        $enrollments = Enrollment::where('user_id', $user->id)
            ->with(['course.category', 'course.instructor', 'course.chapters'])
            ->latest()
            ->get();

        // Pisahkan active dan completed
        $activeCourses = $enrollments->where('status', 'active');
        $completedCourses = $enrollments->where('status', 'completed');

        // Statistik
        $stats = [
            'total_enrolled' => $enrollments->count(),
            'active_courses' => $activeCourses->count(),
            'completed_courses' => $completedCourses->count(),
            'total_chapters_completed' => \App\Models\ChapterProgress::where('user_id', $user->id)
                ->where('is_completed', true)
                ->count(),
        ];

        // Rekomendasi courses (yang belum di-enroll)
        $recommendedCourses = Course::published()
            ->whereNotIn('id', $enrollments->pluck('course_id'))
            ->with(['category', 'instructor'])
            ->withCount('enrollments')
            ->latest()
            ->limit(3)
            ->get();

        return view('dashboard', compact('activeCourses', 'completedCourses', 'stats', 'recommendedCourses'));
    }
}