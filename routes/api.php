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
Route::post('course/{userId}', ['uses' => 'CourseController@postCourse']);
Route::get('course/{courseId}', ['uses' => 'CourseController@getSingleCourse']);
Route::put('course/{courseId}', ['uses' => 'CourseController@putCourse']);
Route::delete('course/{courseId}', ['uses' => 'CourseController@deleteCourse']);



//  Routes for Letters
Route::get('letters', ['uses' => 'LetterController@getAllLetters']);
Route::post('letter', ['uses' => 'LetterController@postLetter']);
Route::get('letter/{letterId}', ['uses' => 'LetterController@getSingleLetter']);
Route::put('letter/{letterId}', ['uses' => 'LetterController@putLetter']);
Route::delete('letter/{letterId}', ['uses' => 'LetterController@deleteLetter']);
