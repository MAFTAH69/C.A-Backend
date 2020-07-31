<?php

namespace App\Http\Controllers;

use App\Coursework;
use App\Score;
use Illuminate\Http\Request;

class CourseworkController extends Controller
{
    // public function calculateCoursework(){
    //     $scores=Score::where('user_id','userId' && 'course_id','courseId')
    // }


    // public function postCourse(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'code' => 'required',
    //         'title' => 'required',
    //         'credits' => 'required',
    //         'semester' => 'required',
    //         'year' => 'required',

    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'error' => $validator->errors(),
    //         ], 404);
    //     }

    //     $course = new Course();
    //     $course->code = $request->input('code');
    //     $course->title = $request->input('title');
    //     $course->credits = $request->input('credits');
    //     $course->semester = $request->input('semester');
    //     $course->year = $request->input('year');

    //     // Save course
    //     $course->save();
    //     return response()->json([
    //         'course' => $course
    //     ], 200);
    // }
}
