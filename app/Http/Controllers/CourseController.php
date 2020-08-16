<?php

namespace App\Http\Controllers;

use App\Course;
use App\Score;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as REQ;


class CourseController extends Controller
{
    public function getAllCourses()
    {
        $courses = Course::all();
        foreach ($courses as $course) {
            $course->users;

            $course->tests;
            foreach ($course->tests as $test) $test->scores;

            $course->quizzes;
            foreach ($course->quizzes as $quiz) $quiz->scores;

            $course->practicals;
            foreach ($course->practicals as $practical) $practical->scores;

            $course->assignments;
            foreach ($course->assignments as $assignment) $assignment->scores;
        }

        return response()->json([
            'courses' => $courses
        ], 200);
    }

    public function getSingleCourse($courseId)
    {
        $course = Course::find($courseId);
        if (!$courseId) {
            return back()->with('message', 'Course not found');
        }
        $course->users;

        $course->tests;
        foreach ($course->tests as $test) $test->scores;

        $course->quizzes;
        foreach ($course->quizzes as $quiz) $quiz->scores;

        $course->practicals;
        foreach ($course->practicals as $practical) $practical->scores;

        $course->assignments;
        foreach ($course->assignments as $assignment) $assignment->scores;

        if (REQ::is('api/*'))
            return response()->json([
                'course' => $course
            ], 200);
        return view('course', ['course' => $course]);
    }

    public function postCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'title' => 'required',
            'credits' => 'required',
            'semester' => 'required',
            'year' => 'required',

        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }


        $course = new Course();
        $course->code = $request->code;
        $course->title = $request->title;
        $course->credits = $request->credits;
        $course->semester = $request->semester;
        $course->year = $request->year;

        // Save course
        $course->save();
        return redirect('courses')->with('message', 'Course added successfully');
    }

    public function putCourse(Request $request, $courseId)
    {
        $course = Course::find($courseId);
        if (!$course) {
            return back()->with('message', 'Course not found');
        }

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'title' => 'required',
            'credits' => 'required',
            'year' => 'required',
            'semester' => 'required'

        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $course->update([
            'code' => $request->input('code'),
            'title' => $request->input('title'),
            'credits' => $request->input('credits'),
            'year' => $request->input('year'),
            'semester' => $request->input('semester')

        ]);
        $course->save();
        return back()->with('message', 'Course edited successfully');
    }

    public function deleteCourse($courseId)
    {
        $course = Course::find($courseId);
        if (!$course) {
            //
            return redirect()->with('message', 'Course not found');
        }

        $course->delete();
        return redirect('courses')->with('message', 'Course deleted successfully');
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
        return back()->with('message', 'Successfully');
    }

    public function index()
    {
        $courses = Course::all();
        foreach ($courses as $course) {
            $course->users;
        }
        return view('courses', ['courses' => $courses]);
    }


    // SCORES
    public function getAllScores()
    {
        $scores = Score::all();
        // foreach ($scores as $score) {

        // }

        return response()->json([
            'scores' => $scores
        ], 200);
    }
}
