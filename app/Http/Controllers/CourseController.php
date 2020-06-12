<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function getAllCourses()
    {
        $courses = Course::all();
        foreach($courses as $course){
            $course->tests;
            $course->quizzes;
            $course->practicals;
            $course->assignments;
        }
        return response()->json([
            'courses' => $courses
        ], 200);
    }

    public function getSingleCourse($courseId)
    {
        $course = Course::find($courseId);
        if (!$courseId) {
            return response()->json([
                'error' => 'Course not found'
            ], 404);
        }
        $course->tests;
        $course->quizzes;
        $course->practicals;
        $course->assignments;
        return response()->json([

            'course' => $course
        ], 200);
    }

    public function postCourse(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'title' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 404);
        }

        $course = new Course();
        $course->code = $request->input('code');
        $course->title = $request->input('title');

        // Save course
        $course->save();
        return response()->json([
            'course' => $course
        ], 200);
    }

    public function attachCourse(Request $request, $status)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'course_id' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 404);
        }

        $course = Course::find($request->course_id);
        if (!$course) return response()->json(['error' => 'Course not found'], 404);

        $user = User::find($request->user_id);
        if (!$user) return response()->json(['error' => 'User not found'], 404);

        if ($status == 'attach') $user->courses()->attach($course);

        if ($status == 'detach') $user->courses()->detach($course);

        $user->courses;
        return response()->json(['attachement' => $user]);
    }

    public function putCourse(Request $request, $courseId)
    {
        $course = Course::find($courseId);
        if (!$course) {
            return response()->json([
                'error' => 'Course not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $course->update([
            'code' => $request->input('code'),
            'title' => $request->input('title'),
        ]);
        $course->save();
        return response()->json([
            'Edited course' => $course
        ], 200);
    }

    public function deleteCourse($courseId)
    {
        $course = Course::find($courseId);
        if (!$course) {
            return response()->json([
                'error' => 'Course does not exist'
            ], 404);
        }

        $course->delete();
        return response()->json([
            'message' => 'Course deleted successfully'
        ], 200);
    }
}
