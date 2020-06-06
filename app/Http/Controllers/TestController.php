<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function getAllTests()
    {
        $tests = Test::all();
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
            'test' => $test
        ], 200);
    }

    public function postTest(Request $request)
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

        $test = new Test();
        $test->title = $request->input('title');

        $test->save();
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
            'test' => $test
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
}
