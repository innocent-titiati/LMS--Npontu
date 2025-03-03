<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        return response()->json(Course::all());
    }

    public function store(Request $request) {
        $course = Course::create($request->all());
        return response()->json(['message' => 'Course created successfully']);
    }

    public function show($id) {
        return response()->json(Course::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return response()->json(['message' => 'Course updated successfully']);
    }

    public function destroy($id) {
        Course::destroy($id);
        return response()->json(['message' => 'Course deleted successfully']);
    }
}
