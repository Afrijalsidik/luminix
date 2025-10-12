<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Course;

class CheckEnrolled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $course = $request->route('course');
        $chapter = $request->route('chapter');

        // Jika tidak ada course di route, coba ambil dari chapter
        if (!$course && $chapter) {
            $course = $chapter->course;
        }

        // Jika course adalah slug (string), cari course by slug
        if (is_string($course)) {
            $course = Course::where('slug', $course)->firstOrFail();
        }

        // Jika setelah semua usaha course tetap tidak ditemukan, beri 404
        if (!$course) {
            abort(404, 'Course not found.');
        }

        // Cek apakah user sudah enroll ke kursus ini
        if (!auth()->check() || !$course->isEnrolledBy(auth()->id())) {
            return redirect()
                ->route('courses.show', $course->slug)
                ->with('error', 'You must enroll in this course to view this page.');
        }

        return $next($request);
    }
}