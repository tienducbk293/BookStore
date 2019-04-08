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

Route::get('home', [
    'as' => 'homepage',
    'uses' => 'HomeController@index'
]);
Route::get('detail-book/{bookId}', [  //Missing required parameters for [Route: detail] [URI: detail-book/{bookId}].
    'as' => 'detail',
    'uses' => 'HomeController@getDetailBook'
]);
Route::get('cart/{bookId}', [
    'as' => 'cart',
    'uses' => 'HomeControlller@getAddToCart'
]);
Route::get('register', [
    'as' => 'register',
    'uses' => 'HomeController@getRegister'
]);
Route::post('register', [
    'as' => 'register',
    'uses' => 'HomeController@postRegister'
]);
Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@getLogin'
]);
Route::post('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@postLogin'
]);
Route::get('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@getLogout'
]);
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
