<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        // Hanya user yang sudah login yang bisa mengakses
        $this->middleware('auth');
    }

    // Menampilkan profile user
    public function show_profile()
    {
        $user = Auth::user();
        return view('show_profile', compact('user'));
    }

    // Update profile
    public function update_profile(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
        ]);

        // Update data
        $user = Auth::admin();
        $user->update($request->all());

        return redirect()->back()->with('success', 'Profile updated!');
    }
    

    // Halaman khusus admin
    public function adminDashboard()
    {
        // Cek apakah user adalah admin
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.dashboard');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}