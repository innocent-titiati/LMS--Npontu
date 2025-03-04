<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $userExists = User::where('email', $request->email)->exists();

        if (Auth::attempt($request->only('email', 'password'), true)) {
            return redirect()->route('manager.dashboard');
        }

        if (!$userExists) {
            return redirect()->route('register')->with('message', 'User does not exist. Please register.');
        }

        return redirect()->back()->with('error', 'Invalid Credentials');
    }

    public function showRegistrationForm()
    {
        // dd('hi');
        return view('auth.register');
    }

    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string'
        ]);

        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return redirect()->route('login')->with('message', 'You are already registered. Please log in to your account.');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        event(new Registered($user));

        Auth::login($user, true);
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
