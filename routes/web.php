<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function () {

    // COURSES ROUTES
    Route::get('courses', 'CourseController@getAllCourses')->name('courses');
    Route::post('add_course', 'CourseController@postCourse')->name('add_course');
    Route::get('delete_course/{courseId}', 'CourseController@deleteCourse')->name('delete_course');
    Route::get('course/{courseId}', 'CourseController@getSingleCourse')->name('course');
    Route::post('attach_course/{status}', 'CourseController@attachCourse')->name('attach_course');
    Route::post('detach_course/{status}', 'CourseController@attachCourse')->name('detach_course');
    Route::get('edit_course/{courseId}', 'CourseController@putCourse')->name('edit_course');


    // TESTS ROUTES
    // Route::get('courses', 'CourseController@index')->name('courses');
    Route::get('test/{testId}', 'TestController@getSingleTest')->name('test');


    // QUIZZES ROUTES
    // Route::get('courses', 'CourseController@index')->name('courses');
    Route::get('quiz/{quizId}', 'QuizController@getSingleQuiz')->name('quiz');


    // ASSIGNMENTS ROUTES
    // Route::get('courses', 'CourseController@index')->name('courses');
    Route::get('assignment/{assignmentId}', 'AssignmentController@getSingleAssignment')->name('assignment');


    // PRACTICALS ROUTES
    // Route::get('courses', 'CourseController@index')->name('courses');
    Route::get('practical/{practicalId}', 'PracticalController@getSinglePractical')->name('practical');


    //  USERS ROUTES
    Route::get('users', 'UserController@getAllUsers')->name('users');
    Route::get('user/{userId}', 'UserController@getSingleUser')->name('user');
    Route::get('delete_user/{userId}', 'UserController@deleteUser')->name('delete_user');
    Route::post('register_user', 'UserController@registerUser')->name('register_user');
    Route::put('edit_user', 'UserController@putUser')->name('edit_user');


    //  ROLES ROUTES
    Route::get('roles', 'RoleController@index')->name('roles');
    Route::get('role/{roleId}', 'RoleController@getSingleRole')->name('role');
    Route::get('delete_role/{roleId}', 'RoleController@deleteRole')->name('delete_role');
    Route::post('add_role', 'RoleController@postRole')->name('add_role');
    Route::post('attach_role/{status}', 'RoleController@attachRoleToUser')->name('attach_role');
    Route::post('detach_role/{status}', 'RoleController@attachRoleToUser')->name('detach_role');
    Route::post('attach_role/{status}', 'RoleController@attachRoleToUser')->name('attach_role');


    //  POSTPONEMENTS ROUTES
    Route::get('postponements', 'PostponementController@index')->name('postponements');
    Route::get('postponement/{postponementId}', 'PostponementController@getSinglePostponement')->name('postponement');
    Route::get('delete_postponement/{postponementId}', 'PostponementController@deletePostponement')->name('delete_postponement');
    Route::get('postponement/attachement/{postponementId}', 'PostponementController@viewAttachementFile')->name('postponement/attachement');

    //  STUDENTS ROUTES
    Route::get('students', 'UserController@allStudents')->name('students');
    Route::get('student/{studentId}', 'UserController@getSingleStudent')->name('student');
    Route::get('delete_student/{studentId}', 'UserController@deleteUser')->name('delete_student');



    //  INSTRUCTORS ROUTES
    Route::get('instructors', 'UserController@allInstructors')->name('instructors');
    Route::get('instructor/{instructorId}', 'UserController@getSingleInstructor')->name('instructor');
    Route::get('delete_instructor/{instructorId}', 'UserController@deleteUser')->name('delete_instructor');


    // ROUTES FOR COMMENTS
    Route::get('comments', 'CommentController@getAllComments')->name('comments');
    Route::get('delete_comment/{commentId}', 'CommentController@deleteComment')->name('delete_comment');

});
