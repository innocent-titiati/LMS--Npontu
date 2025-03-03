<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return response()->json(User::all());
    }

    public function show($id) {
        return response()->json(User::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json(['message' => 'User updated successfully']);
    }

    public function destroy($id) {
        User::destroy($id);
        return response()->json(['message' => 'User deleted successfully']);
    }
}

