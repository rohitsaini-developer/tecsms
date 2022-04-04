<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call(' optimize:clear');
    return "Cache is cleared";
});

Route::redirect('/', 'login');

/**
 * auth data
 */
Route::group(['middleware' => ['preventBackHistory']],function(){
    Auth::routes();

    // facebook login
    Route::get('auth/facebook', 'Auth\SocialController@facebookRedirect')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'Auth\SocialController@loginWithFacebook')->name('auth.facebook.callback');

    // google login
    Route::get('auth/google', 'Auth\SocialController@redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'Auth\SocialController@handleGoogleCallback')->name('auth.google.callback');
    // social login with password
    Route::post('auth/social-register', 'Auth\SocialController@socialLoginUserStore')->name('auth.social-register');

    // verify user phone number and email
    Route::get('verify-user', function(){
        return view('auth.verify');
    })->name('auth.verify.user'); 

    // verify
    Route::get('account/verify/email/{user_id}/{token}', 'Auth\AuthController@verifyEmailAccount')->name('user.verify.email'); 
    Route::get('account/verify/phone/{user_id}/{token}', 'Auth\AuthController@verifyPhoneAccount')->name('user.verify.phone'); 

    // resend verify
    Route::post('resend-verify-email', 'Auth\AuthController@resendEmailVarification')->name('verification.resend.email'); 
    Route::post('resend-verify-phone', 'Auth\AuthController@resendPhoneNumberVarification')->name('verification.resend.phone');

    // admin login
    Route::get('/admin/login', 'Auth\LoginController@adminCreate')->name('admin.login');
});

/**
 * admin data
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['preventBackHistory']], function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');

    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');

    Route::get('/user/change-password/{id}', 'UserController@changePasswordByAdmin')->name('users.changePasswordByAdmin');
    Route::post('/user/update-password/{id}', 'UserController@updatePasswordByAdmin')->name('users.updatePasswordByAdmin');

    // Settings
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('change', 'SettingsController@change')->name('change');
        Route::post('update-change', 'SettingsController@updateChange')->name('updateChange');
        Route::get('delete-value/{setting}', 'SettingsController@deleteValue')->name('deleteValue');
    });
});

// change password by current user
Route::get('/change-password', 'Admin\UserController@changePassword')->name('users.changePassword')->middleware('auth');
Route::post('/updatepassword', 'Admin\UserController@updatePassword')->name('update-password');

/**
 * user data
 */
Route::group(['as' => 'user.', 'namespace' => 'Front', 'middleware' => ['auth', 'verfy_user', 'preventBackHistory']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});