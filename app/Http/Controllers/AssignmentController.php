<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    public function getAllAssignments()
    {
        $assignments = Assignment::all();
        return response()->json([
            'All assignments' => $assignments
        ], 200);
    }

    public function getSingleAssignment($assignmentId)
    {
        $assignment = Assignment::find($assignmentId);
        if (!$assignmentId) {
            return response()->json([
                'error' => 'Assignment not found'
            ], 404);
        }
        return response()->json([
            'Assignment' => $assignment
        ], 200);
    }

    public function postAssignment(Request $request)
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

        $assignment = new Assignment();
        $assignment->title = $request->input('title');

        $assignment->save();
        return response()->json([
            'Posted assignment' => $assignment
        ], 200);
    }

    public function putAssignment(Request $request, $assignmentId)
    {
        $assignment = Assignment::find($assignmentId);
        if (!$assignment) {
            return response()->json([
                'error' => 'Assignment not found'
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

        $assignment->update([
            'title' => $request->input('title'),
        ]);
        $assignment->save();
        return response()->json([
            'Edited assignment' => $assignment
        ], 200);
    }

    public function deleteAssignment($assignmentId)
    {
        $assignment = Assignment::find($assignmentId);
        if (!$assignment) {
            return response()->json([
                'error' => 'Assignment does not exist'
            ], 404);
        }

        $assignment->delete();
        return response()->json([
            'message' => 'Assignment deleted successfully'
        ], 200);
    }
}
