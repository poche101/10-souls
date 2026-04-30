<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // GET /admin/login
    public function showLogin()
    {
        // Redirect to dashboard if already logged in
        if (session('admin_logged_in')) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    // POST /admin/login
    public function login(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $adminPassword = config('admin.password', env('ADMIN_PASSWORD', 'admin123'));

        if ($request->password !== $adminPassword) {
            return back()->with('error', 'Incorrect password. Please try again.');
        }

        // Set session
        session(['admin_logged_in' => true]);
        session()->regenerate();

        return redirect()->route('dashboard');
    }

    // POST /admin/logout
    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }
}