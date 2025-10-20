@extends('layouts.frontend')

@section('title', 'Home - Luminix ')

@section('content')
    <!-- Hero Section -->
    <section class="bg-white py-12 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left">
                    <h1
                        class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-gray-900 leading-tight mb-4 lg:mb-6">
                        Learn with expert<br class="hidden sm:block" />
                        <span class="text-orange-500">anytime anywhere</span>
                    </h1>
                    <p class="text-base sm:text-lg text-gray-600 mb-6 lg:mb-8 max-w-xl mx-auto lg:mx-0">
                        Our mission is to help people find the best courses online and learn with experts anytime, anywhere.
                    </p>
                    @guest
                        <a href="{{ route('login') }}"
                            class="inline-block px-8 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all duration-300 text-base sm:text-lg font-medium shadow-lg hover:shadow-xl">
                            Get Started
                        </a>
                    @else
                        <a href="{{ route('courses.index') }}"
                            class="inline-block px-8 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all duration-300 text-base sm:text-lg font-medium shadow-lg hover:shadow-xl">
                            Browse Courses
                        </a>
                    @endguest
                </div>

                <!-- Right Image -->
                <div class="relative mt-8 lg:mt-0">
                    <img src="{{ asset('img/hero2.jpg') }}" alt="Student learning online"
                        class="w-full h-auto rounded-2xl shadow-2xl" />
                </div>
            </div>
        </div>
    </section>

    <!-- Browse Top Category Section -->
    <section class="py-12 lg:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-center text-gray-900 mb-8 lg:mb-12">
                Browse Top Categories
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                @php
                    $categoryColors = [
                        'bg-indigo-50' => ['icon' => 'text-indigo-600', 'iconBg' => 'bg-indigo-100'],
                        'bg-green-50' => ['icon' => 'text-green-600', 'iconBg' => 'bg-green-100'],
                        'bg-orange-50' => ['icon' => 'text-orange-600', 'iconBg' => 'bg-orange-100'],
                        'bg-rose-50' => ['icon' => 'text-rose-600', 'iconBg' => 'bg-rose-100'],
                        'bg-blue-50' => ['icon' => 'text-blue-600', 'iconBg' => 'bg-blue-100'],
                        'bg-purple-50' => ['icon' => 'text-purple-600', 'iconBg' => 'bg-purple-100'],
                        'bg-teal-50' => ['icon' => 'text-teal-600', 'iconBg' => 'bg-teal-100'],
                        'bg-cyan-50' => ['icon' => 'text-cyan-600', 'iconBg' => 'bg-cyan-100'],
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
                        class="{{ $bgColor }} p-5 lg:p-6 rounded-xl hover:shadow cursor-pointer">
                        <div class="flex items-center gap-3 lg:gap-4">
                            <div
                                class="w-12 h-12 lg:w-14 lg:h-14 {{ $colors['iconBg'] }} rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas {{ $icon }} {{ $colors['icon'] }} text-xl lg:text-2xl"></i>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-base lg:text-lg font-semibold text-gray-900 truncate">{{ $category->name }}</h3>
                                <p class="text-gray-600 text-xs lg:text-sm">{{ $category->courses_count }} Courses</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        No categories available yet.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Best Selling Courses Section -->
    <section class="py-12 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-center text-gray-900 mb-8 lg:mb-12">
                Best Selling Courses
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-6">
                @forelse($featuredCourses as $course)
                    <a href="{{ route('courses.show', $course->slug) }}"
                        class="bg-white overflow-hidden rounded-xl shadow-md hover:shadow group cursor-pointer flex flex-col">
                        <div class="relative overflow-hidden aspect-video">
                            @if($course->thumbnail)
                                <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                            @else
                                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&h=250&fit=crop"
                                    alt="{{ $course->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                            @endif
                            <div class="absolute top-3 right-3 bg-white px-3 py-1 rounded-full shadow-lg">
                                <span class="text-sm font-bold text-green-600">FREE</span>
                            </div>
                        </div>
                        <div class="p-4 lg:p-5 flex flex-col flex-1">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-semibold text-orange-600 uppercase px-2 py-1 bg-orange-50 rounded">
                                    {{ $course->category->name }}
                                </span>
                            </div>
                            <h3
                                class="text-base lg:text-lg font-semibold text-gray-900 mb-3 line-clamp-2 group-hover:text-orange-500 transition-colors">
                                {{ $course->title }}
                            </h3>
                            <div
                                class="flex items-center justify-between text-xs lg:text-sm text-gray-600 mt-auto pt-3 border-t border-gray-100">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <span class="font-semibold">5.0</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <i class="far fa-user text-gray-400"></i>
                                    <span>{{ $course->enrollments_count }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        No courses available yet.
                    </div>
                @endforelse
            </div>

            <!-- Footer Text -->
            <p class="text-center text-gray-600 mt-8 lg:mt-12 text-sm lg:text-base">
                We have more categories & subcategories.
                <a href="{{ route('courses.index') }}" class="text-orange-500 font-semibold hover:underline ml-1">Browse All
                    →</a>
            </p>
        </div>
    </section>

    <!-- Trusted Companies Section -->
    <section class="py-12 lg:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
                <!-- Left Content -->
                <div class="lg:w-1/3 text-center lg:text-left">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                        <span class="text-orange-500">6.3k+</span> Trusted Companies
                    </h2>
                    <p class="text-base lg:text-lg text-gray-600">
                        Learn from expert instructors who are passionate about teaching and helping students succeed in
                        their learning journey.
                    </p>
                </div>

                <!-- Company Logos Grid -->
                <div class="lg:w-2/3 w-full grid grid-cols-2 md:grid-cols-4 gap-3 lg:gap-6">
                    <div
                        class="p-4 lg:p-6 bg-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md transition-shadow duration-300">
                        <img src="{{ asset('img/Company=Netflix, Gray=False.png') }}" alt="Netflix"
                            class="max-w-full h-auto" />
                    </div>
                    <div
                        class="p-4 lg:p-6 bg-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md transition-shadow duration-300">
                        <img src="{{ asset('img/Company=Youtube, Gray=False.png') }}" alt="Youtube"
                            class="max-w-full h-auto" />
                    </div>
                    <div
                        class="p-4 lg:p-6 bg-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md transition-shadow duration-300">
                        <img src="{{ asset('img/Company=Google, Gray=False.png') }}" alt="Google"
                            class="max-w-full h-auto" />
                    </div>
                    <div
                        class="p-4 lg:p-6 bg-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md transition-shadow duration-300">
                        <img src="{{ asset('img/Company=Lenovo, Gray=False.png') }}" alt="Lenovo"
                            class="max-w-full h-auto" />
                    </div>
                    <div
                        class="p-4 lg:p-6 bg-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md transition-shadow duration-300">
                        <img src="{{ asset('img/Company=Slack, Gray=False.png') }}" alt="Slack" class="max-w-full h-auto" />
                    </div>
                    <div
                        class="p-4 lg:p-6 bg-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md transition-shadow duration-300">
                        <img src="{{ asset('img/Company=Verizon, Gray=False.png') }}" alt="Verizon"
                            class="max-w-full h-auto" />
                    </div>
                    <div
                        class="p-4 lg:p-6 bg-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md transition-shadow duration-300">
                        <img src="{{ asset('img/Company=Lexmark, Gray=False.png') }}" alt="Lexmark"
                            class="max-w-full h-auto" />
                    </div>
                    <div
                        class="p-4 lg:p-6 bg-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md transition-shadow duration-300">
                        <img src="{{ asset('img/Company=Microsoft, Gray=False.png') }}" alt="Microsoft"
                            class="max-w-full h-auto" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section
        class="py-12 lg:py-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-white/[0.05] bg-[length:20px_20px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
                <!-- Left Content -->
                <div class="lg:w-1/2 text-center lg:text-left">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6 lg:mb-8">
                        Start learning with <span
                            class="text-orange-500">{{ number_format($stats['total_students']) }}+</span> students around
                        the world
                    </h2>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        @guest
                            <a href="{{ route('register') }}"
                                class="px-6 lg:px-8 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all duration-300 font-medium shadow-lg hover:shadow-xl">
                                Join The Family
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}"
                                class="px-6 lg:px-8 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all duration-300 font-medium shadow-lg hover:shadow-xl">
                                Go to Dashboard
                            </a>
                        @endguest
                        <a href="{{ route('courses.index') }}"
                            class="px-6 lg:px-8 py-3 bg-transparent border-2 border-white text-white rounded-lg hover:bg-white hover:text-gray-900 transition-all duration-300 font-medium">
                            Browse All Courses
                        </a>
                    </div>
                </div>

                <!-- Right Stats -->
                <div class="lg:w-1/2 w-full grid grid-cols-3 gap-4 lg:gap-8">
                    <div class="text-center p-4 bg-white/5 rounded-xl backdrop-blur-sm">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-2 text-orange-500">
                            {{ $stats['total_courses'] }}+
                        </div>
                        <div class="text-xs sm:text-sm text-gray-300">Online Courses</div>
                    </div>
                    <div class="text-center p-4 bg-white/5 rounded-xl backdrop-blur-sm">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-2 text-orange-500">
                            {{ $stats['total_instructors'] }}+
                        </div>
                        <div class="text-xs sm:text-sm text-gray-300">Certified Instructors</div>
                    </div>
                    <div class="text-center p-4 bg-white/5 rounded-xl backdrop-blur-sm">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-2 text-orange-500">
                            {{ $stats['total_students'] }}+
                        </div>
                        <div class="text-xs sm:text-sm text-gray-300">Active Students</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 mb-8 lg:mb-12">
                <!-- Company Info -->
                <div class="lg:col-span-1  sm:text-left">
                    <a href="{{ route('landing') }}" class="flex items-center  sm:justify-start space-x-2 mb-4">
                        <div class="w-10 h-10 flex items-center justify-center">
                            <img src="{{ asset('img/GraduationCap.svg') }}" alt="Luminix" />
                        </div>
                        <span class="text-2xl lg:text-3xl font-bold text-orange-500">Luminix</span>
                    </a>
                    <p class="text-sm mb-6">
                        Empowering learners worldwide with quality education and expert-led courses.
                    </p>
                    <div class="flex space-x-3  sm:justify-start">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-orange-500 transition-colors duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-orange-500 transition-colors duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-orange-500 transition-colors duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-orange-500 transition-colors duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-orange-500 transition-colors duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Top 4 Category -->
                <div class=" sm:text-left">
                    <h3 class="text-white font-semibold mb-4 text-sm lg:text-base">TOP CATEGORIES</h3>
                    <ul class="space-y-2 lg:space-y-3 text-sm">
                        <li><a href="#" class="hover:text-orange-500 transition-colors">Development</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition-colors">Finance & Accounting</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition-colors">Design</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition-colors">Business</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div class=" sm:text-left">
                    <h3 class="text-white font-semibold mb-4 text-sm lg:text-base">QUICK LINKS</h3>
                    <ul class="space-y-2 lg:space-y-3 text-sm">
                        <li><a href="#" class="hover:text-orange-500 transition-colors">About</a></li>
                        <li><a href="#"
                                class="hover:text-orange-500 transition-colors inline-flex items-center gap-2">Become
                                Instructor <i class="fas fa-arrow-right text-xs"></i></a></li>
                        <li><a href="#" class="hover:text-orange-500 transition-colors">Contact</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition-colors">Career</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div class=" sm:text-left">
                    <h3 class="text-white font-semibold mb-4 text-sm lg:text-base">SUPPORT</h3>
                    <ul class="space-y-2 lg:space-y-3 text-sm">
                        <li><a href="#" class="hover:text-orange-500 transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition-colors">FAQs</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition-colors">Terms & Conditions</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Download App -->
                <div class="sm:text-left">
                    <h3 class="text-white font-semibold mb-4 text-sm lg:text-base">DOWNLOAD APP</h3>
                    <div class="space-y-3">
                        <a href="#"
                            class="flex items-center gap-3 bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-300 mx-auto sm:mx-0 max-w-xs">
                            <i class="fab fa-apple text-2xl"></i>
                            <div class="text-left">
                                <div class="text-xs">Download now</div>
                                <div class="text-sm font-semibold text-white">App Store</div>
                            </div>
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-300 mx-auto sm:mx-0 max-w-xs">
                            <i class="fab fa-google-play text-2xl"></i>
                            <div class="text-left">
                                <div class="text-xs">Download now</div>
                                <div class="text-sm font-semibold text-white">Play Store</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </footer>
@endsection