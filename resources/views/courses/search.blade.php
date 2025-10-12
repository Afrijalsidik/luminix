@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Search Results</h1>
            <p class="text-gray-600">
                Found <span class="font-semibold">{{ $courses->total() }}</span> courses for 
                "<span class="font-semibold text-blue-600">{{ $query }}</span>"
            </p>
        </div>

        <!-- Search Bar -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <form action="{{ route('courses.search') }}" method="GET">
                <div class="flex gap-2">
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ $query }}"
                        placeholder="Search for courses..."
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    >
                    <button 
                        type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                    >
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Results Grid -->
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
                    <div class="text-gray-400 text-5xl mb-4">🔍</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No courses found</h3>
                    <p class="text-gray-600 mb-4">Try searching with different keywords</p>
                    <a href="{{ route('courses.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                        Browse All Courses →
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($courses->hasPages())
            <div class="mt-8">
                {{ $courses->appends(['q' => $query])->links() }}
            </div>
        @endif
    </div>
</div>
@endsection