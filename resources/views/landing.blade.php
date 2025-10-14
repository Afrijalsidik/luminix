@extends('layouts.frontend')

@section('title', 'Home - Luminix LMS')

@section('content')
    <!-- Hero Section -->
    <section class="bg-white">
        <div class="mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="justify-center mx-auto">
                    <h1 class="text-7xl font-semibold text-gray-900 leading-none mb-6">
                        Learn with expert<br />anytime anywhere
                    </h1>
                    <p class="text-gray-600 text-lg mb-8 leading-tight">
                        Our mision is to help people to find the best course<br />online
                        and learn with expert anytime, anywhere.
                    </p>
                    @guest
                        <a href="{{ route('login') }}"
                            class="inline-block px-7 py-2 bg-orange-500 text-white hover:bg-orange-600 transition text-lg font-medium">
                            Login
                        </a>
                    @else
                        <a href="{{ route('courses.index') }}"
                            class="inline-block px-7 py-3 bg-orange-500 text-white hover:bg-orange-600 transition text-lg font-medium">
                            Browse Courses
                        </a>
                    @endguest
                </div>

                <!-- Right Image -->
                <div class="relative">
                    <img src="{{ asset('img/hero.png') }}" alt="Student" class="w-full" />
                </div>
            </div>
        </div>
    </section>

    <!-- Browse Top Category Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">
                Browse top category
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $categoryColors = [
                        'bg-indigo-50' => ['icon' => 'text-indigo-600', 'iconBg' => 'bg-white'],
                        'bg-green-50' => ['icon' => 'text-green-600', 'iconBg' => 'bg-white'],
                        'bg-orange-50' => ['icon' => 'text-orange-600', 'iconBg' => 'bg-white'],
                        'bg-rose-50' => ['icon' => 'text-rose-600', 'iconBg' => 'bg-white'],
                        'bg-orange-100' => ['icon' => 'text-orange-700', 'iconBg' => 'bg-white'],
                        'bg-gray-50' => ['icon' => 'text-gray-700', 'iconBg' => 'bg-white'],
                        'bg-blue-50' => ['icon' => 'text-blue-600', 'iconBg' => 'bg-white'],
                        'bg-purple-50' => ['icon' => 'text-purple-600', 'iconBg' => 'bg-white'],
                    ];
                    $colorKeys = array_keys($categoryColors);
                    $icons = ['fa-microchip', 'fa-handshake', 'fa-credit-card', 'fa-laptop-code', 'fa-user-graduate', 'fa-briefcase', 'fa-bullhorn', 'fa-camera'];
                  @endphp

                @forelse($categories as $index => $category)
                    @php
                        $bgColor = $colorKeys[$index % count($colorKeys)];
                        $colors = $categoryColors[$bgColor];
                        $icon = $icons[$index % count($icons)];
                    @endphp
                    <a href="{{ route('courses.index', ['category' => $category->id]) }}"
                        class="{{ $bgColor }} p-6 hover:shadow-md transition cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 {{ $colors['iconBg'] }} flex items-center justify-center">
                                <i class="fas {{ $icon }} {{ $colors['icon'] }} text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h3>
                                <p class="text-gray-600 text-sm">{{ $category->courses_count }} Courses</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-4 text-center py-12 text-gray-500">
                        No categories available yet.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Best Selling Courses Section -->
    <section class="py-20 bg-light">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">
                Best selling courses
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                @php
                    $categoryBadgeColors = [
                        'text-orange-600' => 'Design',
                        'text-blue-600' => 'Development',
                        'text-green-600' => 'Business',
                        'text-purple-600' => 'Marketing',
                        'text-pink-600' => 'IT & Software',
                        'text-yellow-600' => 'Music',
                        'text-indigo-600' => 'Lifestyle',
                    ];
                  @endphp

                @forelse($featuredCourses as $course)
                    <a href="{{ route('courses.show', $course->slug) }}"
                        class="bg-white overflow-hidden shadow hover:shadow-xl transition group cursor-pointer">
                        <div class="relative overflow-hidden">
                            @if($course->thumbnail)
                                <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                    class="w-full h-48 object-cover group-hover:scale-110 transition duration-300" />
                            @else
                                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&h=250&fit=crop"
                                    alt="{{ $course->title }}"
                                    class="w-full h-48 object-cover group-hover:scale-110 transition duration-300" />
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span
                                    class="text-xs font-semibold text-{{ ['orange', 'blue', 'green', 'purple', 'pink'][array_rand(['orange', 'blue', 'green', 'purple', 'pink'])] }}-600 uppercase">
                                    {{ $course->category->name }}
                                </span>
                                <span class="text-lg font-bold text-green-600">FREE</span>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-3 line-clamp-2">
                                {{ $course->title }}
                            </h3>
                            <div class="flex items-center justify-between text-xs text-gray-600">
                                <div class="flex items-center">
                                    <i class="fas fa-star text-orange-400 mr-1"></i>
                                    <span class="font-semibold">5.0</span>
                                </div>
                                <span>{{ $course->enrollments_count }} students</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-5 text-center py-12 text-gray-500">
                        No courses available yet.
                    </div>
                @endforelse
            </div>

            <!-- Footer Text -->
            <p class="text-center text-gray-500 mt-10">
                We have more category & subcategory.
                <a href="{{ route('courses.index') }}" class="text-orange-500 font-medium hover:underline">Browse All →</a>
            </p>
        </div>
    </section>

    <!-- Trusted Companies Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <!-- Left Content -->
                <div class="lg:w-1/3">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">
                        6.3k trusted companies
                    </h2>
                    <p class="text-gray-600">
                        Learn from expert instructors who are passionate about teaching and helping students succeed in
                        their learning journey.
                    </p>
                </div>

                <!-- Company Logos Grid -->
                <div class="lg:w-2/3 grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="py-2 bg-white flex items-center justify-center shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('img/Company=Netflix, Gray=False.png') }}" alt="Netflix logo" />
                    </div>
                    <div class="py-2 bg-white flex items-center justify-center shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('img/Company=Youtube, Gray=False.png') }}" alt="Youtube logo" />
                    </div>
                    <div class="py-2 bg-white flex items-center justify-center shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('img/Company=Google, Gray=False.png') }}" alt="Google logo" />
                    </div>
                    <div class="py-2 bg-white flex items-center justify-center shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('img/Company=Lenovo, Gray=False.png') }}" alt="Lenovo logo" />
                    </div>
                    <div class="py-2 bg-white flex items-center justify-center shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('img/Company=Slack, Gray=False.png') }}" alt="Slack logo" />
                    </div>
                    <div class="py-2 bg-white flex items-center justify-center shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('img/Company=Verizon, Gray=False.png') }}" alt="Verizon logo" />
                    </div>
                    <div class="py-2 bg-white flex items-center justify-center shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('img/Company=Lexmark, Gray=False.png') }}" alt="Lexmark logo" />
                    </div>
                    <div class="py-2 bg-white flex items-center justify-center shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('img/Company=Microsoft, Gray=False.png') }}" alt="Microsoft logo" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-900 text-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <!-- Left Content -->
                <div class="lg:w-1/2">
                    <h2 class="text-4xl font-semibold mb-6">
                        Start learning with {{ number_format($stats['total_students']) }}+ <br />
                        students around the world.
                    </h2>
                    <div class="flex gap-4">
                        @guest
                            <a href="{{ route('register') }}"
                                class="px-6 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition font-medium">
                                Join The Family
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}"
                                class="px-6 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition font-medium">
                                Go to Dashboard
                            </a>
                        @endguest
                        <a href="{{ route('courses.index') }}"
                            class="px-6 py-3 bg-transparent border border-white text-white rounded hover:bg-white hover:text-gray-900 transition font-medium">
                            Browse All Courses
                        </a>
                    </div>
                </div>

                <!-- Right Stats -->
                <div class="lg:w-1/2 grid grid-cols-3 gap-8">
                    <div>
                        <div class="text-5xl font-semibold mb-2">{{ $stats['total_courses'] }}+</div>
                        <div class="text-gray-400">Online courses</div>
                    </div>
                    <div>
                        <div class="text-5xl font-semibold mb-2">{{ $stats['total_instructors'] }}+</div>
                        <div class="text-gray-400">Certified Instructor</div>
                    </div>
                    <div>
                        <div class="text-5xl font-semibold mb-2">{{ $stats['total_students'] }}+</div>
                        <div class="text-gray-400">Active Students</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr class="border border-gray-700" />
@endsection