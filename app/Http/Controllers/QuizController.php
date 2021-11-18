<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function getQuizForm()
    {
        $quiz_types = QuizType::orderBy('id')->get();
        return view('quiz.add-quiz', ['quiz_types' => $quiz_types]);
    }

    public function fetchQuizData()
    {
        $quiz_data = Quiz::with(['quiztype' => function($query){
            $query->select('id','name');
        }])->get();

        return response()->json([
            'quizdata' => $quiz_data
        ]);
    }

    public function submitQuiz(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quiz_type_id' => 'required',
            'title'        => 'required|max:250',
            'description'  => 'nullable',
            'active_from'  => 'required|date',
            'active_to'    => 'required|date',
            // 'is_publish'   => 'nullable',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else
        {
            $quiz               = new Quiz();
            $quiz->quiz_type_id = $request->quiz_type_id;
            $quiz->title        = $request->title;
            $quiz->description  = $request->description;
            $quiz->active_from  = $request->active_from; 
            $quiz->active_to    = $request->active_to;
            // $quiz->is_publish   = $request->is_publish;
            $quiz->created_by   = Auth::user()->id;
            $quiz->save();
            // dd($quiz->quiz_type_id);

            return response()->json([
                'status'  => 200,
                'message' => "New Quiz added successfully.",
            ]);
        }
    }

    public function editQuiz($id)
    {
        $quiz = Quiz::find($id);
        return response()->json([
            'status'  => 200,
            'message' => "Quiz details found.",
            'data'    => $quiz
        ]);
    }

    public function updateQuiz(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quiz_type_id' => 'required',
            'title'        => 'required|max:250',
            'description'  => 'nullable',
            'active_from'  => 'required|date',
            'active_to'    => 'required|date',
            // 'is_publish'   => 'nullable',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else
        {
            $quiz               = Quiz::find($id);
            $quiz->quiz_type_id = $request->quiz_type_id;
            $quiz->title        = $request->title;
            $quiz->description  = $request->description;
            $quiz->active_from  = $request->active_from; 
            $quiz->active_to    = $request->active_to;
            // $quiz->is_publish   = $request->is_publish;
            // $quiz->created_by   = Auth::user()->id;
            $quiz->save();
            // dd($quiz->quiz_type_id);

            return response()->json([
                'status'  => 200,
                'message' => "Quiz updated successfully.",
            ]);
        }
    }

    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        $quiz->delete();

        return response()->json([
            'status'  => 200,
            'message' => "Quiz deleted successfully.",
        ]);
    }
}
