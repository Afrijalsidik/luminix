<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display course listing
     */
    public function index(Request $request)
    {
        $query = Course::published()
            ->with(['category', 'instructor'])
            ->withCount('enrollments');

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->orderBy('enrollments_count', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $courses = $query->paginate(12);

        // Get all categories for filter
        $categories = Category::withCount([
            'courses' => function ($q) {
                $q->where('status', 'published');
            }
        ])
            ->having('courses_count', '>', 0)
            ->get();

        return view('courses.index', compact('courses', 'categories'));
    }

    /**
     * Display course detail
     */
    public function show(Course $course)
    {
        // Hanya tampilkan kursus yang published (kecuali jika owner)
        if (
            $course->status !== 'published' &&
            (!auth()->check() || auth()->id() !== $course->user_id)
        ) {
            abort(404);
        }

        // Load relationships
        $course->load([
            'category',
            'instructor',
            'chapters' => function ($query) {
                $query->orderBy('order', 'asc');
            }
        ]);

        // Count students enrolled
        $course->loadCount('enrollments');

        // Check if current user enrolled
        $isEnrolled = false;
        $enrollment = null;

        if (auth()->check()) {
            $enrollment = $course->enrollments()
                ->where('user_id', auth()->id())
                ->first();
            $isEnrolled = $enrollment !== null;
        }

        return view('courses.show', compact('course', 'isEnrolled', 'enrollment'));
    }

    /**
     * Search courses
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return redirect()->route('courses.index');
        }

        $courses = Course::published()
            ->with(['category', 'instructor'])
            ->withCount('enrollments')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(12);

        return view('courses.search', compact('courses', 'query'));
    }
}