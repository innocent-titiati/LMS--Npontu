<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function dashboard()
    {
        dd('hi');
        return view('manager.dashboard');
    }

    public function courses()
    {
        $courses = Course::with('instructor')->paginate(12);
        $totalCourses = Course::count();
        $completedCourses = Course::where('status', 'completed')->count();
        $performance = $totalCourses > 0 ? round(($completedCourses / $totalCourses) * 100) : 0;
        $categories = Course::distinct('category')->pluck('category');

        return view('manager.courses', compact(
            'courses',
            'totalCourses',
            'completedCourses',
            'performance',
            'categories'
        ));
    }

    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string',
            'instructor_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content_type' => 'required|string',
            'category' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($validated);

        return response()->json(['message' => 'Course created successfully']);
    }

    public function editCourse(Course $course)
    {
        return response()->json($course);
    }

    public function updateCourse(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string',
            'instructor_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content_type' => 'required|string',
            'category' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5'
        ]);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($validated);

        return response()->json(['message' => 'Course updated successfully']);
    }

    public function deleteCourse(Course $course)
    {
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        
        $course->delete();

        return response()->json(['message' => 'Course deleted successfully']);
    }

    public function filterCourses(Request $request)
    {
        $query = Course::query();

        if ($request->content_type) {
            $query->where('content_type', $request->content_type);
        }

        if ($request->category) {
            $query->where('category', $request->category);
        }

        $courses = $query->with('instructor')->get();

        return view('manager.partials.course-list', compact('courses'));
    }
}