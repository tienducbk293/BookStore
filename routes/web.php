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

Route::get('/', 'HomeController@index')->name('homepage');
Route::get('detail/{id}', 'HomeController@getDetailBook')->name('detail');
Route::get('cart', 'CartController@cart')->name('cart');
Route::post('add-to-cart/{id}', 'CartController@postAdd')->name('addtocart');
Route::patch('update-cart', 'CartController@update');
Route::delete('remove-from-cart', 'CartController@remove');
Route::get('add-like/{id}', 'BookController@addLike')->name('addlike');
Route::get('checkout', 'CheckoutController@checkout')->name('checkout');
Route::post('checkout', 'CheckoutController@postCheckout')->name('checkout');
Route::get('check-quantity', 'CheckoutController@checkQuantity');
Route::get('destroy', 'CartController@destroy');
Route::get('delete-item-cart', 'CartController@deleteItemCart');
Route::get('register', 'Auth\RegisterController@getRegister')->name('register');
Route::post('register', 'Auth\RegisterController@postRegister')->name('register');
Route::get('login', 'Auth\LoginController@getLogin')->name('login');
Route::post('login', 'Auth\LoginController@postLogin')->name('login');
Route::get('logout', 'Auth\LoginController@getLogout')->name('logout');
Route::get('custom_token', 'HomeController@createCustomToken');
Route::get('verify', 'HomeController@verifyIdToken');
Route::get('list', 'HomeController@listUser');
Route::get('test', 'HomeController@test');
// Book Page
Route::prefix('book')->group(function () {
    Route::get('index', 'BookController@index');
    Route::get('firebase', 'BookController@saveFirebase');
    Route::get('crawl', 'BookController@crawl_list');
    Route::get('detail', 'BookController@crawl_detail');

});
