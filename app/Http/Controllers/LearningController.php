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
        // Load chapters dengan urutan
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

        // Load chapters dengan urutan
        $course->load([
            'chapters' => function ($query) {
                $query->orderBy('order', 'asc');
            }
        ]);

        // Ambil enrollment
        $enrollment = Enrollment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->firstOrFail();

        // VALIDASI: Cek apakah user boleh akses chapter ini
        // User harus menyelesaikan chapter sebelumnya terlebih dahulu
        if ($chapter->order > 1) {
            // Cari chapter sebelumnya berdasarkan order
            $chapterBeforeThis = Chapter::where('course_id', $course->id)
                ->where('order', $chapter->order - 1)
                ->first();

            if ($chapterBeforeThis) {
                $previousProgress = ChapterProgress::where('user_id', auth()->id())
                    ->where('chapter_id', $chapterBeforeThis->id)
                    ->first();

                // Jika previous chapter belum selesai, redirect ke previous chapter
                if (!$previousProgress || !$previousProgress->is_completed) {
                    return redirect()
                        ->route('learn.chapter', [$course->slug, $chapterBeforeThis->id])
                        ->with('warning', 'Please complete the previous chapter first.');
                }
            }
        }

        // OTOMATIS TANDAI CHAPTER INI SEBAGAI SELESAI
        $progress = ChapterProgress::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'chapter_id' => $chapter->id,
            ],
            [
                'is_completed' => false,
            ]
        );

        if (!$progress->is_completed) {
            $progress->markAsCompleted();
        }

        // PERBAIKAN: ambil previous dan next chapter berdasarkan order yang benar
        $previousChapter = Chapter::where('course_id', $course->id)
            ->where('order', '<', $chapter->order)
            ->orderBy('order', 'desc')
            ->first();

        $nextChapter = Chapter::where('course_id', $course->id)
            ->where('order', '>', $chapter->order)
            ->orderBy('order', 'asc')
            ->first();

        return view('learning.chapter', compact(
            'course',
            'chapter',
            'enrollment',
            'progress',
            'previousChapter',
            'nextChapter'
        ));
    }

    /**
     * Mark chapter as complete/incomplete (TIDAK DIGUNAKAN LAGI - OPSIONAL DIHAPUS)
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
            $message = 'Chapter completed! Great job!';
        }

        // Check if course is completed
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $chapter->course_id)
            ->first();

        if ($enrollment && $enrollment->isCompleted()) {
            $message = 'Congratulations! You have completed this course!';
        }

        // Return JSON for AJAX or redirect
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'is_completed' => $progress->is_completed,
                'progress_percentage' => $enrollment->progress_percentage ?? 0,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}
