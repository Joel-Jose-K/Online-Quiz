<?php

namespace App\Http\Controllers;

use App\Models\QuizType;
use Illuminate\Http\Request;

class McqController extends Controller
{
    public function getMcqForm()
    {
        $quiz_types = QuizType::orderBy('id')->get();
        return view('quiz.mcq', ['quiz_types' => $quiz_types]);
    }

    public function submitMcq(Request $request)
    {
        $validated = $request->validate([
            'Question.*.question' => ['required','max:5','min:4']
        ]);
        dd($request->all());
    }
}
