<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Luminix - Learning Management System')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|pacifico:400" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        grey: {
                            900: "var(--grey-900)",
                            800: "var(--grey-800)",
                            700: "var(--grey-700)",
                        },
                        white: "var(--white)",
                        primary: {
                            900: "var(--primary-900)",
                            800: "var(--primary-800)",
                            700: "var(--primary-700)",
                            500: "var(--primary-500)",
                        },
                        secondary: {
                            900: "var(--secondary-900)",
                            800: "var(--secondary-800)",
                            700: "var(--secondary-700)",
                            500: "var(--secondary-500)",
                        },
                        success: {
                            900: "var(--success-900)",
                            800: "var(--success-800)",
                            700: "var(--success-700)",
                            500: "var(--success-500)",
                        },
                        warning: {
                            900: "var(--warning-900)",
                            800: "var(--warning-800)",
                            700: "var(--warning-700)",
                            500: "var(--warning-500)",
                        },
                        danger: {
                            900: "var(--danger-900)",
                            800: "var(--danger-800)",
                            700: "var(--danger-700)",
                            500: "var(--danger-500)",
                        },
                    },
                },
            },
        };
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('style.css') }}" />

    @stack('styles')
</head>

<body class="bg-gray-50">
    <!-- Top Navigation Bar -->
    <nav class="bg-gray-900 text-gray-300 text-sm">
        <div class="mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex space-x-6">
                <a href="{{ route('landing') }}"
                    class="{{ request()->routeIs('landing') ? 'text-white border-b-2 border-orange-500 pb-3' : 'hover:text-white' }}">Home</a>
                <a href="{{ route('courses.index') }}"
                    class="{{ request()->routeIs('courses.*') ? 'text-white border-b-2 border-orange-500 pb-3' : 'hover:text-white' }}">Courses</a>
                <a href="#" class="hover:text-white">About</a>
                <a href="#" class="hover:text-white">Contact</a>
            </div>
            <div class="flex space-x-4">
                <select class="bg-transparent border-none text-gray-300">
                    <option>USD</option>
                    <option>IDR</option>
                    <option>EUR</option>
                </select>
                <select class="bg-transparent border-none text-gray-300">
                    <option>English</option>
                    <option>Indonesia</option>
                </select>
            </div>
        </div>
    </nav>

    <!-- Main Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('landing') }}" class="flex items-center space-x-2">
                        <div class="w-10 h-10 flex items-center justify-center">
                            <img src="{{ asset('img/GraduationCap.svg') }}" alt="Luminix Logo" />
                        </div>
                        <span class="text-3xl font-bold text-primary-500 brand-logo">Luminix</span>
                    </a>

                    <!-- Search Bar -->
                    <form action="{{ route('courses.search') }}" method="GET"
                        class="flex bg-gray-50 px-4 py-2 w-96 border border-grey-100">
                        <i class="fas fa-search text-gray-500 mr-3 mt-1"></i>
                        <input type="text" name="q" placeholder="What do you want learn..."
                            class="bg-transparent border-none outline-none text-gray-800 w-full"
                            value="{{ request('q') }}" />
                    </form>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center space-x-6">
                    @guest
                        <a href="{{ route('register') }}"
                            class="px-6 py-2 text-orange-500 border border-orange-500 hover:bg-orange-50 transition">
                            Create Account
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-6 py-2 bg-orange-500 text-white hover:bg-orange-600 transition">
                            Sign In
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}"
                            class="px-6 py-2 text-orange-500 border border-orange-500 hover:bg-orange-50 transition">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-6 py-2 bg-orange-500 text-white hover:bg-orange-600 transition">
                                Logout
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-12">
                <!-- Company Info -->
                <div class="lg:col-span-1">
                    <a href="{{ route('landing') }}" class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 flex items-center justify-center">
                            <img src="{{ asset('img/GraduationCap.svg') }}" alt="Luminix" />
                        </div>
                        <span class="text-3xl font-bold text-primary-500 brand-logo">Luminix</span>
                    </a>
                    <p class="text-sm mb-6">
                        Aliquam rhoncus ligula est, non pulvinar elit convallis nec. Donec mattis odio at.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded flex items-center justify-center hover:bg-orange-500 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded flex items-center justify-center hover:bg-orange-500 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded flex items-center justify-center hover:bg-orange-600 transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded flex items-center justify-center hover:bg-orange-500 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded flex items-center justify-center hover:bg-orange-500 transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Top 4 Category -->
                <div>
                    <h3 class="text-white font-semibold mb-4">TOP 4 CATEGORY</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-orange-500 transition">Development</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition">Finance & Accounting</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition">Design</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition">Business</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white font-semibold mb-4">QUICK LINKS</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-orange-500 transition">About</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition flex items-center gap-2">Become
                                Instructor <i class="fas fa-arrow-right text-xs"></i></a></li>
                        <li><a href="#" class="hover:text-orange-500 transition">Contact</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition">Career</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="text-white font-semibold mb-4">SUPPORT</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-orange-500 transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition">FAQs</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition">Terms & Condition</a></li>
                        <li><a href="#" class="hover:text-orange-500 transition">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Download App -->
                <div>
                    <h3 class="text-white font-semibold mb-4">DOWNLOAD OUR APP</h3>
                    <div class="space-y-3">
                        <a href="#" class="flex items-center gap-3 bg-gray-800 p-3 hover:bg-gray-700 transition">
                            <i class="fab fa-apple text-2xl"></i>
                            <div>
                                <div class="text-xs">Download now</div>
                                <div class="text-sm font-semibold text-white">App Store</div>
                            </div>
                        </a>
                        <a href="#" class="flex items-center gap-3 bg-gray-800 p-3 hover:bg-gray-700 transition">
                            <i class="fab fa-google-play text-2xl"></i>
                            <div>
                                <div class="text-xs">Download now</div>
                                <div class="text-sm font-semibold text-white">Play Store</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm">
                    © {{ date('Y') }} - Luminix. Designed by <a href="#"
                        class="text-orange-500 hover:underline">Templatecookie</a>. All rights reserved
                </p>
                <div class="relative">
                    <select
                        class="bg-gray-800 text-gray-400 px-4 py-2 rounded border border-gray-700 appearance-none pr-10">
                        <option>English</option>
                        <option>Indonesia</option>
                        <option>Spanish</option>
                    </select>
                    <i
                        class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-xs pointer-events-none"></i>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>