@extends('layouts.app')

@section('title', 'Learning: ' . $course->title)

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <!-- Header -->
        <div class="bg-white border-b sticky top-0 z-10 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('courses.show', $course->slug) }}"
                            class="text-gray-500 hover:text-gray-700 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">{{ $course->title }}</h1>
                            <p class="text-sm text-gray-500">{{ $course->category->name }}</p>
                        </div>
                    </div>
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition text-sm font-semibold">
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Progress Card -->
            <div class="bg-white rounded-xl shadow-md p-6 md:p-8 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Your Progress</h2>
                        <p class="text-gray-600">Keep up the great work!</p>
                    </div>
                    @if($enrollment->isCompleted())
                        <div class="flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-full font-semibold">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Completed
                        </div>
                    @endif
                </div>

                <!-- Progress Bar -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-700">Course Completion</span>
                        <span class="text-2xl font-bold text-blue-600">{{ $enrollment->progress_percentage }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-6 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-6 rounded-full transition-all duration-500 flex items-center justify-end px-2"
                            style="width: {{ $enrollment->progress_percentage }}%">
                            @if($enrollment->progress_percentage > 10)
                                <span class="text-white text-xs font-semibold">{{ $enrollment->progress_percentage }}%</span>
                            @endif
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">
                        {{ count($completedChapters) }} of {{ $course->chapters->count() }} chapters completed
                    </p>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="text-2xl font-bold text-blue-600">{{ $course->chapters->count() }}</div>
                        <div class="text-sm text-gray-600">Total Chapters</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <div class="text-2xl font-bold text-green-600">{{ count($completedChapters) }}</div>
                        <div class="text-sm text-gray-600">Completed</div>
                    </div>
                    <div class="text-center p-4 bg-yellow-50 rounded-lg">
                        <div class="text-2xl font-bold text-yellow-600">
                            {{ $course->chapters->count() - count($completedChapters) }}
                        </div>
                        <div class="text-sm text-gray-600">Remaining</div>
                    </div>
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        @php
                            $days = round($enrollment->enrolled_at->diffInDays(\Carbon\Carbon::now()));
                        @endphp

                        <div class="text-2xl font-bold text-purple-600">
                            {{ $days > 0 ? $days : 0 }}
                        </div>
                        <div class="text-sm text-gray-600">Days Learning</div>

                    </div>
                </div>
            </div>

            <!-- Course Content -->
            <div class="bg-white rounded-xl shadow-md p-6 md:p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Course Content</h2>

                @if($course->chapters->count() > 0)
                    <div class="space-y-3">
                        @foreach($course->chapters as $chapter)
                            <a href="{{ route('learn.chapter', [$course->slug, $chapter->id]) }}"
                                class="block group border-2 rounded-lg transition-all duration-200 {{ in_array($chapter->id, $completedChapters) ? 'border-green-200 bg-green-50 hover:border-green-300' : 'border-gray-200 bg-white hover:border-blue-300 hover:shadow-md' }}">
                                <div class="p-5 flex items-center gap-4">
                                    <!-- Chapter Number -->
                                    <div
                                        class="flex-shrink-0 w-14 h-14 rounded-xl flex items-center justify-center font-bold text-lg shadow-md {{ in_array($chapter->id, $completedChapters) ? 'bg-gradient-to-br from-green-500 to-green-600 text-white' : 'bg-gradient-to-br from-blue-500 to-blue-600 text-white' }}">
                                        {{ $chapter->order }}
                                    </div>

                                    <!-- Chapter Info -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-bold text-gray-900 text-lg mb-1 group-hover:text-blue-600 transition">
                                            {{ $chapter->title }}
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            Chapter {{ $chapter->order }} of {{ $course->chapters->count() }}
                                        </p>
                                    </div>

                                    <!-- Status -->
                                    <div class="flex-shrink-0 flex items-center gap-3">
                                        @if(in_array($chapter->id, $completedChapters))
                                            <div
                                                class="flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Completed
                                            </div>
                                        @else
                                            <div class="px-4 py-2 bg-gray-100 text-gray-600 rounded-full text-sm font-semibold">
                                                Not Started
                                            </div>
                                        @endif

                                        <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-600 transition" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-lg">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p class="text-gray-500 text-lg font-semibold">No chapters available</p>
                        <p class="text-gray-400 text-sm mt-1">Check back later for new content</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection