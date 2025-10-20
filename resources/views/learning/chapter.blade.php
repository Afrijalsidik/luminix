@extends('layouts.frontend')

@section('title', $chapter->title . ' - ' . $course->title)

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <!-- Top Navigation Bar -->
        <div class="bg-white border-b sticky top-0 z-10 shadow-sm">
            <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-2.5 sm:py-3">
                <div class="flex items-center justify-between gap-2 sm:gap-3">
                    <!-- Left: Back to Course -->
                    <div class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                        <a href="{{ route('learn.index', $course->slug) }}"
                            class="flex items-center gap-1.5 sm:gap-2 text-gray-600 hover:text-gray-900 transition p-1 -ml-1">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="hidden sm:inline text-sm font-semibold whitespace-nowrap">Back to Course</span>
                        </a>
                        <div class="hidden lg:block h-6 w-px bg-gray-300"></div>
                        <div class="hidden lg:block min-w-0 flex-1">
                            <p class="text-sm text-gray-500 truncate">{{ $course->title }}</p>
                        </div>
                    </div>

                    <!-- Right: Progress -->
                    <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                        <div class="text-right hidden md:block">
                            <p class="text-xs text-gray-500">Progress</p>
                            <p class="text-sm font-bold text-blue-600">{{ $enrollment->progress_percentage }}%</p>
                        </div>
                        <div class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 relative flex-shrink-0">
                            <svg class="w-full h-full transform -rotate-90">
                                <circle cx="50%" cy="50%" r="22" stroke="#e5e7eb" stroke-width="3" fill="none"
                                    class="sm:hidden" />
                                <circle cx="50%" cy="50%" r="24" stroke="#e5e7eb" stroke-width="3.5" fill="none"
                                    class="hidden sm:block lg:hidden" />
                                <circle cx="50%" cy="50%" r="28" stroke="#e5e7eb" stroke-width="4" fill="none"
                                    class="hidden lg:block" />

                                <circle cx="50%" cy="50%" r="22" stroke="#3b82f6" stroke-width="3" fill="none"
                                    stroke-dasharray="{{ 2 * 3.14159 * 22 }}"
                                    stroke-dashoffset="{{ 2 * 3.14159 * 22 * (1 - $enrollment->progress_percentage / 100) }}"
                                    class="transition-all duration-500 sm:hidden" />
                                <circle cx="50%" cy="50%" r="24" stroke="#3b82f6" stroke-width="3.5" fill="none"
                                    stroke-dasharray="{{ 2 * 3.14159 * 24 }}"
                                    stroke-dashoffset="{{ 2 * 3.14159 * 24 * (1 - $enrollment->progress_percentage / 100) }}"
                                    class="transition-all duration-500 hidden sm:block lg:hidden" />
                                <circle cx="50%" cy="50%" r="28" stroke="#3b82f6" stroke-width="4" fill="none"
                                    stroke-dasharray="{{ 2 * 3.14159 * 28 }}"
                                    stroke-dashoffset="{{ 2 * 3.14159 * 28 * (1 - $enrollment->progress_percentage / 100) }}"
                                    class="transition-all duration-500 hidden lg:block" />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span
                                    class="text-[10px] sm:text-xs font-bold text-gray-700">{{ $enrollment->progress_percentage }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-3 sm:px-4 lg:px-8 py-4 sm:py-6 lg:py-8">
            <!-- Chapter Header -->
            <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 lg:p-8 mb-4 sm:mb-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-3">
                            <span
                                class="px-2.5 py-1 sm:px-3 bg-blue-100 text-blue-700 text-xs sm:text-sm font-semibold rounded-full whitespace-nowrap">
                                Chapter {{ $chapter->order }}
                            </span>
                            @if($progress->is_completed)
                                <span
                                    class="px-2.5 py-1 sm:px-3 bg-green-100 text-green-700 text-xs sm:text-sm font-semibold rounded-full flex items-center gap-1 sm:gap-1.5 whitespace-nowrap">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Completed</span>
                                </span>
                            @endif
                        </div>
                        <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-2 leading-tight">
                            {{ $chapter->title }}</h1>
                        <p class="text-xs sm:text-sm lg:text-base text-gray-600">Chapter {{ $chapter->order }} of
                            {{ $course->chapters->count() }}</p>
                    </div>
                </div>

                <!-- content -->
                <div class="pt-6 sm:pt-8 lg:pt-10 mb-6">
                    <article
                        class="prose prose-sm sm:prose-base lg:prose-lg xl:prose-xl prose-slate max-w-none leading-relaxed prose-headings:font-bold prose-headings:text-gray-900 prose-p:text-gray-700 prose-a:text-blue-600 prose-img:rounded-lg prose-img:shadow-md">
                        {!! $chapter->content !!}
                    </article>
                </div>

                <!-- Navigation -->
                <div class="bg-white rounded-xl pt-8 sm:pt-12 lg:pt-20">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <!-- Previous Chapter -->
                        @if($previousChapter)
                            <a href="{{ route('learn.chapter', [$course->slug, $previousChapter->id]) }}"
                                class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 border-2 border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition group">
                                <div
                                    class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs text-gray-500 mb-0.5 sm:mb-1">Previous</p>
                                    <p
                                        class="text-sm sm:text-base font-semibold text-gray-900 truncate group-hover:text-blue-600 transition">
                                        {{ $previousChapter->title }}
                                    </p>
                                </div>
                            </a>
                        @else
                            <div class="p-3 sm:p-4 border-2 border-gray-100 rounded-lg bg-gray-50">
                                <p class="text-xs sm:text-sm text-gray-400 text-center">No previous chapter</p>
                            </div>
                        @endif

                        <!-- Next Chapter -->
                        @if($nextChapter)
                            <a href="{{ route('learn.chapter', [$course->slug, $nextChapter->id]) }}"
                                class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 border-2 border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition group">
                                <div class="flex-1 min-w-0 text-right">
                                    <p class="text-xs text-gray-500 mb-0.5 sm:mb-1">Next</p>
                                    <p
                                        class="text-sm sm:text-base font-semibold text-gray-900 truncate group-hover:text-blue-600 transition">
                                        {{ $nextChapter->title }}
                                    </p>
                                </div>
                                <div
                                    class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </a>
                        @else
                            <div class="p-3 sm:p-4 border-2 border-gray-100 rounded-lg bg-gray-50">
                                <p class="text-xs sm:text-sm text-gray-400 text-center">
                                    @if($enrollment->isCompleted())
                                        Course Completed! 🎉
                                    @else
                                        No next chapter
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div id="flash-message"
            class="fixed bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-auto sm:max-w-sm bg-green-500 text-white px-4 sm:px-6 py-3 sm:py-4 rounded-lg shadow-lg z-50 animate-slide-up">
            <div class="flex items-center gap-2 sm:gap-3">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm sm:text-base">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('warning'))
        <div id="flash-message"
            class="fixed bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-auto sm:max-w-sm bg-yellow-500 text-white px-4 sm:px-6 py-3 sm:py-4 rounded-lg shadow-lg z-50 animate-slide-up">
            <div class="flex items-center gap-2 sm:gap-3">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span class="text-sm sm:text-base">{{ session('warning') }}</span>
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
                transition: opacity 0.3s ease-out;
            }

            /* Improve prose readability on mobile */
            @media (max-width: 640px) {
                .prose {
                    font-size: 0.9375rem;
                    line-height: 1.7;
                }

                .prose h1 {
                    font-size: 1.5rem;
                    line-height: 1.3;
                    margin-top: 1.5rem;
                    margin-bottom: 0.75rem;
                }

                .prose h2 {
                    font-size: 1.25rem;
                    line-height: 1.35;
                    margin-top: 1.25rem;
                    margin-bottom: 0.625rem;
                }

                .prose h3 {
                    font-size: 1.125rem;
                    line-height: 1.4;
                    margin-top: 1rem;
                    margin-bottom: 0.5rem;
                }

                .prose p {
                    margin-top: 0.75rem;
                    margin-bottom: 0.75rem;
                }

                .prose ul,
                .prose ol {
                    margin-top: 0.75rem;
                    margin-bottom: 0.75rem;
                    padding-left: 1.25rem;
                }

                .prose li {
                    margin-top: 0.375rem;
                    margin-bottom: 0.375rem;
                }

                .prose img {
                    margin-top: 1rem;
                    margin-bottom: 1rem;
                }

                .prose pre {
                    font-size: 0.8125rem;
                    padding: 0.75rem;
                    margin-top: 1rem;
                    margin-bottom: 1rem;
                    overflow-x: auto;
                }

                .prose code {
                    font-size: 0.875em;
                }
            }

            /* Ensure touch targets are large enough */
            @media (max-width: 640px) {

                a,
                button {
                    min-height: 44px;
                }
            }

            /* Improve tap highlight */
            * {
                -webkit-tap-highlight-color: transparent;
            }
        </style>
    @endpush
@endsection