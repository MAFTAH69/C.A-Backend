<?php

namespace App\Http\Controllers;

use App\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LetterController extends Controller
{
    public function getAllLetters()
    {
        $letters = Letter::all();
        return response()->json([
            'letters' => $letters
        ], 200);
    }
    public function getSingleLetter($letterId)
    {
        $letter = Letter::find($letterId);
        if (!$letterId) {
            return response()->json([
                'error' => 'Letter not found'
            ], 404);
        }
        return response()->json([
            'letter' => $letter
        ], 200);
    }

    public function postLetter(Request $request)
    {
        $this->path = null;

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'sample' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        if ($request->hasFile('sample')) {
            $this->sample_path = $request->file('sample')->store('letters');
        } else return response()->json([
            'message' => 'Add a sample file'
        ], 404);

        $letter = new Letter();
        $letter->title = $request->input('title');
        $letter->sample = $this->sample_path;


        $letter->save();
        return response()->json([
            'letter' => $letter
        ], 200);
    }

    public function putLetter(Request $request, $letterId)
    {
        $letter = Letter::find($letterId);
        if (!$letter) {
            return response()->json([
                'error' => 'Letter not found'
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

        $letter->update([
            'title' => $request->input('title'),
        ]);
        $letter->save();
        return response()->json([
            'letter' => $letter
        ], 200);
    }

    public function deleteLetter($letterId)
    {
        $letter = Letter::find($letterId);
        if (!$letter) {
            return response()->json([
                'error' => 'Letter does not exist'
            ], 404);
        }

        $letter->delete();
        return response()->json([
            'message' => 'Letter deleted successfully'
        ], 200);
    }

    public function viewSampleFile($letterId)
    {
        $letter = Letter::find($letterId);
        if (!$letter) {
            return response()->json([
                'error' => 'Letter not found'
            ], 404);
        }

        $pathToFile = storage_path('/app/' . $letter->sample);
        return response()->download($pathToFile);
    }
}
