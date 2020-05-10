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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('users', 'UserController')->middleware('auth');

Route::resource('progresses', 'ProgressController')->middleware('auth');

Route::resource('filters', 'FilterController')->middleware('auth');

Route::resource('transactions', 'TransactionController')->middleware('auth');

Route::get('searches', 'TransactionController@search')->middleware('auth');

Route::get('suppliersearch', 'SupplierController@search')->middleware('auth');

Route::get('usersearch', 'UserController@search')->middleware('auth');

Route::resource('charts', 'ChartController')->middleware('auth');

Route::get('dateFilter', 'TransactionController@index2')->middleware('auth');

Route::resource('suppliers', 'SupplierController')->middleware('auth');

Route::resource('documents', 'DocumentController')->middleware('auth');

Route::resource('products', 'ProductController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


