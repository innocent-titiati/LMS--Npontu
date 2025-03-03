<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $stats = [
            'ongoingCourses' => Enrollment::where('status', 'active')->count(),
            'totalUsers' => User::count(),
            'activeUsers' => User::whereHas('enrollments', function($query) {
                $query->where('status', 'active');
            })->count(),
            'completedCourses' => Enrollment::where('status', 'completed')->count(),
            'certificatesEarned' => Enrollment::where('status', 'completed')->count(), // Assuming each completion earns a certificate
        ];

        return view('enrollment.index', [
            'enrollments' => Enrollment::with(['user', 'course'])->get(),
            'users' => User::all(),
            'courses' => Course::all(),
            'stats' => $stats
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Check if enrollment already exists
        $exists = Enrollment::where('user_id', $validated['user_id'])
            ->where('course_id', $validated['course_id'])
            ->exists();

        if ($exists) {
            return redirect()->route('enrollments.index')
                ->with('error', 'User is already enrolled in this course');
        }

        Enrollment::create([
            'user_id' => $validated['user_id'],
            'course_id' => $validated['course_id'],
            'status' => 'active',
            'progress' => 0
        ]);

        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment created successfully');
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        if ($request->action === 'toggle_status') {
            $enrollment->status = $enrollment->status === 'suspended' ? 'active' : 'suspended';
            $enrollment->save();

            return redirect()->route('enrollments.index')
                ->with('success', 'Enrollment status updated successfully');
        }

        return redirect()->route('enrollments.index')
            ->with('error', 'Invalid action');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment deleted successfully');
    }
}
