<?php

namespace App\Http\Controllers;

use App\Models\Modules;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index() {
        return response()->json(Module::all());
    }

    public function store(Request $request) {
        $module = Module::create($request->all());
        return response()->json(['message' => 'Module added successfully']);
    }

    public function show($id) {
        return response()->json(Module::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $module = Module::findOrFail($id);
        $module->update($request->all());
        return response()->json(['message' => 'Module updated successfully']);
    }

    public function destroy($id) {
        Module::destroy($id);
        return response()->json(['message' => 'Module deleted successfully']);
    }
}
