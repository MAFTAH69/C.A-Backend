<?php

namespace App\Http\Controllers;

use App\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SemesterController extends Controller
{
    public function getAllSemesters()
    {
        $semesters = Semester::all();
        return response()->json([
            'All semesters' => $semesters
        ], 200);
    }

    public function getSingleSemester($semesterId)
    {
        $semester = Semester::find($semesterId);
        if (!$semesterId) {
            return response()->json([
                'error' => 'Semester not found'
            ], 404);
        }
        return response()->json([
            'Semester' => $semester
        ], 200);
    }

    public function postSemester(Request $request)
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

        $semester = new Semester();
        $semester->title = $request->input('title');

        $semester->save();
        return response()->json([
            'Posted semester' => $semester
        ], 200);
    }

    public function putSemester(Request $request, $semesterId)
    {
        $semester = Semester::find($semesterId);
        if (!$semester) {
            return response()->json([
                'error' => 'Semester not found'
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

        $semester->update([
            'title' => $request->input('title'),
        ]);
        $semester->save();
        return response()->json([
            'Edited semester' => $semester
        ], 200);
    }

    public function deleteSemester($semesterId)
    {
        $semester = Semester::find($semesterId);
        if (!$semester) {
            return response()->json([
                'error' => 'Semester does not exist'
            ], 404);
        }

        $semester->delete();
        return response()->json([
            'message' => 'Semester deleted successfully'
        ], 200);
    }
}
