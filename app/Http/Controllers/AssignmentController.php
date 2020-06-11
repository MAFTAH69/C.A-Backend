<?php

namespace App\Http\Controllers;
use App\Course;

use App\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    public function getAllAssignments()
    {
        $assignments = Assignment::all();
        return response()->json([
            'assignments' => $assignments
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

    public function postAssignment(Request $request, $courseId)
    {
        $course=Course::find($courseId);
        if(!$course) return response()->json(['error'=>'Course not found']);
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

        $course->assignments()->save($assignment);
        return response()->json([
            'assignment' => $assignment
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
            'assignment' => $assignment
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
    public function postScoreForAnAssignment(Request $request, $assignmentId)
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
        $assignment = Assignment::find($assignmentId);
        if (!$assignment) return response()->json(['error' => 'Assignment not found'], 404);

        $score = event(new CreateScoreEvent($assignment, $request));
        return response()->json(['score' => $score]);
    }
}
