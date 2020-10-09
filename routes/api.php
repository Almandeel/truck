<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function ($router) {

    // global api
    Route::post('customer/units', 'Api\ApiController@units');
    Route::post('customer/vehicles', 'Api\ApiController@vehicles');
    Route::post('customer/zones', 'Api\ApiController@zones');

    // customers api
    Route::post('customer/profile', 'Api\CustomerController@profile');
    Route::post('customer/orders', 'Api\CustomerController@orders');
    Route::post('customer/order', 'Api\CustomerController@order');
    Route::post('customer/details', 'Api\CustomerController@showOrder');
    Route::post('customer/update', 'Api\CustomerController@updateOrder');

    // company api
    Route::post('company/profile', 'Api\CompanyController@profile');
    Route::post('company/orders', 'Api\CompanyController@orderStatus');
    Route::post('company/order', 'Api\CompanyController@showOrder');
    Route::post('company/update', 'Api\CompanyController@updateOrder');
});

Route::group([
    'middleware' => 'api',
], function ($router) {

    //  Customer Log
    Route::post('customer/login', 'Api\AuthController@login');
    Route::post('customer/logout', 'Api\AuthController@logout');
    Route::post('customer/register', 'Api\AuthController@register');
    Route::post('customer/refresh', 'Api\AuthController@refresh');

    // Company log
    Route::post('company/login', 'Api\AuthController@login');
    Route::post('company/logout', 'Api\AuthController@logout');
    Route::post('company/register', 'Api\AuthController@register');
    Route::post('company/refresh', 'Api\AuthController@refresh');
});
