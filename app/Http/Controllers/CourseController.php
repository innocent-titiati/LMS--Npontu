<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('create', Course::class);

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'manager_id' => Auth::id(),
            'status' => 'pending_approval',
        ]);

        return response()->json($course, 201);
    }
}
