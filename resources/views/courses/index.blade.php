@extends('layouts.app')

@section('title', 'All Courses')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">All Courses</h1>
            <p class="text-gray-600">Explore our collection of courses</p>
        </div>

        <!-- Filters & Sorting -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <form method="GET" action="{{ route('courses.index') }}" class="flex flex-col md:flex-row gap-4">
                <!-- Category Filter -->
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }} ({{ $category->courses_count }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort By -->
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                    <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex items-end">
                    <button type="submit" class="w-full md:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($courses as $course)
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
                <div class="col-span-3 text-center py-12">
                    <div class="text-gray-400 text-5xl mb-4">📚</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No courses found</h3>
                    <p class="text-gray-600">Try adjusting your filters</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($courses->hasPages())
            <div class="mt-8">
                {{ $courses->links() }}
            </div>
        @endif
    </div>
</div>
@endsection