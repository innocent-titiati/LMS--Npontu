<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the user roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userRoles = UserRole::all();
        return response()->json($userRoles);
    }

    /**
     * Store a newly created user role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:manager,hr,employees,instructor',
            'status' => 'required|in:active,inactive',
        ]);

        $userRole = UserRole::create($request->all());
        return response()->json($userRole, 201);
    }

    /**
     * Display the specified user role.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function show(UserRole $userRole)
    {
        return response()->json($userRole);
    }

    /**
     * Update the specified user role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRole $userRole)
    {
        $request->validate([
            'role' => 'sometimes|required|in:manager,hr,employees,instructor',
            'status' => 'sometimes|required|in:active,inactive',
        ]);

        $userRole->update($request->all());
        return response()->json($userRole);
    }

    /**
     * Remove the specified user role from storage.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRole $userRole)
    {
        $userRole->delete();
        return response()->json(null, 204);
    }
}
