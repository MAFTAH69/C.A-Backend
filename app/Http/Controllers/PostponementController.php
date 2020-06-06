<?php

namespace App\Http\Controllers;

use App\Postponement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostponementController extends Controller
{
    public function getAllPostponements()
    {
        $postponements = Postponement::all();
        return response()->json([
            'postponements' => $postponements
        ], 200);
    }
    public function getSinglePostponement($postponementId)
    {
        $postponement = Postponement::find($postponementId);
        if (!$postponementId) {
            return response()->json([
                'error' => 'Postponement not found'
            ], 404);
        }
        return response()->json([
            'postponement' => $postponement
        ], 200);
    }

    public function postPostponement(Request $request)
    {
        $this->path = null;

        $validator = Validator::make($request->all(), [
            'attachement' => 'required',
            'postponable_type' => 'required',
            'postponable_id' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        if ($request->hasFile('attachement')) {
            $this->attachement_path = $request->file('attachement')->store('postponements');
        } else return response()->json([
            'message' => 'Add a attachement file'
        ], 404);

        $postponement = new Postponement();
        $postponement->postponable_type = $request->input('postponable_type');
        $postponement->postponable_id = $request->input('postponable_id');
        $postponement->attachement = $this->attachement_path;


        $postponement->save();
        return response()->json([
            'postponement' => $postponement
        ], 200);
    }

    public function putPostponement(Request $request, $postponementId)
    {
        $postponement = Postponement::find($postponementId);
        if (!$postponement) {
            return response()->json([
                'error' => 'Postponement not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'postponable_type' => 'required',
            'postponable_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $postponement->update([
            'postponable_type' => $request->input('postponable_type'),
            'postponable_id' => $request->input('postponable_id'),
        ]);
        $postponement->save();
        return response()->json([
            'postponement' => $postponement
        ], 200);
    }

    public function deletePostponement($postponementId)
    {
        $postponement = Postponement::find($postponementId);
        if (!$postponement) {
            return response()->json([
                'error' => 'Postponement does not exist'
            ], 404);
        }

        $postponement->delete();
        return response()->json([
            'message' => 'Postponement deleted successfully'
        ], 200);
    }

    public function viewAttachementFile($postponementId)
    {
        $postponement = Postponement::find($postponementId);
        if (!$postponement) {
            return response()->json([
                'error' => 'Postponement not found'
            ], 404);
        }

        $pathToFile = storage_path('/app/' . $postponement->attachement);
        return response()->download($pathToFile);
    }
}
