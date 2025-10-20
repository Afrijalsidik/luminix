<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SetingController extends Controller
{
    //
    public function index()
    {

        $user = Auth::user();
        return view('setting.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Jika user mengisi password lama & baru
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
            } else {
                return back()->withErrors(['current_password' => 'the old password is wrong']);
            }
        }

        $user->save();

        return back()->with('success', 'Updated Data is Success');
    }


    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2050|mimes:jpg,jpeg,png,webp',
        ]);

        $user = auth()->user();

        // Hapus avatar lama (jika ada)
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Simpan file baru
        $path = $request->file('avatar')->store('avatars', 'public');

        // Update database
        $user->update([
            'avatar' => $path,
        ]);

        return back()->with('success', 'Updated Avatar is Success');
    }

}
