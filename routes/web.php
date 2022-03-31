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

Route::group(['middleware' => ['preventBackHistory']],function(){
    Auth::routes();
    Route::get('/admin/login', 'Auth\LoginController@adminCreate')->name('admin.login');
});

// verify user and email
    Route::get('verify-user', function(){
        return view('auth.verify');
    })->name('auth.verify.user'); 

    /* Route::get('account/verify/email/{user_id}/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify.email'); 
    Route::get('account/verify/phone/{user_id}/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify.phone');  */

    /* Route::get('account/verify/email/{user_id}/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify.email'); 
    Route::get('account/verify/phone/{user_id}/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify.phone'); */


// facebook login
Route::get('auth/facebook', 'Auth\SocialController@facebookRedirect')->name('auth.facebook');
Route::get('auth/facebook/callback', 'Auth\SocialController@loginWithFacebook')->name('auth.facebook.callback');

// google login
Route::get('auth/google', 'Auth\SocialController@redirectToGoogle')->name('auth.google');
Route::get('auth/google/callback', 'Auth\SocialController@handleGoogleCallback')->name('auth.google.callback');

Route::post('auth/social-register', 'Auth\SocialController@socialLoginUserStore')->name('auth.social-register');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['preventBackHistory']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['as' => 'user.', 'namespace' => 'Front', 'middleware' => ['auth', 'verfy_user', 'preventBackHistory']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});