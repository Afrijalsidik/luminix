<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Chapter;
use App\Models\ChapterProgress;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    /**
     * Display course overview (chapter list)
     */
    public function index(Course $course)
    {
        // Load chapters dengan order
        $course->load([
            'chapters' => function ($query) {
                $query->orderBy('order', 'asc');
            },
            'category',
            'instructor'
        ]);

        // Ambil enrollment info
        $enrollment = Enrollment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->firstOrFail();

        // Hitung completed chapters
        $completedChapters = ChapterProgress::where('user_id', auth()->id())
            ->whereIn('chapter_id', $course->chapters->pluck('id'))
            ->where('is_completed', true)
            ->pluck('chapter_id')
            ->toArray();

        // dd($enrollment);
        // dd($enrollment->enrolled_at);


        return view('learning.index', compact('course', 'enrollment', 'completedChapters'));
    }

    /**
     * Display chapter content
     */
    public function show(Course $course, Chapter $chapter)
    {
        // Validasi: chapter harus milik course ini
        if ($chapter->course_id !== $course->id) {
            abort(404);
        }

        // Load relationships
        $course->load([
            'chapters' => function ($query) {
                $query->orderBy('order', 'asc');
            }
        ]);

        // Ambil enrollment
        $enrollment = Enrollment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->firstOrFail();

        // Ambil atau buat progress untuk chapter ini
        $progress = ChapterProgress::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'chapter_id' => $chapter->id,
            ],
            [
                'is_completed' => false,
            ]
        );

        // Find previous and next chapters
        $previousChapter = $course->chapters()
            ->where('order', '<', $chapter->order)
            ->orderBy('order', 'desc')
            ->first();

        $nextChapter = $course->chapters()
            ->where('order', '>', $chapter->order)
            ->orderBy('order', 'asc')
            ->first();

        return view('learning.chapter', compact('course', 'chapter', 'enrollment', 'progress', 'previousChapter', 'nextChapter'));
    }

    /**
     * Mark chapter as complete/incomplete
     */
    public function markAsComplete(Request $request, Chapter $chapter)
    {
        $user = auth()->user();

        // Ambil atau buat progress
        $progress = ChapterProgress::firstOrCreate(
            [
                'user_id' => $user->id,
                'chapter_id' => $chapter->id,
            ],
            [
                'is_completed' => false,
            ]
        );

        // Toggle completion status
        if ($progress->is_completed) {
            $progress->markAsIncomplete();
            $message = 'Chapter marked as incomplete.';
        } else {
            $progress->markAsCompleted();
            $message = 'Chapter completed! Great job! 🎉';
        }

        // Check if course is completed
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $chapter->course_id)
            ->first();

        if ($enrollment && $enrollment->isCompleted()) {
            $message = '🎉 Congratulations! You have completed this course!';
        }

        // Return JSON for AJAX or redirect for normal request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'is_completed' => $progress->is_completed,
                'progress_percentage' => $enrollment->progress_percentage ?? 0,
            ]);
        }

        return redirect()
            ->back()
            ->with('success', $message);
    }
}