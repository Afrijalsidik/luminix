@extends('layouts.frontend')

@section('title', 'Learning: ' . $course->title)

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <!-- Header -->
        <div class="bg-white border-b sticky top-0 z-10 shadow-sm">
            <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-2.5 sm:py-4">
                <div class="flex items-center justify-between gap-2 sm:gap-3">
                    <!-- Left: Back button & Title -->
                    <div class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                        <a href="{{ route('courses.show', $course->slug) }}"
                            class="flex-shrink-0 text-gray-500 hover:text-orange-500 transition p-1.5 sm:p-2 -ml-1">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div class="min-w-0 flex-1">
                            <h1 class="text-sm sm:text-base lg:text-xl font-bold text-gray-900 truncate leading-tight">
                                {{ $course->title }}</h1>
                            <p class="text-xs sm:text-sm text-gray-500 truncate mt-0.5">{{ $course->category->name }}</p>
                        </div>
                    </div>

                    <!-- Right: Dashboard button -->
                    <a href="{{ route('dashboard') }}"
                        class="hidden sm:inline-flex flex-shrink-0 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition text-sm font-semibold">
                        Dashboard
                    </a>
                    <!-- Mobile dashboard button -->
                    <a href="{{ route('dashboard') }}"
                        class="sm:hidden flex-shrink-0 p-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-4 sm:py-6 lg:py-8">
            <!-- Progress Card -->
            <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 lg:p-8 mb-4 sm:mb-6 lg:mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 mb-4 sm:mb-6">
                    <div>
                        <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-1">Your Progress</h2>
                        <p class="text-xs sm:text-sm lg:text-base text-gray-600">Keep up the great work!</p>
                    </div>
                    @if($enrollment->isCompleted())
                        <div
                            class="flex items-center gap-1.5 sm:gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-green-100 text-green-700 rounded-full font-semibold text-xs sm:text-sm self-start sm:self-auto">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Completed</span>
                        </div>
                    @endif
                </div>

                <!-- Progress Bar -->
                <div class="mb-4 sm:mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs sm:text-sm font-medium text-gray-700">Course Completion</span>
                        <span
                            class="text-lg sm:text-xl lg:text-2xl font-bold text-orange-500">{{ $enrollment->progress_percentage }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-4 sm:h-5 lg:h-6 overflow-hidden shadow-inner">
                        <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-4 sm:h-5 lg:h-6 rounded-full transition-all duration-500 flex items-center justify-end px-2"
                            style="width: {{ $enrollment->progress_percentage }}%">
                            @if($enrollment->progress_percentage > 20)
                                <span class="text-white text-xs font-semibold">{{ $enrollment->progress_percentage }}%</span>
                            @endif
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1.5 sm:mt-2">
                        {{ count($completedChapters) }} of {{ $course->chapters->count() }} chapters completed
                    </p>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-3 lg:gap-4">
                    <div class="text-center p-3 sm:p-4 bg-orange-50 rounded-lg border border-orange-100">
                        <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-orange-500">
                            {{ $course->chapters->count() }}</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1">Total</div>
                    </div>
                    <div class="text-center p-3 sm:p-4 bg-green-50 rounded-lg border border-green-100">
                        <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-green-600">
                            {{ count($completedChapters) }}</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1">Completed</div>
                    </div>
                    <div class="text-center p-3 sm:p-4 bg-yellow-50 rounded-lg border border-yellow-100">
                        <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-yellow-600">
                            {{ $course->chapters->count() - count($completedChapters) }}
                        </div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1">Remaining</div>
                    </div>
                    <div class="text-center p-3 sm:p-4 bg-purple-50 rounded-lg border border-purple-100">
                        @php
                            $days = round($enrollment->enrolled_at->diffInDays(\Carbon\Carbon::now()));
                        @endphp
                        <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-purple-600">
                            {{ $days > 0 ? $days : 0 }}
                        </div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1">Days</div>
                    </div>
                </div>
            </div>

            <!-- Course Content -->
            <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 lg:p-8">
                <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Course Content</h2>

                @if($course->chapters->count() > 0)
                    <div class="space-y-2.5 sm:space-y-3">
                        @foreach($course->chapters as $chapter)
                            <a href="{{ route('learn.chapter', [$course->slug, $chapter->id]) }}"
                                class="block group border-2 rounded-lg transition-all duration-200 {{ in_array($chapter->id, $completedChapters) ? 'border-green-200 bg-green-50 hover:border-green-300' : 'border-gray-200 bg-white hover:border-orange-500 hover:shadow-md' }}">
                                <div class="p-3 sm:p-4 lg:p-5 flex items-center gap-2.5 sm:gap-3 lg:gap-4">
                                    <!-- Chapter Number -->
                                    <div
                                        class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 rounded-lg sm:rounded-xl flex items-center justify-center font-bold text-sm sm:text-base lg:text-lg shadow-sm {{ in_array($chapter->id, $completedChapters) ? 'bg-gradient-to-br from-green-500 to-green-600 text-white' : 'bg-gradient-to-br from-orange-500 to-orange-600 text-white' }}">
                                        {{ $chapter->order }}
                                    </div>

                                    <!-- Chapter Info -->
                                    <div class="flex-1 min-w-0">
                                        <h3
                                            class="font-bold text-gray-900 text-sm sm:text-base lg:text-lg mb-0.5 sm:mb-1 group-hover:text-orange-500 transition line-clamp-2 leading-snug">
                                            {{ $chapter->title }}
                                        </h3>
                                        <p class="text-xs sm:text-sm text-gray-500">
                                            Chapter {{ $chapter->order }} of {{ $course->chapters->count() }}
                                        </p>
                                    </div>

                                    <!-- Status & Arrow -->
                                    <div class="flex-shrink-0 flex items-center gap-1.5 sm:gap-2 lg:gap-3">
                                        @if(in_array($chapter->id, $completedChapters))
                                            <!-- Mobile: Icon only -->
                                            <div
                                                class="sm:hidden flex items-center justify-center w-7 h-7 bg-green-100 text-green-700 rounded-full">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <!-- Desktop: Full badge -->
                                            <div
                                                class="hidden sm:flex items-center gap-1.5 px-2.5 py-1.5 lg:px-3 bg-green-100 text-green-700 rounded-full text-xs lg:text-sm font-semibold whitespace-nowrap">
                                                <svg class="w-3.5 h-3.5 lg:w-4 lg:h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>Done</span>
                                            </div>
                                        @else
                                            <!-- Mobile: Icon only -->
                                            <div
                                                class="sm:hidden flex items-center justify-center w-7 h-7 bg-gray-100 text-gray-500 rounded-full">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <!-- Desktop: Full badge -->
                                            <div
                                                class="hidden sm:block px-2.5 py-1.5 lg:px-3 bg-gray-100 text-gray-600 rounded-full text-xs lg:text-sm font-semibold whitespace-nowrap">
                                                Start
                                            </div>
                                        @endif

                                        <!-- Arrow -->
                                        <svg class="w-5 h-5 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-gray-400 group-hover:text-orange-500 transition flex-shrink-0"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 sm:py-12 bg-gray-50 rounded-lg">
                        <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-gray-300 mb-3 sm:mb-4" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p class="text-gray-500 text-sm sm:text-base lg:text-lg font-semibold">No chapters available</p>
                        <p class="text-gray-400 text-xs sm:text-sm mt-1">Check back later for new content</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        /* Line clamp utility */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Smooth transitions */
        * {
            -webkit-tap-highlight-color: transparent;
        }
    </style>
@endsection