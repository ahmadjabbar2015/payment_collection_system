<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\App;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function() {return view('pages.upgrade');})->name('upgrade');
	 Route::get('map', function() {return view('pages.maps');})->name('map');
	 Route::get('icons', function() {return view('pages.icons');})->name('icons');
	 Route::get('table-list', function() {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
// saad

	Route::get('customer/index',[CustomerController::class , 'index'])->name('customer.index');
	Route::get('customer/create',[CustomerController::class , 'create'])->name('customer.create');
	Route::post('customer/store',[CustomerController::class , 'store'])->name('customer.store');
	Route::get('customer/show/{id}',[CustomerController::class , 'show'])->name('customer.show');
	Route::get('customer/customer-payments/{id}',[CustomerController::class , 'customerPayments'])->name('customer.customer-payments');
	Route::get('customer/add-customer-payments/{id}',[CustomerController::class , 'addCustomerPayments'])->name('customer.add-customer-payments');
	Route::post('customer/add-customer-payments-store',[CustomerController::class , 'addCustomerPaymentStore'])->name('customer.add-customer-payments-store');
	
	Route::get('products/index',[ProductController::class , 'index'])->name('product.index');
	Route::get('products/create',[ProductController::class , 'create'])->name('product.create');
	Route::post('products/store',[ProductController::class , 'store'])->name('product.store');
	Route::get('sales/create' , [TransactionController::class , 'create'])->name('sales.create');
	Route::post('sales/store' , [TransactionController::class , 'store'])->name('sales.store');
});
