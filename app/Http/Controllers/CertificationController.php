<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    // Display all certifications
    public function index()
    {
        $certifications = Certification::with(['user', 'course'])->get();
        return view('certifications.index', compact('certifications'));
    }

    // Show form to create new certification
    public function create()
    {
        $users = User::all();
        $courses = Course::all();
        return view('certifications.create', compact('users', 'courses'));
    }

    // Store new certification
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
        ]);

        Certification::create($request->all());

        return redirect()->route('certifications.index')->with('success', 'Certification issued successfully.');
    }

    // Show details of a certification
    public function show($id)
    {
        $certification = Certification::findOrFail($id);
        return view('certifications.show', compact('certification'));
    }

    // Show form to edit certification
    public function edit($id)
    {
        $certification = Certification::findOrFail($id);
        $users = User::all();
        $courses = Course::all();
        return view('certifications.edit', compact('certification', 'users', 'courses'));
    }

    // Update certification
    public function update(Request $request, $id)
    {
        $certification = Certification::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
        ]);

        $certification->update($request->all());

        return redirect()->route('certifications.index')->with('success', 'Certification updated successfully.');
    }

    // Delete certification
    public function destroy($id)
    {
        Certification::findOrFail($id)->delete();
        return redirect()->route('certifications.index')->with('success', 'Certification deleted.');
    }
}
