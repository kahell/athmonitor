<?php

Route::post('register','AuthController@register');
Route::post('login','AuthController@login');
Route::post('me','AuthController@me');
Route::post('logout','AuthController@logout');
Route::post('recover', 'AuthController@recover');
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');
    Route::get('test', function(){
        return response()->json(['foo'=>'bar']);
    });
});

Route::resource('user', 'UserController');
Route::resource('coach', 'CoachController');
Route::resource('athlete', 'AthleteController');
