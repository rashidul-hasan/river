<?php
use Rashidul\River\Http\Controllers\Admin\FileUploadController;
use Rashidul\River\Http\Controllers\Admin\MenuController;
use Rashidul\River\Http\Controllers\Admin\BlogController;
   
use Rashidul\River\Http\Controllers\Admin\TemplatePageController;
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


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'river.auth:admins', 'river.checkrole']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['web', 'river.auth:admins', 'river.checkrole'],
    'namespace' => 'Rashidul\River\Http\Controllers',
    'as' => 'river.'
], function () {

    //users crudF
    Route::resource('users', 'Admin\UsersController');

    Route::resource('users-role', 'Admin\UsersRoleController');
    Route::resource('pages', 'Admin\RiverPagesController');

    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

    //    Route::get('payment-method', 'Admin\PaymentController@index')->name('payment.index');

    //settings route:
    //    Route::get('settings', 'Admin\SettingsController@showSettings')->name('settings.index');
    Route::get('storefront', 'Admin\Settings\AppearanceController@storeFront')->name('store.front');
    Route::get('store-social-links', 'Admin\Settings\AppearanceController@storeSocialLinks')->name('store-social-links');

    Route::get('store-email-setting', 'Admin\Settings\AppearanceController@storeEmailSettings')->name('store-email-setting');

    Route::post('update/settings', 'Admin\Settings\SettingsController@updateSettings')->name('store-settings');
    Route::resource('sliders', 'Admin\Settings\SliderController');

    Route::resource('banners', 'Admin\Settings\BannersController');

    Route::get('site-backup', 'Admin\Settings\SiteBackupController@index')->name('site-backup');
    Route::get('site-backup-store', 'Admin\Settings\SiteBackupController@backup_store')->name('site-backup-store');



    //Newsletter Submissions
    Route::resource('newslatter-submissions', 'Admin\NewsletterSubmissionsController');

    //template manager
    Route::resource('template-pages', 'Admin\TemplatePageController')->except(['create', 'show']);
    Route::get('assets', 'Admin\TemplatePageController@assets')->name('templates.assets');
    Route::get('CacheView', 'Admin\TemplatePageController@CacheView')->name('CacheView');

    //template Assets
    Route::resource('template-assets', 'Admin\TemplateAssetsController')->except(['show']);
    Route::get('assets-CacheView', 'Admin\TemplateAssetsController@CacheView')->name('assets-cache-view');



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


    Route::get('file', 'Admin\CodeGeneratorController@index');


    Route::view('file-manager', 'river::admin.filemanager');
    /*Route::get('file-manager', function () {
//      return response()->file(public_path('river/tinyfilemanager.php'));
      require(public_path('river/tinyfilemanager.php'));
    });*/

    // Route::get('contact-form', 'Admin\ContactFormController@index')->name('contact_form');
    // Route::post('contact-form/store', 'Admin\ContactFormController@store')->name('contact-form.store');
    // Route::delete('contact-form/destroy/{id}', 'Admin\ContactFormController@destroy')->name('contact-form.destroy');
    // Route::get('contact-form/update/{id}', 'Admin\ContactFormController@update')->name('contact-form.update');
    // Route::put('contact-form/update-store/{id}', 'Admin\ContactFormController@update_store')->name('contact-form.update-store');

    // Route::get('contact-form-field', 'Admin\ContactFormFieldController@index')->name('Contact-Form-Field');
    // Route::post('contact-form-field/store', 'Admin\ContactFormFieldController@store')->name('Contact-Form-Field.store');

    Route::resource('contact-form', 'Admin\ContactFormController');
    Route::post('contact-form/store-fields', 'Admin\ContactFormController@storeFields')->name('contact-form.store-fields');
    Route::put('contact-form/update-fields', 'Admin\ContactFormController@updateFields')->name('contact-form.update-fields');
    Route::post('contact-form/field-meta', 'Admin\ContactFormController@fieldMeta')->name('contact-form.field-meta');

    Route::resource('faq', 'Admin\FaqController');

    Route::post('uploads', [FileUploadController::class,'file_upload'])->name('file-upload');


    //Menu
    Route::resource('menu', 'Admin\MenuController');
    Route::post('menu-field/{id}', [MenuController::class, 'menu_item_create'])->name('menu-field');
    Route::post('menu-store-field', [MenuController::class, 'storeFields'])->name('store-fields');
    Route::put('menu-update-field', [MenuController::class, 'updateFields'])->name('menu_update-fields');

    //Blog
    Route::resource('blog', 'Admin\BlogController');
    //BlogCategory
    Route::resource('blog-category', 'Admin\BlogCategoryController');
    Route::resource('tag', 'Admin\TagController');

    Route::resource('testimonial', 'Admin\TestimonialController');

    //service
    Route::resource('service', 'Admin\ServiceController');
    Route::resource('service-category', 'Admin\ServiceCategoryController');
});


