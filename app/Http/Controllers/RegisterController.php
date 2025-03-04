<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view("auth.register");
    }

    public function register(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|string",
            'name' => 'required|string',
            'role' => 'required|string',
        ]);

        $existingUser = User::where("email", $request->email)->first();

        if ($existingUser) {
            return redirect()->route('login')->with('message', 'You are already registered. Please log in to your account.');
        }

        $newUser = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'role' => $request->role,
        ]);

        event(new Registered($newUser));

        Auth::login($newUser, true);
        return redirect()->route('dashboard');
    }

    public function verifyNotice()
    {
        return view('auth.verify-email');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('dashboard');
    }

    public function verifyHandler(Request $request)
    {
        $request->user()->sendEmailVerificationNotification($request->email, $request->name);

        return redirect()->route('dashboard');
    }
}
