<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizType;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\QuestionAnswerOption;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\CssSelector\Node\ElementNode;

class McqController extends Controller
{
    public function getMcqForm()
    {
        $quiz = Quiz::orderBy('id')->get();
        return view('quiz.mcq', ['quizs' => $quiz]);
    }

    public function getContestView($id)
    {
        $quiz = Quiz::find($id);
        
        return view('quiz.list-mcq-questions', ['quiz' => $quiz]);
    }

    public function submitMcq(Request $request)
    {
        $validated = Validator::make($request->all(),
            [
                'question.*.question'             => ['required', 'max:30', 'min:4'],
                'question.*.type'                 => ['required','exists:quizzes,id'],
                'question.*.option.*.option_text' => ['required'],
                'question.*.type.*.is_answer'     => ['required'],
            ],
            [
                'question.*.question.required'             => 'Question is required.',
                'question.*.question.min'                  => 'Please check if all questions have a minimum of 4 characters.',
                'question.*.type.required'                 => 'Question type is required.',
                'question.*.option.*.option_text.required' => 'Please add an option.',
                'question.*.type.*.is_answer.required'     => 'Please select the correct option.',
            ]
        );
        // dd($request->all());

        if($validated->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validated->messages(),
            ]);
        }
        else
        {
            foreach($request->question as $q)
            {
                $mcq_question_data           = new Question();
                $mcq_question_data->question = $q['question'];
                $mcq_question_data->save();           

                $mcq_quiz_question_data   = new QuizQuestion();
                $mcq_quiz_question_data->quiz_id = $q['type'];
                $mcq_quiz_question_data->question_id = $mcq_question_data->id;
                $mcq_quiz_question_data->answer_score = 2;

                foreach($q['option'] as $qa){

                    $mcq_question_answer_data              = new QuestionAnswerOption();
                    $mcq_question_answer_data->question_id = $mcq_question_data->id;
                    $mcq_question_answer_data->answer_option = $qa['option_text'];
                    $mcq_question_answer_data->save();

                    if(isset($qa['is_answer']) && $qa['is_answer'] == 'on')
                    {
                        $mcq_quiz_question_data->question_answer_option_id = $mcq_question_answer_data->id;
                    }
                }
                
                $mcq_quiz_question_data->save();

                return response()->json([
                    'status'  => 200,
                    'message' => "New Quiz added successfully.",
                ]);
            }
        }


    }
}
