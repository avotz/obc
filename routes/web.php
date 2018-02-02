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

Route::get('/support', 'HomeController@support');
Route::post('/support', 'HomeController@sendSupport');

Route::get('companies/{privateCode}/check', 'PartnerController@checkPrivateCode');

Route::get('profile', 'ProfileController@show');
Route::post('profile/avatars', 'ProfileController@avatar');
Route::delete('profile/avatars/{id}', 'ProfileController@deleteAvatar');

Route::get('suppliers', 'QuotationRequestController@suppliers');
Route::get('public/requests', 'QuotationRequestController@public');
Route::get('private/requests', 'QuotationRequestController@private');

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
Route::delete('/requests/file/{id}', 'QuotationRequestController@deleteFile');

Route::delete('/quotations/file/{id}', 'QuotationController@deleteFile');
Route::put('purchases/{purchase}/status', 'PurchaseController@update_status');

Route::get('quotations/{quotation}/shippings', 'ShippingController@index');
Route::get('quotations/{quotation}/shippings/list', 'ShippingController@getShippings');
Route::get('quotations/{quotation}/shipping-requests/list', 'ShippingRequestController@getShippingsRequests');
Route::get('quotations/{quotation}/shipping-requests/create', 'ShippingRequestController@create');
Route::post('quotations/{quotation}/shipping-requests', 'ShippingRequestController@store');

Route::get('quotations/{quotation}/credits', 'CreditController@index');
Route::get('quotations/{quotation}/credits/list', 'CreditController@getCredits');
Route::get('quotations/{quotation}/credit-requests/list', 'CreditRequestController@getCreditRequests');
Route::get('quotations/{quotation}/credit-requests/create', 'CreditRequestController@create');
Route::post('quotations/{quotation}/credit-requests', 'CreditRequestController@store');

Route::get('shippings/companies', 'ShippingController@suppliers');

Route::get('shipping-requests/{shipping}/edit', 'ShippingRequestController@edit');
Route::put('shipping-requests/{shipping}/status', 'ShippingRequestController@update_status');
Route::delete('shipping-requests/{shipping}', 'ShippingRequestController@destroy');
Route::delete('shipping-requests/file/{id}', 'ShippingRequestController@deleteFile');
Route::get('shipping-requests/{shipping}/shippings', 'ShippingController@shippingsFromRequest');
Route::get('shippings/{shipping}/edit', 'ShippingController@edit');
Route::put('shippings/{shipping}/status', 'ShippingController@update_status');

Route::get('credit-requests/{credit}/edit', 'CreditRequestController@edit');
Route::put('credit-requests/{credit}/status', 'CreditRequestController@update_status');
Route::delete('credit-requests/{credit}', 'CreditRequestController@destroy');
Route::delete('credit-requests/file/{id}', 'CreditRequestController@deleteFile');
Route::get('credit-requests/{credit}/credits', 'CreditController@CreditsFromRequest');
Route::get('credits/{credit}/edit', 'CreditController@edit');
Route::put('credits/{credit}/status', 'CreditController@update_status');

Route::get('commissions/pending', 'CommissionController@pending');
Route::get('commissions/intransit', 'CommissionController@intransit');
Route::get('commissions/paid', 'CommissionController@paid');
Route::put('commissions/{commission}/status', 'CommissionController@update_status');

Route::resource('requests', 'QuotationRequestController');
Route::resource('quotations', 'QuotationController');
Route::resource('purchases', 'PurchaseController');
Route::resource('shippings', 'ShippingController');
Route::resource('shipping-requests', 'ShippingRequestController');
Route::resource('credits', 'CreditController');
Route::resource('credit-requests', 'CreditRequestController');

