<?php

Route::group(['prefix' => 'admin', 'middleware' => 'web', 'namespace' => 'Rashidul\River\Http\Controllers'], function () {

    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
//    Route::get('payment-method', 'Admin\PaymentController@index')->name('payment.index');

    //settings route:
//    Route::get('settings', 'Admin\SettingsController@showSettings')->name('settings.index');
//    Route::get('shipping-method', 'Admin\SettingsController@shippingMethod')->name('shipping.method');
//    Route::get('storefront', 'Admin\AppearanceController@storeFront')->name('store.front');
//    Route::post('update/settings', 'Admin\SettingsController@updateSettings')->name('store-settings');

});
