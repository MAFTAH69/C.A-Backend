<?php

namespace App\Http\Controllers;

use App\Course;
use App\Quiz;
use App\Events\CreateScoreEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function getAllQuizzes()
    {
        $quizzes = Quiz::all();
        foreach($quizzes as $quiz){
            // $quiz->scores;
        }
        return response()->json([
            'quizzes' => $quizzes
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

    public function postQuiz(Request $request, $courseId)
    {
        $course = Course::find($courseId);
        if (!$course) return response()->json(['error' => 'Course not found']);

        $validator = Validator::make($request->all(), [
            'title' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 404);
        }

        $quiz = new Quiz();
        $quiz->title = $request->input('title');

        $course->quizzes()->save($quiz);
        return response()->json([
            'quiz' => $quiz
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

    public function postScoreForAQuiz(Request $request, $quizId)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'marks' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 404);
        }
        $quiz = Quiz::find($quizId);
        if (!$quiz) return response()->json(['error' => 'Quiz not found'], 404);

        $score = event(new CreateScoreEvent($quiz, $request));
        return response()->json(['score' => $score]);
    }
}
