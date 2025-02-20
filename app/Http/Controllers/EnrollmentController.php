<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function approve($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update(['status' => 'approved']);

        return response()->json(['message' => 'Enrollment approved.']);
    }
}
