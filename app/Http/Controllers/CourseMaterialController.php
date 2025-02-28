<?php

namespace App\Http\Controllers;

use App\Models\CourseMaterial;
use Illuminate\Http\Request;

class CourseMaterialController extends Controller
{
    /**
     * Display a listing of the course materials.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseMaterials = CourseMaterial::with(['course', 'module', 'user'])->get();
        return response()->json($courseMaterials);
    }

    /**
     * Store a newly created course material in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'module_id' => 'nullable|exists:modules,id',
            'material_type' => 'required|string|in:pdf,video,slide',
            'file_path' => 'required|string',
            'uploaded_by' => 'required|exists:users,id',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $courseMaterial = CourseMaterial::create($request->all());
        return response()->json($courseMaterial, 201);
    }

    /**
     * Display the specified course material.
     *
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(CourseMaterial $courseMaterial)
    {
        return response()->json($courseMaterial->load(['course', 'module', 'user']));
    }

    /**
     * Update the specified course material in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseMaterial $courseMaterial)
    {
        $request->validate([
            'material_type' => 'sometimes|required|string|in:pdf,video,slide',
            'file_path' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:pending,approved,rejected',
        ]);

        $courseMaterial->update($request->all());
        return response()->json($courseMaterial);
    }

    /**
     * Remove the specified course material from storage.
     *
     * @param  \App\Models\CourseMaterial  $courseMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseMaterial $courseMaterial)
    {
        $courseMaterial->delete();
        return response()->json(null, 204);
    }
}