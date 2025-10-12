@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="text-blue-100 text-lg">Continue your learning journey</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Total Enrolled</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_enrolled'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">In Progress</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['active_courses'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Completed</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['completed_courses'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Chapters Done</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_chapters_completed'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Courses -->
            @if($activeCourses->count() > 0)
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Continue Learning</h2>
                        <a href="{{ route('courses.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                            Browse More →
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($activeCourses as $enrollment)
                            @php $course = $enrollment->course; @endphp
                            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition group">
                                <!-- Thumbnail -->
                                <div class="aspect-video bg-gray-200 overflow-hidden relative">
                                    @if($course->thumbnail)
                                        <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-400 to-blue-600">
                                            <span class="text-white text-4xl font-bold">{{ substr($course->title, 0, 1) }}</span>
                                        </div>
                                    @endif

                                    <!-- Progress Overlay -->
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                        <div class="flex items-center justify-between text-white text-sm mb-2">
                                            <span class="font-semibold">{{ $enrollment->progress_percentage }}% Complete</span>
                                        </div>
                                        <div class="w-full bg-white/30 rounded-full h-2">
                                            <div class="bg-white h-2 rounded-full transition-all"
                                                style="width: {{ $enrollment->progress_percentage }}%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-5">
                                    <div class="text-xs text-blue-600 font-semibold mb-2">{{ $course->category->name }}</div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition">
                                        {{ $course->title }}
                                    </h3>
                                    <p class="text-sm text-gray-600 mb-4">
                                        {{ $course->chapters->count() }} chapters • {{ $course->instructor->name }}
                                    </p>
                                    <a href="{{ route('learn.index', $course->slug) }}"
                                        class="block w-full px-4 py-2 bg-blue-600 text-white text-center rounded-lg hover:bg-blue-700 transition font-semibold">
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
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Completed Courses</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($completedCourses as $enrollment)
                            @php $course = $enrollment->course; @endphp
                            <div
                                class="bg-white rounded-xl shadow-md overflow-hidden border-2 border-green-200 hover:shadow-xl transition group">
                                <!-- Thumbnail with Completed Badge -->
                                <div class="aspect-video bg-gray-200 overflow-hidden relative">
                                    @if($course->thumbnail)
                                        <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-400 to-green-600">
                                            <span class="text-white text-4xl font-bold">{{ substr($course->title, 0, 1) }}</span>
                                        </div>
                                    @endif

                                    <!-- Completed Badge -->
                                    <div class="absolute top-4 right-4">
                                        <div
                                            class="px-3 py-1 bg-green-500 text-white rounded-full text-xs font-bold flex items-center gap-1 shadow-lg">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Completed
                                        </div>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-5">
                                    <div class="text-xs text-green-600 font-semibold mb-2">{{ $course->category->name }}</div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">
                                        {{ $course->title }}
                                    </h3>
                                    <p class="text-sm text-gray-600 mb-2">
                                        Completed on {{ $enrollment->completed_at->format('M d, Y') }}
                                    </p>
                                    <p class="text-sm text-gray-600 mb-4">
                                        {{ $course->chapters->count() }} chapters • {{ $course->instructor->name }}
                                    </p>
                                    <a href="{{ route('learn.index', $course->slug) }}"
                                        class="block w-full px-4 py-2 bg-green-600 text-white text-center rounded-lg hover:bg-green-700 transition font-semibold">
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
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <div class="w-24 h-24 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Start Your Learning Journey</h3>
                    <p class="text-gray-600 mb-6">You haven't enrolled in any courses yet. Explore our catalog to get started!
                    </p>
                    <a href="{{ route('courses.index') }}"
                        class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                        Browse Courses
                    </a>
                </div>
            @endif

            <!-- Recommended Courses -->
            @if($recommendedCourses->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Recommended for You</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($recommendedCourses as $course)
                            <a href="{{ route('courses.show', $course->slug) }}" class="group">
                                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
                                    <!-- Thumbnail -->
                                    <div class="aspect-video bg-gray-200 overflow-hidden">
                                        @if($course->thumbnail)
                                            <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-400 to-blue-600">
                                                <span class="text-white text-4xl font-bold">{{ substr($course->title, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Content -->
                                    <div class="p-5">
                                        <div class="text-xs text-blue-600 font-semibold mb-2">{{ $course->category->name }}</div>
                                        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition">
                                            {{ $course->title }}
                                        </h3>
                                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                            {{ Str::limit($course->description, 80) }}
                                        </p>
                                        <div class="flex items-center justify-between text-sm text-gray-500">
                                            <span>{{ $course->instructor->name }}</span>
                                            <span>{{ $course->enrollments_count }} students</span>
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