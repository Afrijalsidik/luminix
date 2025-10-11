<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login dengan remember me
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            $user = Auth::user();

            // Admin & Instructor ke Filament
            if ($user->isAdmin() || $user->isInstructor()) {
                return redirect()->intended('/admin');
            }

            // Student ke dashboard
            return redirect()->intended(route('dashboard'));
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}