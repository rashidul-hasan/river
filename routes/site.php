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

    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

//    Route::get('payment-method', 'Admin\PaymentController@index')->name('payment.index');

    //settings route:
    Route::get('settings', 'Admin\SettingsController@showSettings')->name('settings.index');
    Route::get('storefront', 'Admin\Settings\AppearanceController@storeFront')->name('store.front');
    Route::post('update/settings', 'Admin\Settings\SettingsController@updateSettings')->name('store-settings');
    Route::resource('sliders', 'Admin\Settings\SliderController');
    Route::resource('banners', 'Admin\SliderController');

});
