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


Route::group(['middleware' => ['auth:api']], function () {
    Route::post('quiz/{quiz}/submit','SubmitQuizController');
    Route::get('quiz_public', 'PublicQuizController');
    Route::resource('quiz', 'QuizController');
    Route::get('categories', 'CategoryController');
    Route::get('categories/{category}/quiz/private', 'QuizCategoryController@private');
    Route::get('categories/{category}/quiz/public', 'QuizCategoryController@public');
    Route::get('intermezzo/{date}', 'IntermezzoController');
});
