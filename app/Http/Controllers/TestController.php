<?php

namespace App\Http\Controllers;

use App\Course;
use App\Events\CreateScoreEvent;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function getAllTests()
    {
        $tests = Test::all();
        foreach($tests as $test){
            // $test->scores;
        }
        return response()->json([
            'tests' => $tests
        ], 200);
    }

    public function getSingleTest($testId)
    {
        $test = Test::find($testId);
        if (!$testId) {
            return response()->json([
                'error' => 'Test not found'
            ], 404);
        }
        return response()->json([
            'Test' => $test
        ], 200);
    }

    public function postTest(Request $request, $courseId)
    {
        $course = Course::find($courseId);
        if (!$course) return response()->json(['error' => 'Course not found']);

        $validator = Validator::make($request->all(), [
            'title' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 404);
        }

        $test = new Test();
        $test->title = $request->input('title');

        $course->tests()->save($test);
        return response()->json([
            'test' => $test
        ], 200);
    }

    public function putTest(Request $request, $testId)
    {
        $test = Test::find($testId);
        if (!$test) {
            return response()->json([
                'error' => 'Test not found'
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

        $test->update([
            'title' => $request->input('title'),
        ]);
        $test->save();
        return response()->json([
            'Edited test' => $test
        ], 200);
    }

    public function deleteTest($testId)
    {
        $test = Test::find($testId);
        if (!$test) {
            return response()->json([
                'error' => 'Test does not exist'
            ], 404);
        }

        $test->delete();
        return response()->json([
            'message' => 'Test deleted successfully'
        ], 200);
    }

    public function postScoreForATest(Request $request, $testId)
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
        $test = Test::find($testId);
        if (!$test) return response()->json(['error' => 'Test not found'], 404);

        $score = event(new CreateScoreEvent($test, $request));
        return response()->json(['score' => $score]);
    }
}
