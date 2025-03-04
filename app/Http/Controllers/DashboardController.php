<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $role = $user->role;
        $course = Course::all();
        $users = User::all();
        $totalCourses = $course->count();
        Enrollment::create([
            'user_id' => 2,
            'course_id' => 2,
            'status' => 'enrolled'
        ]);
        $enrollment = Enrollment::all();

        switch ($role) {
            // case 'student':
            //     $enrolledCourses = Enrollment::where('user_id', $user->id)
            //         ->with('course')
            //         ->get();
            //     return view('dashboard.student', compact('enrolledCourses'));

            // case 'instructor':
            //     $courses = Course::where('instructor_id', $user->id)->get();
            //     return view('dashboard.instructor', compact('courses'));

            case 'manager':
                return view('manager.dashboard',['courseCount' => $totalCourses, 'activeEnrollment' => $enrollment, 'users' => $users] );
            default:
                dd('not manager');

        }
    }

    public function studentDashboard() {
        return response()->json(['message' => 'Student dashboard']);
    }

    public function instructorDashboard() {
        return response()->json(['message' => 'Instructor dashboard']);
    }
}
