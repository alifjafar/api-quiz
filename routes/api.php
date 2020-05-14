<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('quiz/{quiz}/submit','SubmitQuizController');
    Route::get('quiz/public', 'PublicQuizController');
    Route::resource('quiz', 'QuizController');
    Route::get('categories', 'CategoryController');
    Route::get('categories/{category}/quiz/private', 'QuizCategoryController@private');
    Route::get('categories/{category}/quiz/public', 'QuizCategoryController@public');
    Route::get('intermezzo/{date}', 'IntermezzoController');
});
