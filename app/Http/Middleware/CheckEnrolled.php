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
        // Ambil course dari route parameter
        $course = $request->route('course');

        // Jika course adalah slug (string), cari course by slug
        if (is_string($course)) {
            $course = Course::where('slug', $course)->firstOrFail();
        }

        // Cek apakah user sudah enroll ke kursus ini
        $isEnrolled = $course->isEnrolledBy(auth()->id());

        if (!$isEnrolled) {
            return redirect()
                ->route('courses.show', $course->slug)
                ->with('error', 'You must enroll in this course first!');
        }

        return $next($request);
    }
}