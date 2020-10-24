<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Questionnaire route
// Route::get('/questionnaires/create', [App\Http\Controllers\QuestionnaireController::class, 'create']);
// Route::get('/questionnaires/create', 'App\Http\Controllers\QuestionnaireController@create');
Route::get('/questionnaires/create', [QuestionnaireController::class, 'create']);
Route::post('/questionnaires',  [QuestionnaireController::class, 'store']);
Route::get('/questionnaires/{questionnaire}', [QuestionnaireController::class, 'show']);

// Question Route
Route::get('/questionnaires/{questionnaire}/questions/create',[QuestionController::class, 'create']);
Route::post('/questionnaires/{questionnaire}/questions',[QuestionController::class, 'store']);
Route::delete('/questionnaires/{questionnaire}/questions/{question}',[QuestionController::class, 'destroy']);

// Survey route
Route::get('/surveys/{questionnaire}-{slug}',[SurveyController::class, 'show']);
Route::post('/surveys/{questionnaire}-{slug}',[SurveyController::class, 'store']);
