<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    /**
     * Login a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // if (auth()->attempt($credentials)) {
        //     return response()->json(auth()->user(), 200);
        // }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\Response
     */
    // public function logout()
    // {
    //      auth()->logout();
    //      return response()->json(['message' => 'Successfully logged out']);
    // }

    /**
     * Request a password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function requestPasswordReset(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Generate a password reset token and send email logic here

        return response()->json(['message' => 'Password reset link sent']);
    }

    /**
     * Reset the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:password_reset_tokens,email',
            'token' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Validate the token and reset the password logic here

        return response()->json(['message' => 'Password has been reset']);
    }
}