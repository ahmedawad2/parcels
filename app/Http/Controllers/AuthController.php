<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->intended('');
        }
        return view('Admin.Auth.login');
    }

    public function loginAttempt(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required', 'email'
            ],
            'password' => [
                'required'
            ],
            'type' => [
                'required',
                'in:1,2'
            ]
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        return view('Admin.Dashboard.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
