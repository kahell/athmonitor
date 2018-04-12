<?php

// Route::get('/', function () {
//     return view('vue');
// });
Route::get('/', function () {
    return view('user/home' );
});
Route::get('login', function () {
    return view('admin/auth/login');
});

Route::get('admin', function () {
    return view('admin/auth/login');
});

Route::get('user/verify/{verification_code}', 'AuthController@verifyUser');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');
