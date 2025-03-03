<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function studentDashboard() {
        return response()->json(['message' => 'Student dashboard']);
    }

    public function instructorDashboard() {
        return response()->json(['message' => 'Instructor dashboard']);
    }
}
