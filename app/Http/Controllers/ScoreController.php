<?php

namespace App\Http\Controllers;

use App\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScoreController extends Controller
{
    public function getAllScores()
    {
        $scores = Score::all();
        return response()->json([
            'scores' => $scores
        ], 200);
    }

    public function getSingleScore($scoreId)
    {
        $score = Score::find($scoreId);
        if (!$scoreId) {
            return response()->json([
                'error' => 'Score not found'
            ], 404);
        }
        return response()->json([
            'score' => $score
        ], 200);
    }

    public function postScore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'course_id'=>'required',
            'marks' => 'required',
            'scorable_type' => 'required',
            'scorable_id' => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $score = new Score();
        $score->user_id = $request->input('user_id');
        $score->course_id = $request->input('course_id');
        $score->marks = $request->input('marks');
        $score->scorable_type = $request->input('scorable_type');
        $score->scorable_id = $request->input('scorable_id');

        $score->save();
        return response()->json([
            'score' => $score
        ], 200);
    }

    public function putScore(Request $request, $scoreId)
    {
        $score = Score::find($scoreId);
        if (!$score) {
            return response()->json([
                'error' => 'Score not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'course_id'=>'required',
            'marks' => 'required',
            'scorable_type' => 'required',
            'scorable_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $score->update([
            'user_id' => $request->input('user_id'),
            'course_id' => $request->input('course_id'),
            'marks' => $request->input('marks'),
            'scorable_type' => $request->input('scorable_type'),
            'scorable_id' => $request->input('scorable_id'),
        ]);
        $score->save();
        return response()->json([
            'score' => $score
        ], 200);
    }

    public function deleteScore($scoreId)
    {
        $score = Score::find($scoreId);
        if (!$score) {
            return response()->json([
                'error' => 'Score does not exist'
            ], 404);
        }

        $score->delete();
        return response()->json([
            'message' => 'Score deleted successfully'
        ], 200);
    }
}
