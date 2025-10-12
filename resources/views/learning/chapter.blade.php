@extends('layouts.app')

@section('title', $chapter->title . ' - ' . $course->title)

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <!-- Top Navigation Bar -->
        <div class="bg-white border-b sticky top-0 z-10 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
                <div class="flex items-center justify-between">
                    <!-- Left: Back to Course -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('learn.index', $course->slug) }}"
                            class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="hidden sm:inline text-sm font-semibold">Back to Course</span>
                        </a>
                        <div class="hidden md:block h-6 w-px bg-gray-300"></div>
                        <div class="hidden md:block">
                            <p class="text-sm text-gray-500">{{ $course->title }}</p>
                        </div>
                    </div>

                    <!-- Right: Progress -->
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs text-gray-500">Progress</p>
                            <p class="text-sm font-bold text-blue-600">{{ $enrollment->progress_percentage }}%</p>
                        </div>
                        <div class="w-16 h-16 relative">
                            <svg class="w-full h-full transform -rotate-90">
                                <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="4" fill="none" />
                                <circle cx="32" cy="32" r="28" stroke="#3b82f6" stroke-width="4" fill="none"
                                    stroke-dasharray="{{ 2 * 3.14159 * 28 }}"
                                    stroke-dashoffset="{{ 2 * 3.14159 * 28 * (1 - $enrollment->progress_percentage / 100) }}"
                                    class="transition-all duration-500" />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-xs font-bold text-gray-700">{{ $enrollment->progress_percentage }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Chapter Header -->
            <div class="bg-white rounded-xl shadow-md p-6 md:p-8 mb-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full">
                                Chapter {{ $chapter->order }}
                            </span>
                            @if($progress->is_completed)
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-full flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Completed
                                </span>
                            @endif
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $chapter->title }}</h1>
                        <p class="text-gray-600">Chapter {{ $chapter->order }} of {{ $course->chapters->count() }}</p>
                    </div>
                </div>

                <!-- Mark Complete Button -->
                <form action="{{ route('learn.complete', $chapter) }}" method="POST" id="complete-form">
                    @csrf
                    <button type="submit" id="complete-btn"
                        class="w-full sm:w-auto px-6 py-3 rounded-lg font-semibold transition-all duration-200 {{ $progress->is_completed ? 'bg-gray-100 text-gray-700 hover:bg-gray-200' : 'bg-gradient-to-r from-green-500 to-green-600 text-white hover:from-green-600 hover:to-green-700 shadow-md hover:shadow-lg' }}">
                        @if($progress->is_completed)
                            <span class="flex items-center gap-2 justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Mark as Incomplete
                            </span>
                        @else
                            <span class="flex items-center gap-2 justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Mark as Complete
                            </span>
                        @endif
                    </button>
                </form>
            </div>

            <!-- Chapter Content -->
            <div class="bg-white rounded-xl shadow-md p-6 md:p-10 mb-6">
                <div class="prose prose-lg prose-blue max-w-none">
                    {!! $chapter->content !!}
                </div>
            </div>


            <!-- Navigation -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Previous Chapter -->
                    @if($previousChapter)
                        <a href="{{ route('learn.chapter', [$course->slug, $previousChapter->id]) }}"
                            class="flex items-center gap-4 p-4 border-2 border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition group">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-gray-500 mb-1">Previous</p>
                                <p class="font-semibold text-gray-900 truncate group-hover:text-blue-600 transition">
                                    {{ $previousChapter->title }}
                                </p>
                            </div>
                        </a>
                    @else
                        <div class="p-4 border-2 border-gray-100 rounded-lg bg-gray-50">
                            <p class="text-sm text-gray-400 text-center">No previous chapter</p>
                        </div>
                    @endif

                    <!-- Next Chapter -->
                    @if($nextChapter)
                        <a href="{{ route('learn.chapter', [$course->slug, $nextChapter->id]) }}"
                            class="flex items-center gap-4 p-4 border-2 border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition group">
                            <div class="flex-1 min-w-0 text-right">
                                <p class="text-xs text-gray-500 mb-1">Next</p>
                                <p class="font-semibold text-gray-900 truncate group-hover:text-blue-600 transition">
                                    {{ $nextChapter->title }}
                                </p>
                            </div>
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                    @else
                        <div class="p-4 border-2 border-gray-100 rounded-lg bg-gray-50">
                            <p class="text-sm text-gray-400 text-center">No next chapter</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div id="flash-message"
            class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 animate-slide-up">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @push('scripts')
        <script>
            // Auto hide flash message
            setTimeout(function () {
                const flashMessage = document.getElementById('flash-message');
                if (flashMessage) {
                    flashMessage.style.opacity = '0';
                    setTimeout(() => flashMessage.remove(), 300);
                }
            }, 5000);

            // AJAX form submission for mark complete (optional)
            document.getElementById('complete-form').addEventListener('submit', function (e) {
                // You can implement AJAX here if needed
                // For now, we use normal form submission
            });
        </script>

        <style>
            @keyframes slide-up {
                from {
                    transform: translateY(100%);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            .animate-slide-up {
                animation: slide-up 0.3s ease-out;
            }
        </style>
    @endpush
@endsection