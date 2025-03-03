<?php

namespace App\Http\Controllers;

use App\Models\Certifications;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function generate(Request $request) {
        Certificate::create($request->all());
        return response()->json(['message' => 'Certificate generated']);
    }
}
