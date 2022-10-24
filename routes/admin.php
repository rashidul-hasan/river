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
    'middleware' => ['web', 'river.auth:admins', 'river.checkrole'],
    'namespace' => 'Rashidul\River\Http\Controllers',
    'as' => 'river.'
], function () {

    //users crud
    Route::resource('users', 'Admin\UsersController');

    Route::resource('users-role', 'Admin\UsersRoleController');
    Route::resource('pages', 'Admin\RiverPagesController');

    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

//    Route::get('payment-method', 'Admin\PaymentController@index')->name('payment.index');

    //settings route:
//    Route::get('settings', 'Admin\SettingsController@showSettings')->name('settings.index');
    Route::get('storefront', 'Admin\Settings\AppearanceController@storeFront')->name('store.front');
    Route::post('update/settings', 'Admin\Settings\SettingsController@updateSettings')->name('store-settings');
    Route::resource('sliders', 'Admin\Settings\SliderController');

    Route::resource('banners', 'Admin\Settings\BannersController');

    //template manager
    Route::resource('template-pages', 'Admin\TemplatePageController')->except(['create', 'show']);
    Route::get('assets', 'Admin\TemplatePageController@assets')->name('templates.assets');
    Route::get('CacheView', 'Admin\TemplatePageController@CacheView')->name('CacheView');
//    Route::get('pages/{id}', 'Admin\TemplatePageController@editPage')->name('templates.pages.edit');

    Route::post('datatypes/store-fields', 'Admin\DataTypeController@storeFields')->name('datatypes.store-fields');
    Route::put('datatypes/update-fields', 'Admin\DataTypeController@updateFields')->name('datatypes.update-fields');
    Route::post('datatypes/field-meta', 'Admin\DataTypeController@fieldMeta')->name('datatypes.field-meta');
    Route::get('datatypes/export', 'Admin\DataTypeController@export')->name('datatypes.export');
    Route::get('download', 'Admin\DataTypeController@download')->name('download.page');
    Route::get('download-item/{id}/{file}', 'Admin\DataTypeController@downloadItem')->name('download.item');
    Route::get('datatypes/import', 'Admin\DataTypeController@import')->name('datatypes.import');
    Route::post('datatypes/import', 'Admin\DataTypeController@importPost')->name('datatypes.postimport');
    Route::resource('datatypes', 'Admin\DataTypeController');

    //data entry routes
    Route::get('data-entries/{slug}', 'Admin\DataEntryController@index')->name('data-entries.index');
    Route::get('data-entries/{slug}/create', 'Admin\DataEntryController@create')->name('data-entries.create');
    Route::post('data-entries/{slug}', 'Admin\DataEntryController@store')->name('data-entries.store');
    Route::get('data-entries/{slug}/show/{id}', 'Admin\DataEntryController@show')->name('data-entries.show');
    Route::get('data-entries/{slug}/edit/{id}', 'Admin\DataEntryController@edit')->name('data-entries.edit');
    Route::get('data-entries/{slug}/destroy/{id}', 'Admin\DataEntryController@destroy')->name('data-entries.destroy');
    Route::put('data-entries/{slug}/update/{id}', 'Admin\DataEntryController@update')->name('data-entries.update');


    Route::view('file-manager', 'river::admin.filemanager');
    /*Route::get('file-manager', function () {
//      return response()->file(public_path('river/tinyfilemanager.php'));
      require(public_path('river/tinyfilemanager.php'));
    });*/

});
