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

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');
Route::get('partners/{privateCode}/check', 'PartnerController@checkPrivateCode');
Route::get('profile', 'ProfileController@show');

Route::prefix('partner')->middleware('authByRole:partner')->group(function ()
{
    Route::put('/{partner}/privatecode', 'PartnerController@updatePrivateCode');
    Route::post('/profile/avatars', 'ProfileController@avatar');
    Route::put('/companies/{company}', 'PartnerController@updateCompany');

});



//Auth::routes();
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationPage')->name('register');
$this->get('partners/register', 'Auth\RegisterPartnerController@showRegistrationForm')->name('registerPartner');
$this->post('partners/register', 'Auth\RegisterPartnerController@register');
$this->get('users/register', 'Auth\RegisterUserController@showRegistrationForm')->name('registerUser');
$this->post('users/register', 'Auth\RegisterUserController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');
