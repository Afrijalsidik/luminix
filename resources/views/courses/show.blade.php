@extends('layouts.frontend')

@section('title', $course->title)

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <!-- Hero Section -->
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 items-center">
                    <!-- Left: Course Info -->
                    <div>
                        <!-- Breadcrumb -->
                        <div class="flex flex-wrap items-center gap-2 text-xs sm:text-sm text-gray-500 mb-3 sm:mb-4">
                            <a href="{{ route('landing') }}" class="hover:text-gray-900 transition">Home</a>
                            <span>/</span>
                            <a href="{{ route('courses.index') }}" class="hover:text-gray-900 transition">Courses</a>
                            <span>/</span>
                            <a href="{{ route('courses.index', ['category' => $course->category_id]) }}"
                                class="hover:text-orange-500 transition truncate max-w-[120px] sm:max-w-none">
                                {{ $course->category->name }}
                            </a>
                        </div>

                        <!-- Category Badge -->
                        <div
                            class="inline-block px-3 py-1 bg-orange-500 text-white text-xs sm:text-sm font-semibold rounded-full mb-3 sm:mb-4">
                            {{ $course->category->name }}
                        </div>

                        <!-- Title -->
                        <h1
                            class="text-xl sm:text-2xl lg:text-3xl xl:text-4xl font-bold mb-3 sm:mb-4 leading-tight text-gray-900">
                            {{ $course->title }}
                        </h1>

                        <!-- Short Description -->
                        <p class="text-sm sm:text-base lg:text-lg text-gray-700 mb-4 sm:mb-6 leading-relaxed">
                            {{ Str::limit($course->description, 200) }}
                        </p>

                        <!-- Course Meta Info -->
                        <div class="flex flex-wrap items-center gap-3 sm:gap-4 lg:gap-6 text-xs sm:text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div class="min-w-0">
                                    <span class="text-gray-500">Instructor:</span>
                                    <span
                                        class="font-semibold ml-1 text-gray-800 uppercase truncate">{{ Str::limit($course->instructor->name, 15) }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <div>
                                    <span class="font-semibold text-gray-800">{{ $course->enrollments_count }}</span>
                                    <span
                                        class="text-gray-700 ml-1">{{ $course->enrollments_count == 1 ? 'Student' : 'Students' }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <div>
                                    <span class="font-semibold text-gray-800">{{ $course->chapters->count() }}</span>
                                    <span
                                        class="text-gray-700 ml-1">{{ $course->chapters->count() == 1 ? 'Chapter' : 'Chapters' }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-orange-500 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-bold text-orange-500">FREE</span>
                            </div>
                        </div>

                        <!-- Created Date -->
                        <div class="mt-3 sm:mt-4 text-xs sm:text-sm text-gray-500">
                            Created: <span
                                class="text-gray-800 font-semibold">{{ $course->created_at->format('F d, Y') }}</span>
                        </div>
                    </div>

                    <!-- Right: Thumbnail -->
                    <div class="flex items-center justify-center mt-4 lg:mt-0">
                        <div class="w-full">
                            <div class="aspect-video bg-gray-200 rounded-lg lg:rounded-xl overflow-hidden shadow">
                                @if($course->thumbnail)
                                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-orange-400 to-orange-600">
                                        <span class="text-white text-4xl sm:text-5xl lg:text-6xl font-bold opacity-50">
                                            {{ substr($course->title, 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Left Column: Main Content -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- What You'll Learn -->
                    @if($course->chapters->count() > 0)
                        <div class="bg-white rounded-lg shadow p-5 sm:p-6 lg:p-8">
                            <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">What You'll Learn
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                @foreach($course->chapters->take(6) as $chapter)
                                    <div class="flex items-start gap-2 sm:gap-3">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm sm:text-base text-gray-700 leading-snug">{{ $chapter->title }}</span>
                                    </div>
                                @endforeach
                                @if($course->chapters->count() > 6)
                                    <div class="flex items-start gap-2 sm:gap-3 text-orange-600 font-semibold">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mt-0.5 flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm sm:text-base">And {{ $course->chapters->count() - 6 }} more
                                            chapters...</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Course Curriculum -->
                    <div class="bg-white rounded-lg shadow p-5 sm:p-6 lg:p-8">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900">Course Curriculum</h2>
                            <div class="text-xs sm:text-sm text-gray-500 whitespace-nowrap">
                                {{ $course->chapters->count() }}
                                {{ $course->chapters->count() == 1 ? 'Chapter' : 'Chapters' }}
                            </div>
                        </div>

                        @if($course->chapters->count() > 0)
                            <div class="space-y-3">
                                @foreach($course->chapters as $index => $chapter)
                                    <div
                                        class="group border-2 border-gray-200 rounded-lg hover:border-orange-300 hover:shadow transition-all duration-200">
                                        <div class="p-3 sm:p-4 lg:p-5 flex items-center gap-3 sm:gap-4">
                                            <!-- Chapter Number -->
                                            <div
                                                class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-orange-400 to-orange-600 text-white rounded-full flex items-center justify-center font-bold text-sm sm:text-base lg:text-lg shadow">
                                                {{ $chapter->order }}
                                            </div>

                                            <!-- Chapter Info -->
                                            <div class="flex-1 min-w-0">
                                                <h3
                                                    class="font-bold text-gray-900 text-sm sm:text-base lg:text-lg mb-1 group-hover:text-orange-600 transition line-clamp-2">
                                                    {{ $chapter->title }}
                                                </h3>
                                                <p class="text-xs sm:text-sm text-gray-500">
                                                    Chapter {{ $chapter->order }} of {{ $course->chapters->count() }}
                                                </p>
                                            </div>

                                            <!-- Status Badge -->
                                            <div class="flex-shrink-0">
                                                @if($isEnrolled)
                                                    @if($chapter->isCompletedBy(auth()->id()))
                                                        <div
                                                            class="flex items-center gap-1 sm:gap-2 px-2 sm:px-3 py-1 sm:py-1.5 bg-green-100 text-green-700 rounded-full text-xs font-semibold whitespace-nowrap">
                                                            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="hidden sm:inline">Completed</span>
                                                            <span class="sm:hidden">Done</span>
                                                        </div>
                                                    @else
                                                        <div
                                                            class="px-2 sm:px-3 py-1 sm:py-1.5 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold whitespace-nowrap">
                                                            Not Started
                                                        </div>
                                                    @endif
                                                @else
                                                    <div
                                                        class="flex items-center gap-1 sm:gap-2 px-2 sm:px-3 py-1 sm:py-1.5 bg-gray-100 text-gray-500 rounded-full text-xs whitespace-nowrap">
                                                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="hidden sm:inline">Locked</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 sm:py-12 bg-gray-50 rounded-lg">
                                <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-gray-300 mb-3 sm:mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="text-gray-500 text-base sm:text-lg font-semibold">No chapters available yet</p>
                                <p class="text-gray-400 text-xs sm:text-sm mt-1">The instructor is working on adding content</p>
                            </div>
                        @endif
                    </div>

                    <!-- Instructor Info -->
                    <div class="bg-white rounded-lg shadow p-5 sm:p-6 lg:p-8">
                        <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Instructor</h2>
                        <div class="flex items-start gap-3 sm:gap-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center text-white text-lg sm:text-2xl font-bold uppercase">
                                {{ substr($course->instructor->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base sm:text-lg font-bold text-gray-900 uppercase truncate">
                                    {{ $course->instructor->name }}</h3>
                                <p class="text-gray-600 mb-2 text-sm sm:text-base">{{ ucfirst($course->instructor->role) }}
                                </p>
                                <div class="flex items-center gap-1 sm:gap-2 text-xs sm:text-sm text-gray-500">
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

                <!-- Right Column: Sidebar -->
                <div class="lg:col-span-1">
                    <div class="lg:sticky lg:top-8 space-y-6">
                        <!-- Enrollment Card -->
                        <div class="bg-white rounded-lg shadow p-5 sm:p-6 border border-gray-100">
                            @guest
                                <!-- Not Logged In -->
                                <div class="text-center mb-6">
                                    <div
                                        class="w-16 h-16 sm:w-20 sm:h-20 mx-auto bg-orange-500 rounded-full flex items-center justify-center mb-4 shadow">
                                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Start Learning Today</h3>
                                    <p class="text-sm sm:text-base text-gray-600">Sign up to enroll in this course for free</p>
                                </div>
                                <div class="space-y-3">
                                    <a href="{{ route('register') }}"
                                        class="block w-full px-6 py-3 sm:py-4 bg-orange-500 text-white text-center font-bold rounded-lg hover:bg-orange-600 transition text-sm sm:text-base">
                                        Sign Up Now
                                    </a>
                                    <a href="{{ route('login') }}"
                                        class="block w-full px-6 py-3 sm:py-4 bg-gray-100 text-gray-700 text-center font-semibold rounded-lg hover:bg-gray-200 transition text-sm sm:text-base">
                                        Already have an account?
                                    </a>
                                </div>
                            @else
                                @if($isEnrolled)
                                    <!-- Already Enrolled -->
                                    <div class="text-center mb-6">
                                        @if($enrollment->isCompleted())
                                            <div
                                                class="w-16 h-16 sm:w-20 sm:h-20 mx-auto bg-green-500 rounded-full flex items-center justify-center mb-4 shadow">
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Course Completed!</h3>
                                            <p class="text-green-600 font-semibold mb-1 text-sm sm:text-base">Congratulations!</p>
                                            <p class="text-gray-600 text-xs sm:text-sm">You can review the content anytime</p>
                                        @else
                                            <div
                                                class="w-16 h-16 sm:w-20 sm:h-20 mx-auto bg-orange-500 rounded-full flex items-center justify-center mb-4 shadow">
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4">You're Enrolled!</h3>

                                            <!-- Progress Bar -->
                                            <div class="mb-2">
                                                <div class="flex justify-between items-center mb-2">
                                                    <span class="text-xs sm:text-sm font-medium text-gray-700">Your Progress</span>
                                                    <span
                                                        class="text-xs sm:text-sm font-bold text-gray-800">{{ $enrollment->progress_percentage }}%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-3 sm:h-4 overflow-hidden shadow-inner">
                                                    <div class="bg-orange-500 h-3 sm:h-4 rounded-full transition-all duration-500"
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
                                            class="block w-full px-6 py-3 sm:py-4 bg-orange-500 text-white text-center font-bold rounded-lg hover:bg-orange-600 transition shadow text-sm sm:text-base">
                                            <span class="flex items-center justify-center gap-2">
                                                @if($enrollment->isCompleted())
                                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                    </svg>
                                                    Review Course
                                                @else
                                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
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
                                                class="w-full px-6 py-2.5 sm:py-3 bg-red-50 text-red-600 text-center font-semibold rounded-lg hover:bg-red-100 transition border border-red-200 text-sm sm:text-base">
                                                Unenroll from Course
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <!-- Not Enrolled -->
                                    <div class="text-center mb-6">
                                        <div
                                            class="w-16 h-16 sm:w-20 sm:h-20 mx-auto bg-orange-500 rounded-full flex items-center justify-center mb-4 shadow">
                                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Ready to Start?</h3>
                                        <p class="text-sm sm:text-base text-gray-600">Enroll now and start learning for free</p>
                                    </div>
                                    <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full px-6 py-3 sm:py-4 bg-orange-500 text-white text-center font-bold rounded-lg hover:bg-orange-600 transition shadow text-sm sm:text-base">
                                            <span class="flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
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
                                <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2 text-sm sm:text-base">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-orange-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Course Information
                                </h4>
                                <div class="space-y-3 sm:space-y-4">
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                            <span class="text-xs sm:text-sm">Level</span>
                                        </div>
                                        <span class="font-semibold text-gray-900 text-xs sm:text-sm">All Levels</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            <span class="text-xs sm:text-sm">Chapters</span>
                                        </div>
                                        <span
                                            class="font-semibold text-gray-900 text-xs sm:text-sm">{{ $course->chapters->count() }}</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <span class="text-xs sm:text-sm">Students</span>
                                        </div>
                                        <span
                                            class="font-semibold text-gray-900 text-xs sm:text-sm">{{ $course->enrollments_count }}</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-xs sm:text-sm">Last Updated</span>
                                        </div>
                                        <span
                                            class="font-semibold text-gray-900 text-xs sm:text-sm">{{ $course->updated_at->format('M Y') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between py-2">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-xs sm:text-sm">Price</span>
                                        </div>
                                        <span class="font-bold text-orange-500 text-base sm:text-lg">FREE</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Share Course -->
                        <div
                            class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg shadow p-5 sm:p-6 border border-orange-200">
                            <h4 class="font-bold text-gray-900 mb-3 sm:mb-4 flex items-center gap-2 text-sm sm:text-base">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                Share This Course
                            </h4>
                            <p class="text-xs sm:text-sm text-gray-600 mb-3 sm:mb-4">Help others discover this course</p>
                            <button onclick="copyToClipboard('{{ route('courses.show', $course->slug) }}')"
                                class="w-full px-4 py-2.5 sm:py-3 bg-white text-gray-700 rounded-lg hover:bg-gray-50 transition border border-gray-300 font-semibold text-sm flex items-center justify-center gap-2">
                                <span>📋</span>
                                <span>Copy Link</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('error'))
        <div id="flash-message"
            class="fixed bottom-4 left-4 right-4 sm:left-auto sm:right-4 sm:max-w-md bg-red-500 text-white px-4 sm:px-6 py-3 sm:py-4 rounded-lg shadow z-50 animate-slide-up">
            <div class="flex items-center gap-2 sm:gap-3">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm sm:text-base">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div id="flash-message"
            class="fixed bottom-4 left-4 right-4 sm:left-auto sm:right-4 sm:max-w-md bg-green-500 text-white px-4 sm:px-6 py-3 sm:py-4 rounded-lg shadow z-50 animate-slide-up">
            <div class="flex items-center gap-2 sm:gap-3">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm sm:text-base">{{ session('success') }}</span>
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
                    flashMessage.style.transition = 'opacity 0.3s ease';
                    setTimeout(() => flashMessage.remove(), 300);
                }
            }, 5000);

            // Copy to clipboard function
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(function () {
                    // Create temporary success message
                    const btn = event.target.closest('button');
                    const originalHTML = btn.innerHTML;
                    btn.innerHTML = '<span>✓</span><span>Link Copied!</span>';
                    btn.classList.add('bg-green-100', 'text-green-700', 'border-green-300');

                    setTimeout(() => {
                        btn.innerHTML = originalHTML;
                        btn.classList.remove('bg-green-100', 'text-green-700', 'border-green-300');
                    }, 2000);
                }, function (err) {
                    alert('Could not copy link. Please try again.');
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

            /* Line clamp for text truncation */
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    @endpush
@endsection