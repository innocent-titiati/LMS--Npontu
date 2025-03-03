<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index() {
        return response()->json(Assessment::all());
    }

    public function store(Request $request) {
        $assessment = Assessment::create($request->all());
        return response()->json(['message' => 'Assessment created successfully']);
    }
}