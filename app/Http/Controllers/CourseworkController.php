<?php

namespace App\Http\Controllers;

use App\Course;
use App\Coursework;
use App\Score;
use App\User;
use Illuminate\Http\Request;


class CourseworkController extends Controller
{
    public function calculateCoursework($couserId)
    {

        $course = Course::find($couserId);

        if (!$course) return response()->json(['error' => 'course not found']);



        $users = $course->users()->with(['roles' => function ($q) {
            $q->where('name', 'Student');
        }])->get();

        $students = $users->reject(function ($user, $key) {
            return count($user->roles) == 0;
        })->values();

        foreach ($students as $student) {

            foreach ($course->tests as $test) {
                $test->score =    $test->scores->filter(function ($score, $key) use ($student, $test) {

                    $score->test_score = $score->scored_marks / $test->total_marks * $test->weight;
                    return $score->user_id == $student->id;
                })->values();
                // $test->pluck($this.$test->  scores);
            }
            foreach ($course->quizzes as $quiz) {
                $quiz->scores->reject(function ($score, $key) use ($student, $quiz) {
                    $score->quiz_score = $score->scored_marks / $quiz->total_marks * $quiz->weight;

                    return $score->user_id != $student->id;
                })->values();
            }
            foreach ($course->assignments as $assignment) {
                $assignment->scores->reject(function ($score, $key) use ($student, $assignment) {
                    $score->assignment_score = $score->scored_marks / $assignment->total_marks * $assignment->weight;

                    return $score->user_id == $student->id;
                })->values();
            }
            foreach ($course->practicals as $practical) {
                $practical->scores->reject(function ($score, $key) use ($student, $practical) {
                    $score->practical_score = $score->scored_marks / $practical->total_marks * $practical->weight;

                    return $score->user_id != $student->id;
                })->values();
            }
            $course->cw =100;

            $student->course = $course;
        }

        return response()->json(['students' => $students]);
    }
}
