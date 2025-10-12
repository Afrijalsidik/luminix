@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Learn Without Limits
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100">
                    Access thousands of courses and start learning today
                </p>

                <!-- Search Bar -->
                <form action="{{ route('courses.search') }}" method="GET" class="max-w-2xl mx-auto">
                    <div class="flex gap-2">
                        <input 
                            type="text" 
                            name="q" 
                            placeholder="Search for courses..."
                            class="flex-1 px-6 py-4 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300"
                        >
                        <button 
                            type="submit"
                            class="px-8 py-4 bg-blue-500 hover:bg-blue-400 rounded-lg font-semibold transition"
                        >
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-blue-600">{{ $stats['total_courses'] }}</div>
                    <div class="text-gray-600 mt-2">Courses Available</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-600">{{ $stats['total_students'] }}</div>
                    <div class="text-gray-600 mt-2">Active Students</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-600">{{ $stats['total_instructors'] }}</div>
                    <div class="text-gray-600 mt-2">Expert Instructors</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Courses -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Featured Courses</h2>
            <a href="{{ route('courses.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                View All →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($featuredCourses as $course)
                <a href="{{ route('courses.show', $course->slug) }}" class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <!-- Thumbnail -->
                        <div class="aspect-video bg-gray-200 overflow-hidden">
                            @if($course->thumbnail)
                                <img 
                                    src="{{ Storage::url($course->thumbnail) }}" 
                                    alt="{{ $course->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-400 to-blue-600">
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
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ Str::limit($course->description, 100) }}
                            </p>

                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>{{ $course->instructor->name }}</span>
                                <span>{{ $course->enrollments_count }} students</span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center py-12 text-gray-500">
                    No courses available yet.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Categories -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Browse by Category</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('courses.index', ['category' => $category->id]) }}" 
                       class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition text-center">
                        <h3 class="font-bold text-gray-900 mb-2">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $category->courses_count }} courses</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-blue-600 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Start Learning?</h2>
            <p class="text-xl mb-8 text-blue-100">Join thousands of students learning new skills every day</p>
            @guest
                <a href="{{ route('register') }}" class="inline-block px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-blue-50 transition">
                    Get Started Free
                </a>
            @else
                <a href="{{ route('courses.index') }}" class="inline-block px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-blue-50 transition">
                    Browse Courses
                </a>
            @endguest
        </div>
    </div>
@endsection