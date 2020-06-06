<?php

namespace App\Http\Controllers;

use App\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExaminationController extends Controller
{
    public function getAllExaminations()
    {
        $examinations = Examination::all();
        return response()->json([
            'examinations' => $examinations
        ], 200);
    }

    public function getSingleExamination($examinationId)
    {
        $examination = Examination::find($examinationId);
        if (!$examinationId) {
            return response()->json([
                'error' => 'Examination not found'
            ], 404);
        }
        return response()->json([
            'examination' => $examination
        ], 200);
    }

    public function postExamination(Request $request)
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

        $examination = new Examination();
        $examination->title = $request->input('title');

        $examination->save();
        return response()->json([
            'examination' => $examination
        ], 200);
    }

    public function putExamination(Request $request, $examinationId)
    {
        $examination = Examination::find($examinationId);
        if (!$examination) {
            return response()->json([
                'error' => 'Examination not found'
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

        $examination->update([
            'title' => $request->input('title'),
        ]);
        $examination->save();
        return response()->json([
            'examination' => $examination
        ], 200);
    }

    public function deleteExamination($examinationId)
    {
        $examination = Examination::find($examinationId);
        if (!$examination) {
            return response()->json([
                'error' => 'Examination does not exist'
            ], 404);
        }

        $examination->delete();
        return response()->json([
            'message' => 'Examination deleted successfully'
        ], 200);
    }
}
