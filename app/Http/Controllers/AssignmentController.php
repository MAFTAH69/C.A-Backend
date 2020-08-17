<?php

namespace App\Http\Controllers;

use App\Course;

use App\Assignment;
use App\Events\CreateScoreEvent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as REQ;

class AssignmentController extends Controller
{
    public function getAllAssignments()
    {
        $assignments = Assignment::all();
        foreach ($assignments as $assignment) {
            $assignment->scores;
        }
        return response()->json([
            'assignments' => $assignments
        ], 200);
    }

    public function getSingleAssignment($assignmentId)

    {
        $users=User::all();
        $assignment = Assignment::find($assignmentId);
        if (!$assignmentId) {
            return response()->json([
                'error' => 'Assignment not found'
            ], 404);
        }
        $assignment->scores;
        foreach ($assignment->scores as $score)
        $score->assignment_score = $score->scored_marks / $assignment->total_marks * $assignment->weight;
        if (REQ::is('api/*'))
            return response()->json([
                'assignment' => $assignment
            ], 200);
        return view('assignment')->with(['assignment'=> $assignment,'users'=> $users]);
    }

    public function postAssignment(Request $request, $courseId)
    {
        $course = Course::find($courseId);
        if (!$course) return response()->json(['error' => 'Course not found']);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'weight' => 'required',
            'total_marks' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $assignment = new Assignment();
        $assignment->title = $request->input('title');
        $assignment->weight = $request->input('weight');
        $assignment->total_marks = $request->input('total_marks');

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
            'weight' => 'required',
            'total_marks' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $assignment->update([
            'title' => $request->input('title'),
            'weight' => $request->input('weight'),
            'total_marks' => $request->input('total_marks')

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
