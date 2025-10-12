<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Luminix') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|pacifico:400" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .brand-logo {
            font-family: 'Pacifico', cursive;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">

    <div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
        style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop'); background-size: cover; background-position: center;">



        <!-- Overlay -->

        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 w-full max-w-md">
            <!-- Logo -->
            <div class="mb-8 text-center">
                <a href="/" class="brand-logo text-6xl text-white drop-shadow-lg">
                    Luminix
                </a>

            </div>

            <!-- Form Card -->

            <div
                class="px-8 py-10 bg-white/80 backdrop-blur-xl shadow-2xl sm:rounded-2xl overflow-hidden border border-white/50">
                @yield('content')
            </div>

            <!-- Back to Home -->

            <div class="mt-6 text-center">

                <a href="{{ route('landing') }}"
                    class="text-sm font-medium text-white/80 hover:text-white transition-colors duration-300 flex items-center justify-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />

                    </svg>

                    Back to Home

                </a>

            </div>

        </div>

    </div>

</body>

</html>