<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Certifications;
use Illuminate\Http\Request;

class CertificationsController extends Controller
{
    /**
     * Display a listing of the certifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certifications = Certifications::with(['employee', 'course'])->get();
        return response()->json($certifications);
    }

    /**
     * Store a newly created certification in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'certificate_number' => 'required|string|unique:certifications,certificate_number',
            'course_id' => 'required|exists:courses,id',
            'issued_by' => 'nullable|string',
            'issued_date' => 'required|date',
        ]);

        $certification = Certifications::create($request->all());
        return response()->json($certification, 201);
    }

    /**
     * Display the specified certification.
     *
     * @param  \App\Models\Certifications  $certification
     * @return \Illuminate\Http\Response
     */
    public function show(Certifications $certification)
    {
        return response()->json($certification->load(['employee', 'course']));
    }

    /**
     * Update the specified certification in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certifications  $certification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certifications $certification)
    {
        $request->validate([
            'employee_id' => 'sometimes|required|exists:users,id',
            'certificate_number' => 'sometimes|required|string|unique:certifications,certificate_number,' . $certification->id,
            'course_id' => 'sometimes|required|exists:courses,id',
            'issued_by' => 'nullable|string',
            'issued_date' => 'sometimes|required|date',
        ]);

        $certification->update($request->all());
        return response()->json($certification);
    }

    /**
     * Remove the specified certification from storage.
     *
     * @param  \App\Models\Certifications  $certification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certifications $certification)
    {
        $certification->delete();
        return response()->json(null, 204);
    }
}