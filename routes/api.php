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
  /* Position Type */
  Route::post('position','CA_position_type@store');
  Route::post('position/update/{position_type}','CA_position_type@update');
  Route::get('position','CA_position_type@index');
  Route::get('position/{position_type}','CA_position_type@show');
  Route::get('position/{position_type}/edit','CA_position_type@edit');
  Route::delete('position/{position_type}','CA_position_type@destroy');
});
Route::group(['namespace' => 'Api\User'], function(){
  /* Team */
  Route::post('teams','CA_team@store');
  Route::post('teams/update/{team}','CA_team@update');
  Route::get('teams','CA_team@index');
  Route::get('teams/{team}','CA_team@show');
  Route::get('teams/{team}/edit','CA_team@edit');
  Route::delete('teams/{team}','CA_team@destroy');
  /* Athlete */
  Route::post('athletes','CA_athlete@store');
  Route::post('athletes/update/{athlete}','CA_athlete@update');
  Route::get('athletes','CA_athlete@index');
  Route::get('athletes/{athlete}','CA_athlete@show');
  Route::get('athletes/{athlete}/edit','CA_athlete@edit');
  Route::delete('athletes/{athlete}','CA_athlete@destroy');
  /* Achievement */
  Route::post('achievements','CA_achievement@store');
  Route::post('achievements/update/{achievement}','CA_achievement@update');
  Route::get('achievements','CA_achievement@index');
  Route::get('achievements/{achievement}','CA_achievement@show');
  Route::get('achievements/{achievement}/edit','CA_achievement@edit');
  Route::delete('achievements/{achievement}','CA_achievement@destroy');
  /* Activity */
  Route::post('activities','CA_activity@store');
  Route::post('activities/update/{activity}','CA_activity@update');
  Route::get('activities','CA_activity@index');
  Route::get('activities/{activity}','CA_activity@show');
  Route::get('activities/{activity}/edit','CA_activity@edit');
  Route::delete('activities/{activity}','CA_activity@destroy');
});
