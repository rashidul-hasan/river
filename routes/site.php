<?php

//auth
Route::group([
    'middleware' => ['web', 'river.guest:customers'],
    'namespace' => 'Rashidul\River\Http\Controllers',
    'as' => 'riversite.'
    ], function () {
    Route::get('login', 'Customer\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Customer\Auth\LoginController@login')->name('login.post');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['web', 'river.auth:admins'],
    'namespace' => 'Rashidul\River\Http\Controllers',
    'as' => 'river.'
], function () {


});
