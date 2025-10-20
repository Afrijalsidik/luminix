@extends('layouts.frontend')

@section('title', 'My Dashboard')

@section('content')
    <div class="bg-gray-50 min-h-screen">
        
        <!-- Header -->
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
                @php
                    // Set timezone to Indonesia (WIB)
                    date_default_timezone_set('Asia/Jakarta');
                    $hour = date('H');

                    if ($hour >= 5 && $hour < 12) {
                        $greeting = 'Good morning';
                    } elseif ($hour >= 12 && $hour < 15) {
                        $greeting = 'Good afternoon';
                    } elseif ($hour >= 15 && $hour < 18) {
                        $greeting = 'Good evening';
                    } else {
                        $greeting = 'Good night';
                    }
                @endphp

                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-1 sm:mb-2 text-gray-900 leading-tight">
                    {{ $greeting }},  
                    <span class="text-orange-500 block sm:inline">
                        {{ auth()->user()->name }}
                    </span>
                </h1>
                <p class="text-gray-600 text-sm sm:text-base lg:text-lg">Continue your learning journey</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6 mb-6 sm:mb-8">
                <!-- Total Enrolled -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow p-4 sm:p-5 lg:p-6 border-l-4 border-orange-500 hover:shadow-lg transition">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-3 sm:mb-0">
                            <p class="text-xs sm:text-sm text-gray-600 mb-1">Total Enrolled</p>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['total_enrolled'] }}</p>
                        </div>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-orange-50 rounded-lg flex items-center justify-center flex-shrink-0 self-end sm:self-auto">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- In Progress -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow p-4 sm:p-5 lg:p-6 border-l-4 border-yellow-500 hover:shadow-lg transition">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-3 sm:mb-0">
                            <p class="text-xs sm:text-sm text-gray-600 mb-1">In Progress</p>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['active_courses'] }}</p>
                        </div>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-yellow-50 rounded-lg flex items-center justify-center flex-shrink-0 self-end sm:self-auto">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Completed -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow p-4 sm:p-5 lg:p-6 border-l-4 border-green-500 hover:shadow-lg transition">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-3 sm:mb-0">
                            <p class="text-xs sm:text-sm text-gray-600 mb-1">Completed</p>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['completed_courses'] }}</p>
                        </div>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0 self-end sm:self-auto">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Chapters Done -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow p-4 sm:p-5 lg:p-6 border-l-4 border-orange-500 hover:shadow-lg transition">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-3 sm:mb-0">
                            <p class="text-xs sm:text-sm text-gray-600 mb-1">Chapters Done</p>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['total_chapters_completed'] }}</p>
                        </div>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-orange-50 rounded-lg flex items-center justify-center flex-shrink-0 self-end sm:self-auto">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Courses -->
            @if($activeCourses->count() > 0)
                <div class="mb-6 sm:mb-8 lg:mb-12">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-2">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Continue Learning</h2>
                        <a href="{{ route('courses.index') }}" 
                           class="text-orange-500 hover:text-orange-700 font-semibold text-sm transition inline-flex items-center gap-1">
                            Browse More 
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 lg:gap-6">
                        @foreach($activeCourses as $enrollment)
                            @php $course = $enrollment->course; @endphp
                            <div class="bg-white rounded-lg sm:rounded-xl shadow overflow-hidden hover:shadow-xl transition group">
                                <!-- Thumbnail -->
                                <div class="aspect-video bg-gray-200 overflow-hidden relative">
                                    @if($course->thumbnail)
                                        <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-orange-400 to-orange-600">
                                            <span class="text-white text-3xl sm:text-4xl font-bold">{{ substr($course->title, 0, 1) }}</span>
                                        </div>
                                    @endif

                                    <!-- Progress Overlay -->
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-3 sm:p-4">
                                        <div class="flex items-center justify-between text-white text-xs sm:text-sm mb-2">
                                            <span class="font-semibold">{{ $enrollment->progress_percentage }}% Complete</span>
                                        </div>
                                        <div class="w-full bg-white/30 rounded-full h-1.5 sm:h-2">
                                            <div class="bg-orange-500 h-1.5 sm:h-2 rounded-full transition-all"
                                                style="width: {{ $enrollment->progress_percentage }}%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-4 sm:p-5">
                                    <div class="text-xs text-orange-500 font-semibold mb-2 uppercase">{{ $course->category->name }}</div>
                                    <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-orange-500 transition leading-snug">
                                        {{ $course->title }}
                                    </h3>
                                    <p class="text-xs sm:text-sm text-gray-600 mb-3 sm:mb-4">
                                        {{ $course->chapters->count() }} chapters • {{ Str::limit($course->instructor->name, 20) }}
                                    </p>
                                    <a href="{{ route('learn.index', $course->slug) }}"
                                        class="block w-full px-4 py-2 sm:py-2.5 bg-orange-500 text-white text-center rounded-lg hover:bg-orange-600 transition font-semibold text-sm">
                                        Continue Learning
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Completed Courses -->
            @if($completedCourses->count() > 0)
                <div class="mb-6 sm:mb-8 lg:mb-12">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Completed Courses</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 lg:gap-6">
                        @foreach($completedCourses as $enrollment)
                            @php $course = $enrollment->course; @endphp
                            <div class="bg-white rounded-lg sm:rounded-xl shadow overflow-hidden border-2 border-green-200 hover:shadow-xl transition group">
                                <!-- Thumbnail with Completed Badge -->
                                <div class="aspect-video bg-gray-200 overflow-hidden relative">
                                    @if($course->thumbnail)
                                        <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-400 to-green-600">
                                            <span class="text-white text-3xl sm:text-4xl font-bold">{{ substr($course->title, 0, 1) }}</span>
                                        </div>
                                    @endif

                                    <!-- Completed Badge -->
                                    <div class="absolute top-3 right-3">
                                        <div class="px-2 py-1 sm:px-3 sm:py-1.5 bg-green-500 text-white rounded-full text-xs font-bold flex items-center gap-1 shadow-lg">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="hidden sm:inline">Completed</span>
                                            <span class="sm:hidden">Done</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-4 sm:p-5">
                                    <div class="text-xs text-green-600 font-semibold mb-2 uppercase">{{ $course->category->name }}</div>
                                    <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2 line-clamp-2 leading-snug">
                                        {{ $course->title }}
                                    </h3>
                                    <p class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-2">
                                        Completed on {{ $enrollment->completed_at->format('M d, Y') }}
                                    </p>
                                    <p class="text-xs sm:text-sm text-gray-600 mb-3 sm:mb-4">
                                        {{ $course->chapters->count() }} chapters • {{ Str::limit($course->instructor->name, 20) }}
                                    </p>
                                    <a href="{{ route('learn.index', $course->slug) }}"
                                        class="block w-full px-4 py-2 sm:py-2.5 bg-green-600 text-white text-center rounded-lg hover:bg-green-700 transition font-semibold text-sm">
                                        Review Course
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Empty State -->
            @if($activeCourses->count() == 0 && $completedCourses->count() == 0)
                <div class="bg-white rounded-lg sm:rounded-xl shadow p-8 sm:p-10 lg:p-12 text-center">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto bg-orange-50 rounded-full flex items-center justify-center mb-4 sm:mb-6">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Start Your Learning Journey</h3>
                    <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6 max-w-md mx-auto">
                        You haven't enrolled in any courses yet. Explore our catalog to get started!
                    </p>
                    <a href="{{ route('courses.index') }}"
                        class="inline-block px-6 py-2.5 sm:px-8 sm:py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition font-semibold text-sm sm:text-base">
                        Browse Courses
                    </a>
                </div>
            @endif

            <!-- Recommended Courses -->
            @if($recommendedCourses->count() > 0)
                <div class="mt-8 sm:mt-10 lg:mt-12">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Recommended for You</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 lg:gap-6">
                        @foreach($recommendedCourses as $course)
                            <a href="{{ route('courses.show', $course->slug) }}" class="group">
                                <div class="bg-white rounded-lg sm:rounded-xl shadow overflow-hidden hover:shadow-xl transition">
                                    <!-- Thumbnail -->
                                    <div class="aspect-video bg-gray-200 overflow-hidden">
                                        @if($course->thumbnail)
                                            <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-orange-400 to-orange-600">
                                                <span class="text-white text-3xl sm:text-4xl font-bold">{{ substr($course->title, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Content -->
                                    <div class="p-4 sm:p-5">
                                        <div class="text-xs text-orange-500 font-semibold mb-2 uppercase">{{ $course->category->name }}</div>
                                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-orange-500 transition leading-snug">
                                            {{ $course->title }}
                                        </h3>
                                        <p class="text-xs sm:text-sm text-gray-600 mb-3 sm:mb-4 line-clamp-2">
                                            {{ Str::limit($course->description, 80) }}
                                        </p>
                                        <div class="flex items-center justify-between text-xs sm:text-sm text-gray-500">
                                            <span class="truncate mr-2">{{ Str::limit($course->instructor->name, 15) }}</span>
                                            <span class="whitespace-nowrap">{{ $course->enrollments_count }} students</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection