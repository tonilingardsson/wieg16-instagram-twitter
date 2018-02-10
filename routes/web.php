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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/customers', 'CustomersController@showCustomers');
Route::get('/customers/by-company/{id}', 'CustomersController@showCustomersByCompanyId');
Route::get('/customers/{id}', 'CustomersController@showCustomer');
Route::get('/customers/{id}/address', 'CustomersController@showCustomerAddress');
Route::resource('products', 'ProductController');
Route::resource('groups', 'GroupController');
Route::resource('group-prices', 'GroupPriceController');
