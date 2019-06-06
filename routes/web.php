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
use App\User;

Route::get('user/test', function () {
   $user = new User();
   return $user->getDatabase()->getValue();
});

Route::get('/', 'HomeController@index')->name('homepage');
Route::get('search', 'HomeController@search')->name('search');
Route::post('search', 'HomeController@postSearch')->name('search');
Route::get('category/{slug}', 'HomeController@category')->name('category');
Route::get('detail/{id}', 'HomeController@getDetailBook')->name('detail');
Route::get('cart', 'CartController@cart')->name('cart');
Route::post('add-to-cart/{id}', 'CartController@postAdd')->name('addtocart');
Route::patch('update-cart', 'CartController@update');
Route::delete('remove-from-cart', 'CartController@remove');
Route::get('add-like/{id}', 'LikeController@addLike')->name('addlike');
Route::get('list-like/{key}', 'LikeController@getListLike')->name('listlike');
Route::get('comment', 'CommentController@comment')->name('comment');
Route::post('comment/{id}', 'CommentController@postComment')->name('comment');
Route::get('delete-comment/{key}', 'CommentController@deleteComment')->name('deletecomment');
Route::post('edit-comment/{id}', 'CommentController@editComment')->name('editcomment');
Route::post('reply/{id}', 'CommentController@reply')->name('reply');
Route::get('rate', 'CommentController@rate')->name('rate');
Route::post('rate', 'CommentController@postRate')->name('rate');
Route::get('order', 'OrderController@order')->name('order');
Route::post('order', 'OrderController@postOrder')->name('postOrder');
Route::get('check-quantity', 'OrderController@checkQuantity');
Route::get('destroy', 'CartController@destroy');
Route::get('delete-item-cart', 'CartController@deleteItemCart');
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
    Route::get('category', 'BookController@listCategory');
    Route::get('merge', 'BookController@merge');
    Route::get('unique', 'BookController@unique_array');
    Route::get('test', 'BookController@test');
});
Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', 'DashboardController@dashboard')->name('admin.dashboard');
    Route::group(['prefix' => 'user'], function () {
        Route::get('list', 'UserController@getList')->name('user.list');
        Route::get('add', 'UserController@getAdd')->name('user.add');
        Route::post('add', 'UserController@postAdd')->name('user.postAdd');
        Route::get('edit/{key}', 'UserController@getEdit')->name('user.edit');
        Route::post('edit/{key}', 'UserController@postEdit')->name('user.postEdit');
        Route::get('delete/{key}', 'UserController@delete')->name('user.delete');
    });
    Route::group(['prefix' => 'book'], function () {
        Route::get('list', 'BookController@getList')->name('book.list');
        Route::get('add', 'BookController@getAdd')->name('book.add');
        Route::post('add', 'BookController@postAdd')->name('book.postAdd');
        Route::get('edit/{id}', 'BookController@getEdit')->name('book.edit');
        Route::post('edit/{id}/{key}', 'BookController@postEdit')->name('book.postEdit');
        Route::get('delete/{key}', 'BookController@delete')->name('book.delete');
    });
    Route::group(['prefix' => 'order'], function () {
        Route::get('list', 'OrderController@getList')->name('order.list');
        Route::get('delete/{key}', 'OrderController@delete')->name('order.delete');
    });
});
Route::get('admin', 'HomeController@admin')->name('admin');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::get('login', 'Auth\LoginController@getLogin')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@getLogout')->name('logout');
Route::get('password/reset', 'Auth\ResetPasswordController@reset')->name('password.request');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