Route::prefix('superadmin')->middleware('authByRole:superadmin')->group(function () {
    Route::put('/settings', 'Superadmin\UserController@updateSettings');
    Route::put('/{admin}', 'Superadmin\AccountController@update');

    Route::get('/users', 'Superadmin\UserController@index');
    Route::get('/users/create', 'Superadmin\UserController@create');
    Route::post('/users', 'Superadmin\UserController@store');
    Route::delete('/users/{user}', 'Superadmin\UserController@delete');
    Route::put('/users/{user}', 'Superadmin\UserController@update');
    Route::get('/users/{user}/edit', 'Superadmin\UserController@edit');
    Route::put('/users/{user}/country', 'Superadmin\UserController@updateCountry');
    Route::put('/users/{user}/permissions', 'Superadmin\UserController@updatePermissions');

    foreach (['active', 'inactive', 'trial', 'notrial'] as $key) {
        Route::post('/users/{user}/' . $key, [
            'as' => 'superadmin.users.' . $key,
            'uses' => 'Superadmin\UserController@' . $key,
        ]);
    }

    Route::get('/countries', 'Superadmin\CountryController@index');
    Route::get('/countries/create', 'Superadmin\CountryController@create');
    Route::post('/countries', 'Superadmin\CountryController@store');
    Route::delete('/countries/{country}', 'Superadmin\CountryController@delete');
    Route::get('/countries/{country}/edit', 'Superadmin\CountryController@edit');
    Route::put('/countries/{country}', 'Superadmin\CountryController@update');

    Route::get('transactions', 'Superadmin\TransactionController@index');
    Route::get('quotation-requests/list', 'Superadmin\TransactionController@getQuotationRequests');
    Route::get('quotations/list', 'Superadmin\TransactionController@getQuotations');
    Route::get('shipping-requests/list', 'Superadmin\TransactionController@getShippingsRequests');
    Route::get('shippings/list', 'Superadmin\TransactionController@getShippings');
    Route::get('credit-requests/list', 'Superadmin\TransactionController@getCreditRequests');
    Route::get('credits/list', 'Superadmin\TransactionController@getCredits');
    Route::get('purchase-orders/list', 'Superadmin\TransactionController@getPurchaseOrders');
});

Route::prefix('admin')->middleware('authByRole:admin')->group(function () {
    Route::put('/{admin}', 'Admin\AccountController@update');
    Route::get('/users', 'Admin\UserController@index');
    Route::get('/users/create', 'Admin\UserController@create');
    Route::post('/users', 'Admin\UserController@store');
    Route::delete('/users/{user}', 'Admin\UserController@delete');
    Route::put('/users/{user}', 'Admin\UserController@update');
    Route::get('/users/{user}/edit', 'Admin\UserController@edit');
    Route::put('/companies/{company}', 'Admin\UserController@updateCompany');
    Route::put('/users/{user}/permissions', 'Admin\UserController@updatePermissions');

    Route::get('transactions', 'Admin\TransactionController@index');
    Route::get('quotation-requests/list', 'Admin\TransactionController@getQuotationRequests');
    Route::get('quotations/list', 'Admin\TransactionController@getQuotations');
    Route::get('shipping-requests/list', 'Admin\TransactionController@getShippingsRequests');
    Route::get('shippings/list', 'Admin\TransactionController@getShippings');
    Route::get('credit-requests/list', 'Admin\TransactionController@getCreditRequests');
    Route::get('credits/list', 'Admin\TransactionController@getCredits');
    Route::get('purchase-orders/list', 'Admin\TransactionController@getPurchaseOrders');

    foreach (['active', 'inactive', 'trial', 'notrial'] as $key) {
        Route::post('/users/{user}/' . $key, [
            'as' => 'admin.users.' . $key,
            'uses' => 'Admin\UserController@' . $key,
        ]);
    }
});

