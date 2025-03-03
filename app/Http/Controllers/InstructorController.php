<?php

namespace App\Http\Controllers;

use App\Models\Instructors;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index() {
        return response()->json(Instructor::all());
    }

    public function assignCourse(Request $request) {
        Instructor::create($request->all());
        return response()->json(['message' => 'Course assigned to instructor']);
    }
}
