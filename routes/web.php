<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'ProductsController@index');
Route::get('currencyWidget', 'Widgets\CurrencyWidgetController@getCurrency');
Route::get('searchingWidget', 'Widgets\SearchWidgetController@getListSearching');


Route::get('products/{any}', 'ProductsController@index')->where('any', '.+');
Route::resource('user', 'UserController');
Route::resource('products', 'ProductsController');


Auth::routes();

Route::resource('currency', 'CurrencyController');
Route::resource('category', 'CategoryController');
Route::get('/home', 'HomeController@index')->name('home');
