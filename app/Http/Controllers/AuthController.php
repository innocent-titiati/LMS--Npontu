<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    /**
     * User Registration
     */
    public function register(Request $request)
    {
        // Validate Request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:manager,hr,employee',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create User
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

       
        return redirect()->route('login');
    
    }

    /**
     * User Login
     */
    public function login(Request $request)
    {
        // Validate Request
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        //     'role' => 'required|in:manager,hr,employee',
        // ]);
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            // 'role' => 'required|in:manager,hr,employee',
        ]);

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        // Check Credentials
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->with(['message' => 'Invalid credentials'], 401);
        }
        if(Auth::user()->role === 'manager'){
            return redirect()->route('manager.dashboard');
        }elseif(Auth::user()->role === 'hr'){
            return redirect()->route('hr.dashboard');
        }elseif(Auth::user()->role === 'employee'){
            return redirect()->route('employee.dashboard');
        }

        // // Get Authenticated User
        
        
        // // Verify that the requested role matches the user's role
        if ($user->role !== $request->role) {
            Auth::logout();
            return response()->json(['message' => 'Inhvalid role for this user'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // Role-based redirect
        if ($user->role === 'manager') {
            return redirect()->route('manager.dashboard');
        } elseif ($user->role === 'hr') {
            return redirect()->route('hr.dashboard');
        } elseif ($user->role === 'employee') {
            return redirect()->route('employee.dashboard');
        }

        // return response()->json(['message' => 'Login successful', 'token' => $token, 'user' => $user]);
    }

    /**
     * Get Authenticated User
     */
    public function me(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }

    /**
     * User Logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }

}
