<?php

namespace App\Http\Controllers;

use App\Postponement;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as REQ;


class PostponementController extends Controller
{
    public function getAllPostponements()
    {
        $postponements = Postponement::all();
        foreach ($postponements as $postponement) {
            $postponement->user;
        }
        return response()->json([
            'postponements' => $postponements
        ], 200);
    }
    public function getSinglePostponement($postponementId)
    {
        $postponement = Postponement::find($postponementId);
        if (!$postponement) {
            if (REQ::is('api/*'))
                return response()->json([
                    'error' => 'Postponement not found'
                ], 404);
            return redirect()->with('message', 'Postponement not found');
        }
        $postponement->user;
        if (REQ::is('api/*'))

            return response()->json([
                'postponement' => $postponement
            ], 200);

        return view('postponement', ['postponement' => $postponement]);
    }

    public function postPostponement(Request $request, $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found']);
        }

        $this->path = null;

        $validator = Validator::make($request->all(), [
            'attachement' => 'required',
            'postponable_type' => 'required',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        if ($request->hasFile('attachement')) {
            $this->attachement_path = $request->file('attachement')->store('postponements');
        } else
            return response()->json([
                'message' => 'Add an attachement file'
            ], 404);


        $postponement = new Postponement();
        $postponement->postponable_type = $request->input('postponable_type');
        $postponement->attachement = $this->attachement_path;

        // $postponement->save();
        $user->postponements()->save($postponement);

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
            if (REQ::is('api/*'))
                return response()->json([
                    'error' => 'Postponement does not exist'
                ], 404);
            return redirect()->with('message', 'Postponement not found');
        }

        $postponement->delete();

        if (REQ::is('api/*'))
            return response()->json(['message' => 'Postponement deleted successfully'], 200);
            return back()->with('message', 'Postponement deleted successfully');
    }

    public function viewAttachementFile($postponementId)
    {
        dd('here');
        $postponement = Postponement::find($postponementId);
        if (!$postponement) {
            return response()->json([
                'error' => 'Postponement not found'
            ], 404);
        }

        $pathToFile = storage_path('/app/' . $postponement->attachement);

        return back()->response()->file($pathToFile);
    }

    public function index()
    {
        $postponements = Postponement::all();
        foreach ($postponements as $postponement) {
            $postponement->user;
        }
        return view('postponements', ['postponements' => $postponements]);
    }
}
