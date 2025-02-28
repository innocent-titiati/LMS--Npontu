<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the enrollments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'course'])->get();
        return response()->json($enrollments);
    }

    /**
     * Store a newly created enrollment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'nullable|date',
            'completion_status' => 'required|in:enrolled,in-progress,completed',
        ]);

        $enrollment = Enrollment::create($request->all());
        return response()->json($enrollment, 201);
    }

    /**
     * Display the specified enrollment.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
        return response()->json($enrollment->load(['user', 'course']));
    }

    /**
     * Update the specified enrollment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'completion_status' => 'sometimes|required|in:enrolled,in-progress,completed',
        ]);

        $enrollment->update($request->all());
        return response()->json($enrollment);
    }

    /**
     * Remove the specified enrollment from storage.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return response()->json(null, 204);
    }
}
