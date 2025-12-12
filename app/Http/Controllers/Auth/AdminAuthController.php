<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek apakah user adalah admin
            if ($user->role !== 'admin') {
                Auth::logout();
                return back()->with('error', 'Email atau password salah. Hanya admin yang dapat login.');
            }

            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
        }

        return back()->with('error', 'Email atau password salah')->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }
}
