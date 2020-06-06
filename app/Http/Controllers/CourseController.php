<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function getAllCourses()
    {
        $courses = Course::all();
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
        return response()->json([
            'course' => $course
        ], 200);
    }

    public function postCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'code',
            'title' => 'title',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $course = new Course();
        $course->code = $request->input('code');
        $course->title = $request->input('title');

        $course->save();
        return response()->json([
            'course' => $course
        ], 200);
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
            'course' => $course
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
