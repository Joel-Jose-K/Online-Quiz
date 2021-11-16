<?php

namespace App\Http\Controllers;

use App\Models\QuizType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizTypeController extends Controller
{
    public function getQuizTypeForm()
    {
        return view('quiz.quiz-type');
    }

    public function fetchQuiztype()
    {
        $quiz_types = QuizType::all();
        return response()->json([
            'quiztypes' => $quiz_types
        ]);
    }
    
    public function submitQuizType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|max:100',
            'unique_name' => 'required|max:100'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else
        {
            $quiz_type              = new QuizType;
            $quiz_type->name        = $request->name;
            $quiz_type->unique_name = $request->unique_name;
            $quiz_type->save();

            return response()->json([
                'status'  => 200,
                'message' => 'Quiz type added successfully!'
            ]);
        }
    }

    public function editQuizType($id)
    {
        $quiz_type = QuizType::find($id);
        if($quiz_type)
        {
            return response()->json([
                'status'  => 200,
                'quiz_type' => $quiz_type
            ]);
        }
        else
        {
            return response()->json([
                'status'  => 404,
                'message' => 'Quiz type not found'
            ]);
        }
    }

    public function updateQuizType(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|max:100',
            'unique_name' => 'required|max:100'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'  => 400,
                'errors' => $validator->messages()
            ]);
        }
        else
        {
            $quiz_type = QuizType::find($id);
            if($quiz_type)
            {
                $quiz_type->name        = $request->name;
                $quiz_type->unique_name = $request->unique_name;
                $quiz_type->update();
                return response()->json([
                    'status'  => 200,
                    'message' => 'Quiz type was updated successfully!'
                ]);
            }
            else
            {
                return response()->json([
                    'status'  => 404,
                    'message' => 'Quiz type not found'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $quiz_type = QuizType::find($id);
        $quiz_type->delete();
        return response()->json([
            'status'  => 200,
            'message' => 'The record has been deleted successfully!'
        ]);
    }
}
