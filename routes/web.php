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

Route::get('/', [
    'as' => 'homepage',
    'uses' => 'HomeController@index'
]);
Route::get('detail-book/{id}', 'HomeController@getDetailBook')->name('detail');
Route::get('cart/{id}', 'CartController@addToCart')->name('cart');
Route::get('remove-from-cart', 'CartController@removeFromCart');
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
