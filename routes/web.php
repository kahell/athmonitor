<?php

Route::get('/', function () {
    return view('vue');
});

Route::group(['prefix' => 'api/'], function(){
  Route::resource('user', 'UserController');
  Route::resource('coach', 'CoachController');
});
