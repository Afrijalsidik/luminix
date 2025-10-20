@extends('layouts.frontend')

@section('title', 'Settings')

@section('content')
    <!-- Wrapper untuk minimum height -->
    <div class="min-h-screen flex flex-col bg-gray-50">

        <!-- Header -->
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                @php
                    // Set timezone to Indonesia (WIB)
                    date_default_timezone_set('Asia/Jakarta');
                    $hour = date('H');

                    if ($hour >= 5 && $hour < 12) {
                        $greeting = 'Good morning';
                    } elseif ($hour >= 12 && $hour < 15) {
                        $greeting = 'Good afternoon';
                    } elseif ($hour >= 15 && $hour < 18) {
                        $greeting = 'Good evening';
                    } else {
                        $greeting = 'Good night';
                    }
                @endphp

                <h1 class="text-3xl md:text-4xl font-bold mb-2 text-gray-900">
                    {{ $greeting }},
                    <span class="text-orange-500">
                        {{ auth()->user()->name }}
                    </span>
                </h1>
                <p class="text-gray-600 text-lg">Continue your learning journey </p>
            </div>
        </div>

        <!-- Settings Content - Flex grow untuk push footer ke bawah -->
        <section class="flex-grow py-6 sm:py-8 lg:py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 sm:mb-8">
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Account Settings</h2>
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center justify-center gap-2 px-4 sm:px-6 py-2 sm:py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium text-sm sm:text-base shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Back to Dashboard</span>
                    </a>
                </div>

                <!-- Main Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                    <!-- Left Column - Profile Photo -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sm:p-8 text-center">
                            <form action="{{ route('setting.updateAvatar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-4 sm:mb-6">
                                    <p class="text-sm font-semibold text-gray-700 mb-3 sm:mb-4">Profile Photo</p>

                                    <div class="relative inline-block">
                                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&color=fff' }}"
                                            alt="Profile"
                                            class="w-32 h-32 sm:w-40 sm:h-40 lg:w-48 lg:h-48 rounded-xl object-cover mx-auto ring-4 ring-gray-100" />

                                        <label
                                            class="absolute bottom-2 left-1/2 transform -translate-x-1/2 bg-gray-900 bg-opacity-90 text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg text-xs sm:text-sm flex items-center space-x-2 hover:bg-opacity-100 cursor-pointer transition-all duration-200 shadow-lg">
                                            <i class="fas fa-camera"></i>
                                            <span class="hidden sm:inline">Upload Photo</span>
                                            <span class="sm:hidden">Upload</span>
                                            <input type="file" name="avatar" class="hidden" accept="image/*"
                                                onchange="previewImage(event); this.form.submit();">
                                        </label>
                                    </div>
                                </div>

                                @error('avatar')
                                    <div
                                        class="bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded-lg text-xs sm:text-sm mb-3">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 sm:p-4">
                                    <p class="text-xs sm:text-sm text-blue-700 flex items-start gap-2">
                                        <i class="fas fa-info-circle mt-0.5 flex-shrink-0"></i>
                                        <span>Maximum file size: 1MB<br>Recommended ratio: 1:1 (square)</span>
                                    </p>
                                </div>
                            </form>
                        </div>

                        <!-- Additional Info Card (Optional) -->
                        <div
                            class="hidden lg:block mt-6 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 border border-orange-200">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-shield-alt text-white"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Account Security</h3>
                                    <p class="text-sm text-gray-600">Keep your password safe and update it regularly.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Form Fields -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sm:p-8">
                            <form action="{{ route('setting.update') }}" method="POST" class="space-y-6">
                                @csrf

                                <!-- Personal Information Section -->
                                <div>
                                    <h3
                                        class="text-base sm:text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                        Personal Information
                                    </h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                        <!-- Full Name -->
                                        <div class="md:col-span-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Full Name <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i class="fas fa-user text-gray-400 text-sm"></i>
                                                </div>
                                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                                    placeholder="Enter full name"
                                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all text-sm sm:text-base"
                                                    required />
                                            </div>
                                            @error('name')
                                                <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="md:col-span-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Email Address <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                                                </div>
                                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                                    placeholder="Enter your email"
                                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all text-sm sm:text-base"
                                                    required />
                                            </div>
                                            @error('email')
                                                <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Section -->
                                <div>
                                    <h3
                                        class="text-base sm:text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                        Change Password
                                    </h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                        <!-- Old Password -->
                                        <div class="md:col-span-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Current Password
                                            </label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i class="fas fa-lock text-gray-400 text-sm"></i>
                                                </div>
                                                <input type="password" name="current_password"
                                                    placeholder="Enter current password"
                                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all text-sm sm:text-base" />
                                            </div>
                                            @error('current_password')
                                                <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- New Password -->
                                        <div class="md:col-span-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                New Password
                                            </label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i class="fas fa-key text-gray-400 text-sm"></i>
                                                </div>
                                                <input type="password" name="new_password" placeholder="Enter new password"
                                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all text-sm sm:text-base" />
                                            </div>
                                            @error('new_password')
                                                <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-3 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                        <p class="text-xs sm:text-sm text-yellow-800 flex items-start gap-2">
                                            <i class="fas fa-exclamation-triangle mt-0.5 flex-shrink-0"></i>
                                            <span>Leave password fields empty if you don't want to change your
                                                password.</span>
                                        </p>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-4 border-t border-gray-200">
                                    <button type="submit"
                                        class="w-full sm:w-auto px-6 py-2.5 sm:py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200 font-medium text-sm sm:text-base shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                                        <i class="fas fa-save"></i>
                                        <span>Save Changes</span>
                                    </button>
                                    <button type="reset"
                                        class="w-full sm:w-auto px-6 py-2.5 sm:py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-medium text-sm sm:text-base flex items-center justify-center gap-2">
                                        <i class="fas fa-undo"></i>
                                        <span>Reset</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <!-- Flash Messages -->
    @if (session('success') || session('error'))
        <div id="flash-message"
            class="fixed bottom-4 right-4 left-4 sm:left-auto sm:right-4 max-w-md {{ session('success') ? 'bg-green-500' : 'bg-red-500' }} text-white px-4 sm:px-6 py-3 sm:py-4 rounded-lg shadow-2xl z-50 animate-slide-up">
            <div class="flex items-center gap-2 sm:gap-3">
                @if (session('success'))
                    <!-- Icon Success -->
                    <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-sm sm:text-base flex-1">{{ session('success') }}</span>
                @else
                    <!-- Icon Error -->
                    <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <span class="text-sm sm:text-base flex-1">{{ session('error') }}</span>
                @endif
                <button onclick="closeFlashMessage()"
                    class="flex-shrink-0 ml-2 hover:bg-white/20 rounded p-1 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Style & Script -->
    <script>
        // Auto hide flash message after 5 seconds
        setTimeout(function () {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                closeFlashMessage();
            }
        }, 5000);

        function closeFlashMessage() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.opacity = '0';
                flashMessage.style.transform = 'translateY(100%)';
                flashMessage.style.transition = 'all 0.3s ease';
                setTimeout(() => flashMessage.remove(), 300);
            }
        }

        // Preview image before upload
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = event.target.closest('form').querySelector('img');
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        // Form validation feedback
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form[action="{{ route('setting.update') }}"]');
            if (form) {
                form.addEventListener('submit', function (e) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i><span>Saving...</span>';
                    }
                });
            }
        });
    </script>

    <style>
        @keyframes slide-up {
            from {
                transform: translateY(100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slide-up {
            animation: slide-up 0.3s ease-out;
        }

        /* Smooth focus ring */
        input:focus {
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        /* Loading state for image upload */
        input[type="file"]:disabled+label {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>

@endsection