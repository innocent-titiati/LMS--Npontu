<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseMaterial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseMaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is logged in
        $this->middleware('hr');   // Ensure user is HR
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'material_type' => 'required|in:pdf,video,slide',
            'file' => 'required|file|max:10240', // Max 10MB
        ]);

        // Store file
        $filePath = $request->file('file')->store('course_materials', 'public');

        // Create record in database
        CourseMaterial::create([
            'module_id' => $request->module_id,
            'material_type' => $request->material_type,
            'file_path' => $filePath,
            'uploaded_by' => Auth::id(),
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Course material uploaded successfully.'], 201);
    }
}
