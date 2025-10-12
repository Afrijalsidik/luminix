@extends('layouts.app')

@section('title', $course->title)

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <!-- Left: Course Info -->
                    <div>
                        <!-- Breadcrumb -->
                        <div class="flex items-center gap-2 text-sm text-blue-200 mb-4">
                            <a href="{{ route('landing') }}" class="hover:text-white transition">Home</a>
                            <span>/</span>
                            <a href="{{ route('courses.index') }}" class="hover:text-white transition">Courses</a>
                            <span>/</span>
                            <a href="{{ route('courses.index', ['category' => $course->category_id]) }}"
                                class="hover:text-white transition">
                                {{ $course->category->name }}
                            </a>
                        </div>

                        <!-- Category Badge -->
                        <div class="inline-block px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded-full mb-4">
                            {{ $course->category->name }}
                        </div>

                        <!-- Title -->
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                            {{ $course->title }}
                        </h1>

                        <!-- Short Description -->
                        <p class="text-lg text-blue-100 mb-6 leading-relaxed">
                            {{ Str::limit($course->description, 200) }}
                        </p>

                        <!-- Course Meta Info -->
                        <div class="flex flex-wrap items-center gap-4 md:gap-6 text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div>
                                    <span class="text-blue-200">Instructor:</span>
                                    <span class="font-semibold ml-1">{{ $course->instructor->name }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <div>
                                    <span class="font-semibold">{{ $course->enrollments_count }}</span>
                                    <span
                                        class="text-blue-200 ml-1">{{ $course->enrollments_count == 1 ? 'Student' : 'Students' }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <div>
                                    <span class="font-semibold">{{ $course->chapters->count() }}</span>
                                    <span
                                        class="text-blue-200 ml-1">{{ $course->chapters->count() == 1 ? 'Chapter' : 'Chapters' }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <span class="font-semibold text-green-400">FREE</span>
                                </div>
                            </div>
                        </div>

                        <!-- Created Date -->
                        <div class="mt-4 text-sm text-blue-200">
                            Created: {{ $course->created_at->format('F d, Y') }}
                        </div>
                    </div>

                    <!-- Right: Thumbnail -->
                    <div class="flex items-center justify-center">
                        <div class="w-full max-w-lg">
                            <div
                                class="aspect-video bg-white/10 rounded-xl overflow-hidden backdrop-blur-sm shadow-2xl border-4 border-white/20">
                                @if($course->thumbnail)
                                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-blue-700">
                                        <div class="text-center">
                                            <span class="text-white text-6xl md:text-8xl font-bold opacity-50">
                                                {{ substr($course->title, 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Left Column: Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- About Course -->
                    <div class="bg-white rounded-xl shadow-md p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">About This Course</h2>
                        </div>
                        <div class="prose prose-blue max-w-none">
                            <p class="text-gray-700 text-base md:text-lg leading-relaxed whitespace-pre-line">
                                {{ $course->description }}
                            </p>
                        </div>
                    </div>

                    <!-- What You'll Learn -->
                    @if($course->chapters->count() > 0)
                        <div class="bg-white rounded-xl shadow-md p-6 md:p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">What You'll Learn</h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($course->chapters->take(6) as $chapter)
                                    <div class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-gray-700">{{ $chapter->title }}</span>
                                    </div>
                                @endforeach
                                @if($course->chapters->count() > 6)
                                    <div class="flex items-start gap-3 text-blue-600 font-semibold">
                                        <svg class="w-5 h-5 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>And {{ $course->chapters->count() - 6 }} more chapters...</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Course Curriculum -->
                    <div class="bg-white rounded-xl shadow-md p-6 md:p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Course Curriculum</h2>
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $course->chapters->count() }}
                                {{ $course->chapters->count() == 1 ? 'Chapter' : 'Chapters' }}
                            </div>
                        </div>

                        @if($course->chapters->count() > 0)
                            <div class="space-y-3">
                                @foreach($course->chapters as $index => $chapter)
                                    <div
                                        class="group border-2 border-gray-200 rounded-lg hover:border-blue-300 hover:shadow-md transition-all duration-200">
                                        <div class="p-4 md:p-5 flex items-center gap-4">
                                            <!-- Chapter Number -->
                                            <div
                                                class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-md">
                                                {{ $chapter->order }}
                                            </div>

                                            <!-- Chapter Info -->
                                            <div class="flex-1 min-w-0">
                                                <h3
                                                    class="font-bold text-gray-900 text-base md:text-lg mb-1 group-hover:text-blue-600 transition">
                                                    {{ $chapter->title }}
                                                </h3>
                                                <p class="text-sm text-gray-500">
                                                    Chapter {{ $chapter->order }} of {{ $course->chapters->count() }}
                                                </p>
                                            </div>

                                            <!-- Status Badge -->
                                            <div class="flex-shrink-0">
                                                @if($isEnrolled)
                                                    @if($chapter->isCompletedBy(auth()->id()))
                                                        <div
                                                            class="flex items-center gap-2 px-3 py-1.5 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <span>Completed</span>
                                                        </div>
                                                    @else
                                                        <div
                                                            class="px-3 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-semibold">
                                                            Not Started
                                                        </div>
                                                    @endif
                                                @else
                                                    <div
                                                        class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-gray-500 rounded-full text-sm">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <span>Locked</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12 bg-gray-50 rounded-lg">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="text-gray-500 text-lg font-semibold">No chapters available yet</p>
                                <p class="text-gray-400 text-sm mt-1">The instructor is working on adding content</p>
                            </div>
                        @endif
                    </div>

                    <!-- Instructor Info -->
                    <div class="bg-white rounded-xl shadow-md p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Instructor</h2>
                        </div>
                        <div class="flex items-start gap-4">
                            <div
                                class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold uppercase">
                                {{ substr($course->instructor->name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900 mb-1 uppercase">{{ $course->instructor->name }}
                                </h3>
                                <p class="text-gray-600 mb-3">{{ ucfirst($course->instructor->role) }}</p>
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                        </svg>
                                        <span>{{ $course->instructor->courses->count() }}
                                            {{ $course->instructor->courses->count() == 1 ? 'Course' : 'Courses' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-8 space-y-6">
                        <!-- Enrollment Card -->
                        <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100">
                            @guest
                                <!-- Not Logged In -->
                                <div class="text-center mb-6">
                                    <div
                                        class="w-20 h-20 mx-auto bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mb-4 shadow-lg">
                                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Start Learning Today</h3>
                                    <p class="text-gray-600">Sign up to enroll in this course for free</p>
                                </div>
                                <div class="space-y-3">
                                    <a href="{{ route('register') }}"
                                        class="block w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-center font-bold rounded-lg hover:from-blue-700 hover:to-blue-800 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        Sign Up Now
                                    </a>
                                    <a href="{{ route('login') }}"
                                        class="block w-full px-6 py-4 bg-gray-100 text-gray-700 text-center font-semibold rounded-lg hover:bg-gray-200 transition">
                                        Already have an account?
                                    </a>
                                </div>
                            @else
                                @if($isEnrolled)
                                    <!-- Already Enrolled -->
                                    <div class="text-center mb-6">
                                        @if($enrollment->isCompleted())
                                            <div
                                                class="w-20 h-20 mx-auto bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mb-4 shadow-lg">
                                                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Course Completed!</h3>
                                            <p class="text-green-600 font-semibold mb-1">Congratulations!</p>
                                            <p class="text-gray-600 text-sm">You can review the content anytime</p>
                                        @else
                                            <div
                                                class="w-20 h-20 mx-auto bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mb-4 shadow-lg">
                                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <h3 class="text-2xl font-bold text-gray-900 mb-4">You're Enrolled!</h3>

                                            <!-- Progress Bar -->
                                            <div class="mb-2">
                                                <div class="flex justify-between items-center mb-2">
                                                    <span class="text-sm font-medium text-gray-700">Your Progress</span>
                                                    <span
                                                        class="text-sm font-bold text-blue-600">{{ $enrollment->progress_percentage }}%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden shadow-inner">
                                                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-4 rounded-full transition-all duration-500 shadow-sm"
                                                        style="width: {{ $enrollment->progress_percentage }}%"></div>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-2">
                                                    {{ $course->chapters->filter(fn($ch) => $ch->isCompletedBy(auth()->id()))->count() }}
                                                    of {{ $course->chapters->count() }} chapters completed
                                                </p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="space-y-3">
                                        <a href="{{ route('learn.index', $course->slug) }}"
                                            class="block w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-center font-bold rounded-lg hover:from-blue-700 hover:to-blue-800 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                            <span class="flex items-center justify-center gap-2">
                                                @if($enrollment->isCompleted())
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                    </svg>
                                                    Review Course
                                                @else
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Continue Learning
                                                @endif
                                            </span>
                                        </a>
                                        <form action="{{ route('courses.unenroll', $course) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to unenroll from this course? Your progress will be lost.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full px-6 py-3 bg-red-50 text-red-600 text-center font-semibold rounded-lg hover:bg-red-100 transition border border-red-200">
                                                Unenroll from Course
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <!-- Not Enrolled -->
                                    <div class="text-center mb-6">
                                        <div
                                            class="w-20 h-20 mx-auto bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mb-4 shadow-lg">
                                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Ready to Start?</h3>
                                        <p class="text-gray-600">Enroll now and start learning for free</p>
                                    </div>
                                    <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-center font-bold rounded-lg hover:from-blue-700 hover:to-blue-800 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                            <span class="flex items-center justify-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                Enroll for Free
                                            </span>
                                        </button>
                                    </form>
                                @endif
                            @endguest

                            <!-- Course Information -->
                            <div class="mt-6 pt-6 border-t-2 border-gray-100">
                                <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Course Information
                                </h4>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                            <span class="text-sm">Level</span>
                                        </div>
                                        <span class="font-semibold text-gray-900">All Levels</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            <span class="text-sm">Chapters</span>
                                        </div>
                                        <span class="font-semibold text-gray-900">{{ $course->chapters->count() }}</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <span class="text-sm">Students</span>
                                        </div>
                                        <span class="font-semibold text-gray-900">{{ $course->enrollments_count }}</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-sm">Last Updated</span>
                                        </div>
                                        <span
                                            class="font-semibold text-gray-900">{{ $course->updated_at->format('M Y') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-sm">Price</span>
                                        </div>
                                        <span class="font-bold text-green-600 text-lg">FREE</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Share Course -->
                        <div
                            class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-md p-6 border border-blue-200">
                            <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                Share This Course
                            </h4>
                            <p class="text-sm text-gray-600 mb-4">Help others discover this course</p>
                            <div class="flex gap-2">
                                <button onclick="copyToClipboard('{{ route('courses.show', $course->slug) }}')"
                                    class="flex-1 px-4 py-3 bg-white text-gray-700 rounded-lg hover:bg-gray-50 transition border border-gray-300 font-semibold text-sm">
                                    📋 Copy Link
                                </button>
                            </div>
                        </div>

                        <!-- Report Course (if logged in) -->
                        @auth
                            <div class="bg-gray-50 rounded-xl shadow-md p-6 border border-gray-200">
                                <p class="text-sm text-gray-600 text-center">
                                    Found an issue with this course?
                                    <a href="mailto:support@lms.com?subject=Report Course: {{ $course->title }}"
                                        class="text-blue-600 hover:text-blue-800 font-semibold block mt-2">
                                        Report to Admin
                                    </a>
                                </p>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages (Success/Error) -->
    @if(session('error'))
        <div id="flash-message"
            class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 animate-slide-up">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

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
            // Auto hide flash message after 5 seconds
            setTimeout(function () {
                const flashMessage = document.getElementById('flash-message');
                if (flashMessage) {
                    flashMessage.style.opacity = '0';
                    setTimeout(() => flashMessage.remove(), 300);
                }
            }, 5000);

            // Copy to clipboard function
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(function () {
                    alert('Link copied to clipboard!');
                }, function (err) {
                    console.error('Could not copy text: ', err);
                });
            }
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