<?php
Route::group(['namespace' => 'Api\Admin'], function(){
  Route::post('register','CA_authController@register');
  Route::post('login','CA_authController@login');
  Route::post('me','CA_authController@me');
  Route::post('payload','CA_authController@payload');
  Route::post('refresh','CA_authController@refresh');
  Route::group(['middleware' => ['jwt.auth']], function() {
      Route::get('logout', 'CA_authController@logout');
  });
});
Route::group(['namespace' => 'Api\Sports'], function(){
  Route::get('sports', 'CA_sport@index');
});
Route::group(['namespace' => 'Api\User'], function(){
  Route::resource('teams', 'CA_team');
});
// Route::resource('user', 'UserController');
// Route::resource('coach', 'CoachController');
// Route::resource('athlete', 'AthleteController');
