<?php

//auth
Route::group([
    'prefix' => 'admin',
    'middleware' => ['web', 'river.guest:admins'],
    'namespace' => 'Rashidul\River\Http\Controllers',
    'as' => 'river.'
    ], function () {
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login.post');
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
//    Route::get('settings', 'Admin\SettingsController@showSettings')->name('settings.index');
//    Route::get('shipping-method', 'Admin\SettingsController@shippingMethod')->name('shipping.method');
//    Route::get('storefront', 'Admin\AppearanceController@storeFront')->name('store.front');
//    Route::post('update/settings', 'Admin\SettingsController@updateSettings')->name('store-settings');

});
