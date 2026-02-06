<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard
        // if (\Illuminate\Support\Facades\Auth::guard('admin')->check()) {
        //     return redirect()->route('admin.dashboard');
        // }
        return view('admin.auth.login');
    }

    // Handle login submission
    public function login(\Illuminate\Http\Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login using admin guard
        // $request->filled('remember') checks if remember box is checked
        if (\Illuminate\Support\Facades\Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))->with('login_success', true);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function logout(\Illuminate\Http\Request $request)
    {
        \Illuminate\Support\Facades\Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
