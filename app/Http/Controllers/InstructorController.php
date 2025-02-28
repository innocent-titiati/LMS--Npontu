<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the instructors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::with(['course', 'user'])->get();
        return response()->json($instructors);
    }

    /**
     * Store a newly created instructor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $instructor = Instructor::create($request->all());
        return response()->json($instructor, 201);
    }

    /**
     * Display the specified instructor.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        return response()->json($instructor->load(['course', 'user']));
    }

    /**
     * Update the specified instructor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        $request->validate([
            'course_id' => 'sometimes|required|exists:courses,id',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $instructor->update($request->all());
        return response()->json($instructor);
    }

    /**
     * Remove the specified instructor from storage.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->delete();
        return response()->json(null, 204);
    }
}