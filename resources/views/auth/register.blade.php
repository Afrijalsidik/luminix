@extends('layouts.auth')
@section('title', 'register')

@section('content')
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Create Your Account</h1>
        <p class="text-gray-600 mt-2">Join Luminix and start learning today!</p>
    </div>

    <!-- Form -->
    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Full Name -->
        <div class="relative">
            <label for="name" class="sr-only">Full Name</label>
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
            </div>
            <input id="name" name="name" type="text" autocomplete="name" required value="{{ old('name') }}"
                class="w-full pl-10 pr-4 py-3 bg-white/50 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                placeholder="Full Name">
        </div>

        <!-- Email Address -->
        <div class="relative">
            <label for="email" class="sr-only">Email Address</label>
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
            </div>
            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                class="w-full pl-10 pr-4 py-3 bg-white/50 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                placeholder="Email Address">
        </div>

        <!-- Password -->
        <div class="relative">
            <label for="password" class="sr-only">Password</label>
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <input id="password" name="password" type="password" autocomplete="new-password" required
                class="w-full pl-10 pr-4 py-3 bg-white/50 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                placeholder="Password">
        </div>

        <!-- Confirm Password -->
        <div class="relative">
            <label for="password_confirmation" class="sr-only">Confirm Password</label>
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                required
                class="w-full pl-10 pr-4 py-3 bg-white/50 border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                placeholder="Confirm Password">
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-base font-bold text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all transform hover:scale-105">
                Create Account
            </button>
        </div>
    </form>

    <!-- Sign In Link -->
    <div class="text-center mt-6">
        <p class="text-sm text-gray-700">
            Already have an account?
            <a href="{{ route('login') }}" class="font-bold text-purple-600 hover:underline">
                Sign In
            </a>
        </p>
    </div>
@endsection