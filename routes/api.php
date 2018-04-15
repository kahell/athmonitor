<?php
// Route::post('register','AuthController@register');
// Route::post('login','AuthController@login');
// Route::post('me','AuthController@me');
// Route::post('recover', 'AuthController@recover');
// Route::post('verifyPass', 'AuthController@verifyPass');
// Route::group(['middleware' => ['jwt.auth']], function() {
//     Route::get('logout', 'AuthController@logout');
// });

Route::resource('user', 'UserController');
Route::resource('coach', 'CoachController');
Route::resource('athlete', 'AthleteController');
