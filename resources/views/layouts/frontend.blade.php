<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{{ asset('img/GraduationCap.svg') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Luminix - @yield('title')</title>

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
    <!-- Tambahkan di <head> layout utama -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/typography@0.5.10/dist/typography.min.css" />


    @stack('styles')
</head>

<body class="bg-gray-50">
    <header class="bg-white shadow-sm sticky top-0 z-50" x-data="{ openMenu: false }">
        <div class="mx-auto  px-4 py-4">
            <div class="flex items-center w-full">

                <div class="flex items-center space-x-4 md:space-x-6">

                    <div class="flex items-center space-x-2">
                        <a href="{{ route('landing') }}" class="flex items-center space-x-2">
                            <div class="w-9 h-9 flex items-center justify-center">
                                <img src="{{ asset('img/GraduationCap.svg') }}" alt="Luminix Logo" />
                            </div>
                            <span class="text-2xl md:text-3xl font-bold text-orange-500">Luminix</span>
                        </a>
                    </div>

                    <form action="{{ route('courses.search') }}" method="GET"
                        class="hidden md:flex bg-gray-50 px-4 py-2 w-full md:w-96 border border-gray-200 rounded">
                        <i class="fas fa-search text-gray-500 mr-3 mt-1"></i>
                        <input type="text" name="q" placeholder="Search courses..."
                            class="bg-transparent border-none outline-none text-gray-800 w-full"
                            value="{{ request('q') }}" />
                    </form>
                </div>

                <div class="flex items-center space-x-3 ml-auto">
                    <button @click="openMenu = !openMenu" class="md:hidden text-gray-600 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>

                    <div class="hidden md:flex items-center space-x-2">
                        @guest
                            <a href="{{ route('register') }}"
                                class="px-5 py-2 text-orange-500 border border-orange-500 hover:bg-orange-50 rounded transition">
                                Sign Up
                            </a>
                            <a href="{{ route('login') }}"
                                class="px-5 py-2 bg-orange-500 text-white hover:bg-orange-600 rounded transition">
                                Sign In
                            </a>
                        @else
                                            <div class="relative" x-data="{ open: false }">
                                                <div @click="open = !open"
                                                    class="w-10 h-10 rounded-full overflow-hidden border-2 border-gray-300 cursor-pointer">
                                                    <img src="{{ Auth::user()->avatar
                            ? asset('storage/' . Auth::user()->avatar)
                            : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                                        class="object-cover w-full h-full" alt="Avatar">
                                                </div>

                                                <div x-show="open" @click.away="open = false"
                                                    class="absolute right-0 top-12 bg-white w-48 rounded-xl shadow-lg border border-gray-100 z-50">
                                                    <a href="{{ route('dashboard') }}"
                                                        class="flex items-center px-4 py-2 hover:bg-gray-50 text-gray-700">
                                                        <i class="fa-solid fa-house mr-2"></i> Dashboard
                                                    </a>
                                                    <a href="{{ route('setting') }}"
                                                        class="flex items-center px-4 py-2 hover:bg-gray-50 text-gray-700">
                                                        <i class="fa-solid fa-gear mr-2"></i> Setting
                                                    </a>
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="flex items-center w-full px-4 py-2 hover:bg-gray-50 text-gray-700">
                                                            <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                        @endguest
                    </div>
                </div>
            </div>

            <div x-show="openMenu" x-transition class="md:hidden mt-3 space-y-4">
                <form action="{{ route('courses.search') }}" method="GET"
                    class="flex bg-gray-50 px-4 py-2 border border-gray-200 rounded">
                    <i class="fas fa-search text-gray-500 mr-3 mt-1"></i>
                    <input type="text" name="q" placeholder="Search courses..."
                        class="bg-transparent border-none outline-none text-gray-800 w-full"
                        value="{{ request('q') }}" />
                </form>

                @guest
                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('register') }}"
                            class="px-5 py-2 text-orange-500 border border-orange-500 text-center rounded hover:bg-orange-50">
                            Sign Up
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-5 py-2 bg-orange-500 text-white text-center rounded hover:bg-orange-600">
                            Sign In
                        </a>
                    </div>
                @else
                    <a href="{{ route('dashboard') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Dashboard</a>
                    <a href="{{ route('setting') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Setting</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </header>


    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 pb-5">
        <div class="justify-center mx-auto px-4">
            <!-- Bottom Footer -->
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-center items-center gap-4">
                <p class="text-sm">
                    © {{ date('Y') }} - Luminix. Designed by <a href="#"
                        class="text-orange-500 hover:underline">Templatecookie</a>. All rights reserved
                </p>

            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>