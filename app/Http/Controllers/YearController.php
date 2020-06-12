<?php

namespace App\Http\Controllers;

use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class YearController extends Controller
{
    public function getAllYears()
    {
        $years = Year::all();
        return response()->json([
            'years' => $years
        ], 200);
    }

    public function getSingleYear($yearId)
    {
        $year = Year::find($yearId);
        if (!$yearId) {
            return response()->json([
                'error' => 'Year not found'
            ], 404);
        }
        return response()->json([
            'year' => $year
        ], 200);
    }

    public function postYear(Request $request)
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

        $year = new Year();
        $year->title = $request->input('title');

        $year->save();
        return response()->json([
            'Posted year' => $year
        ], 200);
    }

    public function putYear(Request $request, $yearId)
    {
        $year = Year::find($yearId);
        if (!$year) {
            return response()->json([
                'error' => 'Year not found'
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

        $year->update([
            'title' => $request->input('title'),
        ]);
        $year->save();
        return response()->json([
            'Edited year' => $year
        ], 200);
    }

    public function deleteYear($yearId)
    {
        $year = Year::find($yearId);
        if (!$year) {
            return response()->json([
                'error' => 'Year does not exist'
            ], 404);
        }

        $year->delete();
        return response()->json([
            'message' => 'Year deleted successfully'
        ], 200);
    }
}
