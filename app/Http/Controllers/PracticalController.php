<?php

namespace App\Http\Controllers;

use App\Course;
use App\Practical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PracticalController extends Controller
{
    public function getAllPracticals()
    {
        $practicals = Practical::all();
        return response()->json([
            'practicals' => $practicals
        ], 200);
    }

    public function getSinglePractical($practicalId)
    {
        $practical = Practical::find($practicalId);
        if (!$practicalId) {
            return response()->json([
                'error' => 'Practical not found'
            ], 404);
        }
        return response()->json([
            'practical' => $practical
        ], 200);
    }

    public function postPractical(Request $request, $courseId)
    {
        $course=Course::find($courseId);
        if(!$course) return response()->json(['error'=>'Course not found']);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'total-marks'=>'required'


        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $practical = new Practical();
        $practical->title = $request->input('title');
        $practical->total_marks = $request->input('total_marks');


        $course->practicals()->save($practical);
        return response()->json([
            'practical' => $practical
        ], 200);
    }

    public function putPractical(Request $request, $practicalId)
    {
        $practical = Practical::find($practicalId);
        if (!$practical) {
            return response()->json([
                'error' => 'Practical not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'total_marks'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $practical->update([
            'title' => $request->input('title'),
            'total_marks'=>$request->input('total_marks')
        ]);
        $practical->save();
        return response()->json([
            'practical' => $practical
        ], 200);
    }

    public function deletePractical($practicalId)
    {
        $practical = Practical::find($practicalId);
        if (!$practical) {
            return response()->json([
                'error' => 'Practical does not exist'
            ], 404);
        }

        $practical->delete();
        return response()->json([
            'message' => 'Practical deleted successfully'
        ], 200);
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
}
