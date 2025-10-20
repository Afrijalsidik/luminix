@extends('layouts.frontend')

@section('title', 'All Courses')

@section('content')
    <!-- Courses Section -->
    <section class="py-10 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">
            <!-- Filter Header -->
            <form method="GET" action="{{ route('courses.index') }}"
                class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4 pb-6 border-b">
                <!-- Filter Button & Category -->
                <div class="flex flex-col md:flex-row md:items-center gap-4 flex-1">
                    <div class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg bg-white">
                        <i class="fas fa-sliders-h text-gray-600"></i>
                        <span class="font-medium">Category</span>
                    </div>

                    <select name="category"
                        class="border border-gray-300 rounded-lg px-4 py-2 text-gray-700 w-full md:w-64">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }} ({{ $category->courses_count }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort By -->
                <div class="flex items-center space-x-3">
                    <span class="text-gray-600">Sort by:</span>
                    <select name="sort" class="border border-gray-300 rounded-lg px-4 py-2 text-gray-700">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    </select>
                </div>

                <button type="submit"
                    class="mt-2 md:mt-0 px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                    Apply
                </button>
            </form>

            <!-- Course Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($courses as $course)
                    <a href="{{ route('courses.show', $course->slug) }}"
                        class="group bg-white rounded-lg overflow-hidden border border-gray-200 hover:shadow-xl transition">
                        <div class="relative overflow-hidden">
                            @if($course->thumbnail)
                                <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                    class="w-full h-48 object-cover group-hover:scale-110 transition duration-300" />
                            @else
                                <div
                                    class="w-full h-48 flex items-center justify-center bg-gradient-to-br from-orange-400 to-orange-600 text-white text-2xl font-bold">
                                    {{ strtoupper(substr($course->title, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-semibold text-orange-500 uppercase">
                                    {{ $course->category->name }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    {{ $course->enrollments_count }} students
                                </span>
                            </div>
                            <h3
                                class="text-base font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-orange-500 transition">
                                {{ $course->title }}
                            </h3>
                            <p class="text-sm text-gray-600 line-clamp-2 mb-4">
                                {{ Str::limit($course->description, 100) }}
                            </p>
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>By {{ $course->instructor->name }}</span>
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-star text-orange-400"></i>
                                    <span>4.5</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-4 text-center py-16">
                        <div class="text-gray-400 text-5xl mb-4">📚</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No courses found</h3>
                        <p class="text-gray-600">Try adjusting your filters</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($courses->hasPages())
                <div class="flex items-center justify-center space-x-2 mt-12">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection