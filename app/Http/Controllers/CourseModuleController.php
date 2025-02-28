<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class CourseModuleController extends Controller
{
    /**
     * Attach a module to a course.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $courseId
     * @return \Illuminate\Http\Response
     */
    public function attachModule(Request $request, $courseId)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'order' => 'nullable|integer',
        ]);

        $course = Course::findOrFail($courseId);
        $course->modules()->attach($request->module_id, ['order' => $request->order]);

        return response()->json(['message' => 'Module attached successfully.']);
    }

    /**
     * Detach a module from a course.
     *
     * @param  int  $courseId
     * @param  int  $moduleId
     * @return \Illuminate\Http\Response
     */
    public function detachModule($courseId, $moduleId)
    {
        $course = Course::findOrFail($courseId);
        $course->modules()->detach($moduleId);

        return response()->json(['message' => 'Module detached successfully.']);
    }

    /**
     * Update the order of modules in a course.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $courseId
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request, $courseId)
    {
        $request->validate([
            'modules' => 'required|array',
        ]);

        $course = Course::findOrFail($courseId);

        foreach ($request->modules as $order => $moduleId) {
            $course->modules()->updateExistingPivot($moduleId, ['order' => $order + 1]);
        }

        return response()->json(['message' => 'Module order updated successfully.']);
    }
}