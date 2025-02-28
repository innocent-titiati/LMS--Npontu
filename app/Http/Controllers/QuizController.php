<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the quizzes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::with(['course', 'module'])->get();
        return response()->json($quizzes);
    }

    /**
     * Store a newly created quiz in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'module_id' => 'required|exists:modules,id',
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D',
        ]);

        $quiz = Quiz::create($request->all());
        return response()->json($quiz, 201);
    }

    /**
     * Display the specified quiz.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return response()->json($quiz->load(['course', 'module']));
    }

    /**
     * Update the specified quiz in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question_text' => 'sometimes|required|string',
            'option_a' => 'sometimes|required|string',
            'option_b' => 'sometimes|required|string',
            'option_c' => 'sometimes|required|string',
            'option_d' => 'sometimes|required|string',
            'correct_option' => 'sometimes|required|in:A,B,C,D',
        ]);

        $quiz->update($request->all());
        return response()->json($quiz);
    }

    /**
     * Remove the specified quiz from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return response()->json(null, 204);
    }
}
