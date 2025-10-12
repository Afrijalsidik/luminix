<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Enroll student to a course
     */
    public function enroll(Course $course)
    {
        $user = auth()->user();

        // Validasi: Hanya student yang bisa enroll
        if (!$user->isStudent()) {
            return redirect()
                ->back()
                ->with('error', 'Only students can enroll in courses.');
        }

        // Validasi: Kursus harus published
        if ($course->status !== 'published') {
            return redirect()
                ->back()
                ->with('error', 'This course is not available for enrollment.');
        }

        // Validasi: Cek apakah sudah enroll
        $existingEnrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()
                ->back()
                ->with('error', 'You are already enrolled in this course.');
        }

        // Buat enrollment baru
        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active',
            'progress_percentage' => 0,
            'enrolled_at' => now(),
        ]);

        return redirect()
            ->route('learn.index', $course->slug)
            ->with('success', 'Successfully enrolled! Start learning now.');
    }

    /**
     * Unenroll student from a course
     */
    public function unenroll(Course $course)
    {
        $user = auth()->user();

        // Cari enrollment
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return redirect()
                ->back()
                ->with('error', 'You are not enrolled in this course.');
        }

        // Hapus semua progress chapters
        \App\Models\ChapterProgress::where('user_id', $user->id)
            ->whereIn('chapter_id', $course->chapters()->pluck('id'))
            ->delete();

        // Hapus enrollment
        $enrollment->delete();

        return redirect()
            ->route('courses.show', $course->slug)
            ->with('success', 'You have been unenrolled from this course.');
    }
}