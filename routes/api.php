<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes for Users
Route::post('login', ['uses' => 'UserController@login']);
Route::post('logout', ['uses' => 'UserController@logout']);
Route::get('users', ['uses' => 'UserController@getAllUsers']);
Route::get('user/{userId}', ['uses' => 'UserController@getSingleUser']);
Route::post('register', ['uses' => 'UserController@registerUser']);
Route::delete('user/{userId}', ['uses' => 'UserController@deleteUser']);


//  Routes for Courses
Route::get('courses', ['uses' => 'CourseController@getAllCourses']);
Route::post('course', ['uses' => 'CourseController@postCourse']);
Route::get('course/{courseId}', ['uses' => 'CourseController@getSingleCourse']);
Route::put('course/{courseId}', ['uses' => 'CourseController@putCourse']);
Route::post('attachCourse/{status}', ['uses' => 'CourseController@attachCourse']);
Route::delete('course/{courseId}', ['uses' => 'CourseController@deleteCourse']);

//  Routes for Test
Route::get('tests', ['uses' => 'TestController@getAllTests']);
Route::post('test/{courseId}', ['uses' => 'TestController@postTest']);
Route::get('test/{testId}', ['uses' => 'TestController@getSingleTest']);
Route::put('test/{testId}', ['uses' => 'TestController@putTest']);
Route::delete('test/{testId}', ['uses' => 'TestController@deleteTest']);


//  Routes for Letters
Route::get('letters', ['uses' => 'LetterController@getAllLetters']);
Route::post('letter', ['uses' => 'LetterController@postLetter']);
Route::get('letter/{letterId}', ['uses' => 'LetterController@getSingleLetter']);
Route::put('letter/{letterId}', ['uses' => 'LetterController@putLetter']);
Route::delete('letter/{letterId}', ['uses' => 'LetterController@deleteLetter']);
Route::get('letter/sample/{letterId}', ['uses' => 'LetterController@viewSampleFile']);


//  Routes for Year
Route::get('years', ['uses' => 'YearController@getAllYears']);
Route::post('year', ['uses' => 'YearController@postYear']);
Route::get('year/{yearId}', ['uses' => 'YearController@getSingleYear']);
Route::put('year/{yearId}', ['uses' => 'YearController@putYear']);
Route::delete('year/{yearId}', ['uses' => 'YearController@deleteYear']);


//  Routes for Semester
Route::get('semesters', ['uses' => 'SemesterController@getAllSemesters']);
Route::post('semester', ['uses' => 'SemesterController@postSemester']);
Route::get('semester/{semesterId}', ['uses' => 'SemesterController@getSingleSemester']);
Route::put('semester/{semesterId}', ['uses' => 'SemesterController@putSemester']);
Route::delete('semester/{semesterId}', ['uses' => 'SemesterController@deleteSemester']);

//  Routes for Tests
Route::get('tests', ['uses' => 'TestController@getAllTests']);
Route::post('test', ['uses' => 'TestController@postTest']);
Route::get('test/{testId}', ['uses' => 'TestController@getSingleTest']);
Route::put('test/{testId}', ['uses' => 'TestController@putTest']);
Route::delete('test/{testId}', ['uses' => 'TestController@deleteTest']);

//  Routes for Assigments
Route::get('assignments', ['uses' => 'AssignmentController@getAllAssignments']);
Route::post('assignment', ['uses' => 'AssignmentController@postAssignment']);
Route::get('assignment/{assignmentId}', ['uses' => 'AssignmentController@getSingleAssignment']);
Route::put('assignment/{assignmentId}', ['uses' => 'AssignmentController@putAssignment']);
Route::delete('assignment/{assignmentId}', ['uses' => 'AssignmentController@deleteAssignment']);

//  Routes for Practicals
Route::get('practicals', ['uses' => 'PracticalController@getAllPracticals']);
Route::post('practical', ['uses' => 'PracticalController@postPractical']);
Route::get('practical/{practicalId}', ['uses' => 'PracticalController@getSinglePractical']);
Route::put('practical/{practicalId}', ['uses' => 'PracticalController@putPractical']);
Route::delete('practical/{practicalId}', ['uses' => 'PracticalController@deletePractical']);

//  Routes for Quizes
Route::get('quizzes', ['uses' => 'QuizController@getAllQuizzes']);
Route::post('quiz', ['uses' => 'QuizController@postQuiz']);
Route::get('quiz/{quizId}', ['uses' => 'QuizController@getSingleQuiz']);
Route::put('quiz/{quizId}', ['uses' => 'QuizController@putQuiz']);
Route::delete('quiz/{quizId}', ['uses' => 'QuizController@deleteQuiz']);

//
