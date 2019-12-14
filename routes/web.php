<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'LandingController');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/account', 'AccountController@index')->name('home');
    Route::put('/account/{client}/', 'AccountController@update')->name('profile.update');
    Route::post('/account/{client}/password', 'ChangePasswordController')->name('change.password');
    Route::post('integration/generate', 'GenerateTokenController')->name('generate.token');
});
