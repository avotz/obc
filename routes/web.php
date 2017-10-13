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
Route::get('suppliers', 'QuotationRequestController@suppliers');
Route::get('private/requests', 'QuotationRequestController@private');
Route::get('public/requests', 'QuotationRequestController@public');
Route::post('questions', 'QuestionController@store');
Route::get('requests/{request}/quotations', 'QuotationController@index');
Route::get('requests/{request}/quotations/create', 'QuotationController@create');
Route::post('requests/{request}/quotations', 'QuotationController@store');
Route::get('quotations/{quotation}/purchases/create', 'PurchaseController@create');
Route::post('quotations/{quotation}/purchases', 'PurchaseController@store');
Route::get('purchases/{purchase}/edit', 'PurchaseController@edit');
Route::delete('/requests/photo/{id}', 'QuotationRequestController@deleteProductPhoto');
Route::delete('/quotations/photo/{id}', 'QuotationController@deleteProductPhoto');
Route::delete('/purchases/file/{id}', 'PurchaseController@deleteFilePurchase');

Route::resource('requests', 'QuotationRequestController');
Route::resource('quotations', 'QuotationController');
Route::resource('purchases', 'PurchaseController');

Route::prefix('superadmin')->middleware('authByRole:superadmin')->group(function ()
{
    
    Route::post('/profile/avatars', 'ProfileController@avatar');
    Route::delete('/profile/avatars/{id}', 'ProfileController@deleteAvatar');
    Route::get('/users', 'SuperAdminController@users');
    Route::get('/users/create', 'SuperAdminController@create');
    Route::post('/users', 'SuperAdminController@storeUser');
    Route::delete('/users/{user}', 'SuperAdminController@deleteUser');
    Route::put('/users/{user}', 'SuperAdminController@updateUser');
    Route::get('/users/{user}/edit', 'SuperAdminController@edit');
    Route::put('/users/{user}/country', 'SuperAdminController@updateCountry');
    Route::put('/{admin}', 'SuperAdminController@update');

    foreach (['active', 'inactive','trial','notrial'] as $key)
    {
        Route::post('/users/{user}/' . $key, array(
            'as'   => 'superadmin.users.' . $key,
            'uses' => 'SuperAdminController@' . $key,
        ));
    }

    Route::get('/countries', 'CountryController@index');
    Route::get('/countries/create', 'CountryController@create');
    Route::post('/countries', 'CountryController@store');
    Route::delete('/countries/{country}', 'CountryController@delete');
    Route::get('/countries/{country}/edit', 'CountryController@edit');
    Route::put('/countries/{country}', 'CountryController@update');

});

Route::prefix('admin')->middleware('authByRole:admin')->group(function ()
{
    
    Route::post('/profile/avatars', 'ProfileController@avatar');
    Route::delete('/profile/avatars/{id}', 'ProfileController@deleteAvatar');
    Route::get('/users', 'AdminController@users');
    Route::get('/users/create', 'AdminController@create');
    Route::post('/users', 'AdminController@storeUser');
    Route::delete('/users/{user}', 'AdminController@deleteUser');
    Route::put('/users/{user}', 'AdminController@updateUser');
    Route::get('/users/{user}/edit', 'AdminController@edit');
    Route::put('/companies/{company}', 'AdminController@updateCompany');
    Route::put('/{admin}', 'AdminController@update');

    foreach (['active', 'inactive','trial','notrial'] as $key)
    {
        Route::post('/users/{user}/' . $key, array(
            'as'   => 'admin.users.' . $key,
            'uses' => 'AdminController@' . $key,
        ));
    }



});

Route::prefix('partner')->middleware('authByRole:partner')->group(function ()
{
    Route::put('/{partner}/privatecode', 'PartnerController@updatePrivateCode');
    Route::post('/profile/avatars', 'ProfileController@avatar');
    Route::delete('/profile/avatars/{id}', 'ProfileController@deleteAvatar');
    Route::post('/company/logo', 'PartnerController@logoCompany');
    Route::put('/companies/{company}', 'PartnerController@updateCompany');
    Route::put('/{partner}', 'PartnerController@update');
    Route::get('/users', 'PartnerController@users');
    Route::delete('/users/{user}', 'PartnerController@deleteUser');
    Route::get('/users/{user}/edit', 'PartnerController@edit');
    Route::put('/users/{user}', 'PartnerController@updatePermissions');

    foreach (['active', 'inactive','trial','notrial'] as $key)
    {
        Route::post('/users/{user}/' . $key, array(
            'as'   => 'users.' . $key,
            'uses' => 'PartnerController@' . $key,
        ));
    }

    Route::get('/quotations', 'PartnerController@quotations');
    Route::get('/requests', 'PartnerController@requests');
    
    
    

});
Route::prefix('user')->middleware('authByRole:user')->group(function ()
{
 
    Route::post('/profile/avatars', 'ProfileController@avatar');
    Route::delete('/profile/avatars/{id}', 'ProfileController@deleteAvatar');
    Route::put('/{user}', 'UserController@update');
    Route::get('/quotations', 'UserController@quotations');
    Route::get('/requests', 'UserController@requests');
   

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
