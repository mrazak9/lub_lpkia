<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionDetailController;
use App\Http\Controllers\QuestionGroupController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use GuzzleHttp\Promise\Create;

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
    return view('welcome');
});
// GOOGLE LOGIN ROUTE
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// END OF GOOGLE ROUTE
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('means', 'App\Http\Controllers\MeanController');
Route::resource('answers', 'App\Http\Controllers\AnswerController');
Route::resource('answer_details', 'App\Http\Controllers\AnswerDetailController');
Route::resource('students', StudentController::class);
Route::resource('lecturers', LecturerController::class);
Route::resource('schedules', ScheduleController::class);
Route::resource('responses', ResponseController::class);
Route::get('responses/showLub/{id}/{student_id}', [ResponseController::class, 'showLub'])->name('responses.showLub');

Route::resource('questions', QuestionController::class);
Route::get('questions/add_group/{id}', [QuestionController::class, 'addGroup'])->name('questions.add_group');
Route::post('questions/generate', [QuestionController::class, 'generate'])->name('questions.generate');

Route::resource('question_groups', QuestionGroupController::class);
Route::get('question_groups/add_detail/{id}', [QuestionGroupController::class, 'addDetail'])->name('question_groups.add_detail');
Route::resource('question_details', QuestionDetailController::class);
