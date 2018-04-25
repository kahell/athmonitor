<?php
// Admin


// Users
/*
  This route for routing view Users
*/
Route::group(['namespace' => 'View\User'], function(){
  /* Home */
  Route::get('/','C_home@index');
  Route::get('top_athlete','C_home@top_athlete');
  Route::get('top_team','C_home@top_team');
  Route::get('athlete','C_home@athlete');
  Route::get('team','C_home@team');
  Route::get('coach','C_home@coach');

  /* Authentification */
  Route::get('login','C_authController@loginForm')->name('login');
  Route::get('user/verify/{token}','C_authController@verifyUser');
  Route::get('register','C_authController@registerForm');
  Route::get('reset','C_authController@resetForm');
  Route::get('reset/{token}', 'C_authController@showResetForm');
  Route::get('logout','C_authController@logout');

  Route::post('registerApi','C_authController@register');
  Route::post('loginApi','C_authController@login');
  Route::post('recoverApi', 'C_authController@recover');
  Route::post('verifyPassApi', 'C_authController@verifyPass');

  /* Dashboard User */
  Route::get("users",'C_dashboard@index')->name('users');
  Route::get("users/{team}",'C_dashboard@home');
  Route::get("users/{team}/team",'C_dashboard@teamDetail');
  Route::get("users/{team}/athlete/{athlete}",'C_dashboard@athlete');
  Route::get("users/{team}/monitor",'C_dashboard@monitor');
  Route::get("users/{team}/monitor/{athlete}",'C_dashboard@scoring');
});
