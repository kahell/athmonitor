<?php
// Admin


// Users
/*
  This route for routing view Users
*/
Route::group(['namespace' => 'User'], function(){
  /* Home */
  Route::get('/','HomeController@index');
  Route::get('top_athlete','HomeController@top_athlete');
  Route::get('top_team','HomeController@top_team');
  Route::get('athlete','HomeController@athlete');
  Route::get('team','HomeController@team');
  Route::get('coach','HomeController@coach');

  /* Authentification */
  Route::get('login','CoachAuthController@loginForm')->name('login');
  Route::get('register','CoachAuthController@registerForm');
  Route::get('reset','CoachAuthController@resetForm');
  Route::get('reset/{token}', 'CoachAuthController@showResetForm');
  Route::get('logout','CoachAuthController@logout');

  Route::post('registerApi','CoachAuthController@register');
  Route::post('loginApi','CoachAuthController@login');
  Route::post('recoverApi', 'CoachAuthController@recover');
  Route::post('verifyPassApi', 'CoachAuthController@verifyPass');

  /* Dashboard User */
  Route::get("users",'DashboardController@index')->name('users');
  Route::get("users/{team}",'DashboardController@home');
  Route::get("users/{team}/team",'DashboardController@teamDetail');
  Route::get("users/{team}/athlete/{athlete}",'DashboardController@athlete');
  Route::get("users/{team}/monitor",'DashboardController@monitor');
});
