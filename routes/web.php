<?php

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


//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/','SearchController@index')->name('home');

//ルートに対してレート制限（APIコール制限対策）
Route::middleware('throttle:60,1')->group(function () {
  Route::get('search','SearchController@show');
});
Route::get('check','SearchController@check');


Route::group(['middleware' => ['verified']], function () {
  //ログイン必要
  Route::get('mypage', 'RegisterController@showMyPage')->name('mypage');
  Route::post('store/watch','RegisterController@store');
  Route::delete('delete/{id}', 'RegisterController@destroy')->where('id', '[0-9]+');
});

// Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm');
// Route::post('auth/register', 'Auth\RegisterController@register');

Auth::routes(['verify' => true]);

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('complete','Auth\VerificationController@complete')->name('complete');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//問い合わせ
Route::get('/contact', 'ContactController@index')->name('contact.index');
Route::post('/contact/confirm', 'ContactController@confirm')->name('contact.confirm');
Route::post('/contact/thanks', 'ContactController@send')->name('contact.send');

//静的ページ用
//Route::view('/w', 'welcome');
// Route::get('/home', 'HomeController@index');