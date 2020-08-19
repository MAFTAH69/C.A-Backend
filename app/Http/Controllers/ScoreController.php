<?php

namespace App\Http\Controllers;

use App\Events\CreateScoreEvent;
use App\Imports\ScoresImport;
use App\Score;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ScoreController extends Controller
{
    public function getAllScores()
    {
        $scores = Score::all();

        return response()->json([
            'scores' => $scores
        ], 200);
    }
    // public function import(Request $request)
    // {
    //     $request->validate([
    //         'import_file' => 'required|file|mimes:xls,xlsx'
    //     ]);

    //     $path = $request->file('import_file');

    //     $data = Excel::import(new ScoresImport, $path);

    //     return response()->json(['message' => 'File uploaded successfully'], 200);
    // }
    public function postScoreForATest(Request $request, $testId)
    {
        // return response()->json([
        //     'request' => $request->all(),
        // ]);

        $validator = Validator::make($request->all(), [
            'import_file' => 'required|file|mimes:xls,xlsx'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 404);
        }

        $path = $request->file('import_file');

        $test = Test::find($testId);
        if (!$test) return response()->json(['error' => 'Test not found'], 404);

        // $score = event(new CreateScoreEvent($test, $request));
        $data = Excel::import(new ScoresImport('App\\Test', $test->id), $path);


        return response()->json(['message' => 'File uploaded successfully'], 200);
    }

    public function postScoreForAQuiz(Request $request, $quizId)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'scored_marks' => 'required',
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

    public function postScoreForAPractical(Request $request, $practicalId)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'scored_marks' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 404);
        }
        $practical = Practical::find($practicalId);
        if (!$practical) return response()->json(['error' => 'Practical not found'], 404);

        $score = event(new CreateScoreEvent($practical, $request));
        return response()->json(['score' => $score]);
    }

    public function postScoreForAnAssignment(Request $request, $assignmentId)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'scored_marks' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 404);
        }
        $assignment = Assignment::find($assignmentId);
        if (!$assignment) return response()->json(['error' => 'Assignment not found'], 404);

        $score = event(new CreateScoreEvent($assignment, $request));
        return response()->json(['score' => $score]);
    }


}








    // public function getSingleScore($scoreId)
    // {
    //     $score = Score::find($scoreId);
    //     if (!$scoreId) {
    //         return response()->json([
    //             'error' => 'Score not found'
    //         ], 404);
    //     }
    //     return response()->json([
    //         'score' => $score
    //     ], 200);
    // }

    // public function postScore(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'marks' => 'required',
    //         'scorable_type' => 'required',
    //         'scorable_id' => 'required',

    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'error' => $validator->errors(),
    //             'status' => false
    //         ], 404);
    //     }

    //     $score = new Score();
    //     $score->marks = $request->input('marks');
    //     $score->scorable_type = $request->input('scorable_type');
    //     $score->scorable_id = $request->input('scorable_id');

    //     $score()->save();
    //     return response()->json([
    //         'score' => $score
    //     ], 200);
    // }

    // public function putScore(Request $request, $scoreId)
    // {
    //     $score = Score::find($scoreId);
    //     if (!$score) {
    //         return response()->json([
    //             'error' => 'Score not found'
    //         ], 404);
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'marks' => 'required',
    //         'scorable_type' => 'required',
    //         'scorable_id' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'error' => $validator->errors(),
    //             'status' => false
    //         ], 404);
    //     }

    //     $score->update([
    //         'marks' => $request->input('marks'),
    //         'scorable_type' => $request->input('scorable_type'),
    //         'scorable_id' => $request->input('scorable_id'),
    //     ]);
    //     $score->save();
    //     return response()->json([
    //         'score' => $score
    //     ], 200);
    // }

    // public function deleteScore($scoreId)
    // {
    //     $score = Score::find($scoreId);
    //     if (!$score) {
    //         return response()->json([
    //             'error' => 'Score does not exist'
    //         ], 404);
    //     }

    //     $score->delete();
    //     return response()->json([
    //         'message' => 'Score deleted successfully'
    //     ], 200);
    // }
