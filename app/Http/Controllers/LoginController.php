<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $userExists = User::where('email', $request->email)->exists();

        if (Auth::attempt($request->only('email', 'password'), true)) {
            return redirect()->route('dashboard');
        }

        if (!$userExists) {
            // User does not exist, redirect to the registration page
            return redirect()->route('register')->with('message', 'User  does not exist. Please register.');
        }

        return redirect()->back()->with('error', 'Invalid Credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
