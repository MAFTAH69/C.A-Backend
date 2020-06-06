<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
   public function getAllQuizzes()
    {
        $quizzes = Quiz::all();
        return response()->json([
            'All quizzes' => $quizzes
        ], 200);
    }

    public function getSingleQuiz($quizId)
    {
        $quiz = Quiz::find($quizId);
        if (!$quizId) {
            return response()->json([
                'error' => 'Quiz not found'
            ], 404);
        }
        return response()->json([
            'Quiz' => $quiz
        ], 200);
    }

    public function postQuiz(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $quiz = new Quiz();
        $quiz->title = $request->input('title');

        $quiz->save();
        return response()->json([
            'Posted quiz' => $quiz
        ], 200);
    }

    public function putQuiz(Request $request, $quizId)
    {
        $quiz = Quiz::find($quizId);
        if (!$quiz) {
            return response()->json([
                'error' => 'Quiz not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $quiz->update([
            'title' => $request->input('title'),
        ]);
        $quiz->save();
        return response()->json([
            'Edited quiz' => $quiz
        ], 200);
    }

    public function deleteQuiz($quizId)
    {
        $quiz = Quiz::find($quizId);
        if (!$quiz) {
            return response()->json([
                'error' => 'Quiz does not exist'
            ], 404);
        }

        $quiz->delete();
        return response()->json([
            'message' => 'Quiz deleted successfully'
        ], 200);
    }
}
