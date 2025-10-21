<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/GraduationCap.svg') }}">

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

        /* Custom scrollbar for better UX */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(249, 115, 22, 0.5);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(249, 115, 22, 0.7);
        }

        /* Smooth background parallax effect */
        .bg-parallax {
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }

        @media (max-width: 768px) {
            .bg-parallax {
                background-attachment: scroll;
            }
        }

        /* Glassmorphism enhancement */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* Loading animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
    </style>

    <!-- Tailwind Custom Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Pacifico', 'cursive'],
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans text-gray-900 antialiased">

    <div class="relative min-h-screen flex flex-col justify-center items-center px-4 py-8 sm:px-6 lg:px-8 bg-parallax"
        style="background-image: url({{ asset('/img/hero3.jpg') }});">

        <!-- Animated Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-black/60 via-black/50 to-black/60"></div>

        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-orange-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Main Content Container -->
        <div class="relative z-10 w-full max-w-md fade-in">

            <!-- Logo Section -->
            <div class="mb-6 sm:mb-8 text-center">
                <a href="/" class="inline-block group">
                    <!-- Icon with Logo -->
                    <div class="flex items-center justify-center gap-2 sm:gap-3 mb-2">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 bg-orange-500 rounded-xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path
                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <span
                            class="brand-logo text-4xl sm:text-5xl md:text-6xl text-white drop-shadow-2xl group-hover:text-orange-400 transition-colors duration-300">
                            Luminix
                        </span>
                    </div>

                </a>
            </div>

            <!-- Form Card with Enhanced Glassmorphism -->
            <div
                class="glass-card px-6 py-8 sm:px-8 sm:py-10 shadow-2xl rounded-2xl sm:rounded-3xl overflow-hidden border border-white/20 backdrop-blur-xl">
                <!-- Decorative top border -->
                <div
                    class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-orange-500 via-orange-400 to-orange-500">
                </div>

                @yield('content')
            </div>

            <!-- Back to Home Link -->
            <div class="mt-6 sm:mt-8 text-center">
                <a href="{{ route('landing') }}"
                    class="inline-flex items-center justify-center gap-2 text-sm sm:text-base font-medium text-white/90 hover:text-white transition-all duration-300 group px-4 py-2 rounded-lg hover:bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 sm:h-5 sm:w-5 transform group-hover:-translate-x-1 transition-transform duration-300"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="drop-shadow">Back to Home</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Optional: Add loading state -->
    <script>
        // Prevent content flash
        document.addEventListener('DOMContentLoaded', function () {
            document.body.classList.add('loaded');
        });

        // Handle form loading states if needed
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function () {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.disabled) {
                    submitBtn.disabled = true;
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<span class="inline-flex items-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Processing...</span>';

                    // Reset after 5 seconds as fallback
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }, 5000);
                }
            });
        });
    </script>

</body>

</html>