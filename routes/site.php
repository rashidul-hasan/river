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


//dd(config('river.enable_ecommerce'));
// E-commerce related routes
if(config('river.enable_ecommerce')) {
    Route::group([
        'prefix' => '',
        /*'middleware' => ['web', 'river.auth:admins'],*/
        'namespace' => 'Rashidul\River\Http\Controllers',
        'as' => 'river.site.'
    ], function () {
        Route::get('shop', 'Admin\DataEntryController@index')->name('shop');
        Route::get('checkout', 'Admin\DataEntryController@index')->name('checkout');
    });
}
