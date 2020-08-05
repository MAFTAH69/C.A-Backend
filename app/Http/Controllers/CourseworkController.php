<?php

namespace App\Http\Controllers;

use App\Course;
use App\Coursework;
use App\Score;
use App\User;
use Illuminate\Http\Request;

class CourseworkController extends Controller
{
    public function calculateCoursework(){

        $students=User::where('role','Student');
        foreach($students as $student){
            foreach(Course::all() as $course){
                $scores=Score::where('user','1' && 'course_id','1');
                foreach($scores as $score){
                    $sum=++$score->marks;
                }
            }
            // $coursework= Coursework::create('user_id'=>1, course)
        }


    //     $scores=Score::where('user_id','userId' && 'course_id','courseId')
    }


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
