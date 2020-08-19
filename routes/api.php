<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([

    'middleware' => 'api',


], function () {
    Route::get('users', ['uses' => 'UserController@getAllUsers'])->middleware('auth');


    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('user', 'AuthController@me');
});

Route::group([

    'middleware' => 'api',


], function () {
    Route::get('users', ['uses' => 'UserController@getAllUsers'])->middleware('auth');

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('user', 'AuthController@me');


// Routes for Users
Route::get('users', ['uses' => 'UserController@getAllUsers']);
Route::get('user/{userId}', ['uses' => 'UserController@getSingleUserApi']);


// Routes for Roles
Route::get('role/{roleId}', ['uses' => 'RoleController@getSingleRole']);
Route::get('roles', ['uses' => 'RoleController@getAllRoles']);
Route::post('role', ['uses' => 'RoleController@postRole']);
Route::delete('role/{roleId}', ['uses' => 'RoleController@deleteRole']);
Route::post('attachRole/{status}', ['uses' => 'RoleController@attachRoleToUser']);


//  Routes for Courses
Route::get('courses', ['uses' => 'CourseController@getAllCourses']);
Route::post('course', ['uses' => 'CourseController@postCourse']);
Route::get('course/{courseId}', ['uses' => 'CourseController@getSingleCourse']);
Route::put('course/{courseId}', ['uses' => 'CourseController@putCourse']);
Route::post('attachCourse/{status}', ['uses' => 'CourseController@attachCourse']);
Route::delete('course/{courseId}', ['uses' => 'CourseController@deleteCourse']);
Route::get('scores', ['uses' => 'ScoreController@getAllScores']);



//  Routes for Assigments
Route::get('assignments', ['uses' => 'AssignmentController@getAllAssignments']);
Route::post('assignment/{courseId}', ['uses' => 'AssignmentController@postAssignment']);
Route::get('assignment/{assignmentId}', ['uses' => 'AssignmentController@getSingleAssignment']);
Route::put('assignment/{assignmentId}', ['uses' => 'AssignmentController@putAssignment']);
Route::delete('assignment/{assignmentId}', ['uses' => 'AssignmentController@deleteAssignment']);

//  Routes for Practicals
Route::get('practicals', ['uses' => 'PracticalController@getAllPracticals']);
Route::post('practical/{courseId}', ['uses' => 'PracticalController@postPractical']);
Route::get('practical/{practicalId}', ['uses' => 'PracticalController@getSinglePractical']);
Route::put('practical/{practicalId}', ['uses' => 'PracticalController@putPractical']);
Route::delete('practical/{practicalId}', ['uses' => 'PracticalController@deletePractical']);

//  Routes for Quizes
Route::get('quizzes', ['uses' => 'QuizController@getAllQuizzes']);
Route::post('quiz/{courseId}', ['uses' => 'QuizController@postQuiz']);
Route::get('quiz/{quizId}', ['uses' => 'QuizController@getSingleQuiz']);
Route::put('quiz/{quizId}', ['uses' => 'QuizController@putQuiz']);
Route::delete('quiz/{quizId}', ['uses' => 'QuizController@deleteQuiz']);

//  Routes for Test
Route::get('tests', ['uses' => 'TestController@getAllTests']);
Route::post('test/{courseId}', ['uses' => 'TestController@postTest']);
Route::get('test/{testId}', ['uses' => 'TestController@getSingleTest']);
Route::put('test/{testId}', ['uses' => 'TestController@putTest']);
Route::delete('test/{testId}', ['uses' => 'TestController@deleteTest']);


// *****************************

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

//  Routes for Letters
Route::get('letters', ['uses' => 'LetterController@getAllLetters']);
Route::post('letter', ['uses' => 'LetterController@postLetter']);
Route::get('letter/{letterId}', ['uses' => 'LetterController@getSingleLetter']);
Route::put('letter/{letterId}', ['uses' => 'LetterController@putLetter']);
Route::delete('letter/{letterId}', ['uses' => 'LetterController@deleteLetter']);
Route::get('letter/sample/{letterId}', ['uses' => 'LetterController@viewSampleFile']);

//  Routes for Postponements
Route::get('postponements', ['uses' => 'PostponementController@getAllPostponements']);
Route::post('postponement/{userId}', ['uses' => 'PostponementController@postPostponement']);
Route::get('postponement/{postponementId}', ['uses' => 'PostponementController@getSinglePostponement']);
Route::put('postponement/{postponementId}', ['uses' => 'PostponementController@putPostponement']);
Route::delete('postponement/{postponementId}', ['uses' => 'PostponementController@deletePostponement']);
Route::get('postponement/attachement/{postponementId}', ['uses' => 'PostponementController@viewAttachementFile']);


//calculate course work
Route::get('calculate/{courseId}', ['uses' => 'CourseworkController@calculateCoursework']);
Route::post('scores/import',['uses'=>'ScoreController@import']);


//  ROUTES FOR COMMENTS
Route::post('comment',['uses'=>'CommentController@postComment']);
Route::get('comments',['uses'=>'CommentController@getAllComments']);


//  ROUTES FOR SCORES
Route::post('scores/import',['uses'=>'ScoreController@import']);
Route::post('testScore/{testId}', ['uses' => 'ScoreController@postScoreForATest']);
Route::post('quizScore/{quizId}', ['uses' => 'ScoreController@postScoreForAQuiz']);
Route::post('assignmentScore/{assignmentId}', ['uses' => 'ScoreController@postScoreForAnAssignment']);
Route::post('practicalScore/{practicalId}', ['uses' => 'ScoreController@postScoreForAPractical']);


 });