Route::prefix('partner')->middleware('authByRole:partner')->group(function () {
    Route::post('/company/logo', 'Partner\AccountController@logoCompany');
    Route::put('/companies/{company}', 'Partner\AccountController@updateCompany');
    Route::put('/companies/{company}/privatecode', 'Partner\AccountController@updatePrivateCode');
    Route::put('/{partner}', 'Partner\AccountController@update');

    Route::get('/users', 'Partner\UserController@index');
    Route::delete('/users/{user}', 'Partner\UserController@delete');
    Route::get('/users/{user}/edit', 'Partner\UserController@edit');
    Route::put('/users/{user}', 'Partner\UserController@updatePermissions');
    Route::get('/users/{user}/requests', 'Partner\UserController@quotationRequests');
    Route::get('/users/{user}/quotations', 'Partner\UserController@quotations');

    foreach (['active', 'inactive', 'trial', 'notrial'] as $key) {
        Route::post('/users/{user}/' . $key, [
            'as' => 'users.' . $key,
            'uses' => 'Partner\UserController@' . $key,
        ]);
    }

    //Route::get('shipping-requests/list', 'Partner\ShippingRequestController@getShippingsRequests');
    //Route::get('shippings/list', 'Partner\ShippingController@getShippings');

    Route::get('/quotations', 'Partner\QuotationController@index');
    Route::get('/requests', 'Partner\QuotationRequestController@index');

    Route::get('transactions', 'Partner\TransactionController@index');
    Route::get('quotation-requests/list', 'Partner\TransactionController@getQuotationRequests');
    Route::get('quotations/list', 'Partner\TransactionController@getQuotations');
    Route::get('shipping-requests/list', 'Partner\TransactionController@getShippingsRequests');
    Route::get('shippings/list', 'Partner\TransactionController@getShippings');
    Route::get('credit-requests/list', 'Partner\TransactionController@getCreditRequests');
    Route::get('credits/list', 'Partner\TransactionController@getCredits');
    Route::get('purchase-orders/list', 'Partner\TransactionController@getPurchaseOrders');
});
Route::prefix('shipping')->middleware('authByRole:shipping')->group(function () {
    Route::get('shipping-requests', 'Shipping\ShippingRequestController@index');
    Route::get('shippings/list', 'Shipping\ShippingController@getShippings');
    Route::get('shipping-requests/list', 'Shipping\ShippingRequestController@getShippingsRequests');
    Route::get('shipping-requests/{shipping}/edit', 'Shipping\ShippingRequestController@show');
    Route::put('shipping-requests/{shipping}/status', 'Shipping\ShippingRequestController@update_status');
    Route::get('shipping-requests/{shipping}/shippings/create', 'Shipping\ShippingController@create');
    Route::post('shipping-requests/{shipping}/shippings', 'Shipping\ShippingController@store');
    Route::get('shippings/{shipping}/edit', 'Shipping\ShippingController@edit');
    Route::put('shippings/{shipping}/status', 'Shipping\ShippingController@update_status');

    Route::resource('shippings', 'Shipping\ShippingController');
});
Route::prefix('credit')->middleware('authByRole:credit')->group(function () {
    Route::get('credit-requests', 'Credit\CreditRequestController@index');
    Route::get('credits/list', 'Credit\CreditController@getCredits');
    Route::get('credit-requests/list', 'Credit\CreditRequestController@getCreditRequests');
    Route::get('credit-requests/{credit}/edit', 'Credit\CreditRequestController@show');
    Route::put('credit-requests/{credit}/status', 'Credit\CreditRequestController@update_status');
    Route::get('credit-requests/{credit}/credits/create', 'Credit\CreditController@create');
    Route::post('credit-requests/{credit}/credits', 'Credit\CreditController@store');
    Route::get('credits/{credit}/edit', 'Credit\CreditController@edit');
    Route::put('credits/{credit}/status', 'Credit\CreditController@update_status');
    Route::put('companies/{company}/interest', 'Credit\CreditController@update_interest');

    Route::resource('credits', 'Credit\CreditController');
});
Route::prefix('user')->middleware('authByRole:user')->group(function () {
    Route::put('/{user}', 'User\AccountController@update');
    Route::get('/quotations', 'User\QuotationController@index');
    Route::get('/requests', 'User\QuotationRequestController@index');

    Route::get('transactions', 'User\TransactionController@index');
    Route::get('quotation-requests/list', 'User\TransactionController@getQuotationRequests');
    Route::get('quotations/list', 'User\TransactionController@getQuotations');
    Route::get('shipping-requests/list', 'User\TransactionController@getShippingsRequests');
    Route::get('shippings/list', 'User\TransactionController@getShippings');
    Route::get('credit-requests/list', 'User\TransactionController@getCreditRequests');
    Route::get('credits/list', 'User\TransactionController@getCredits');
    Route::get('purchase-orders/list', 'User\TransactionController@getPurchaseOrders');

    //Route::get('shipping-requests/list', 'User\ShippingRequestController@getShippingsRequests');
    //Route::get('shippings/list', 'User\ShippingController@getShippings');
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
