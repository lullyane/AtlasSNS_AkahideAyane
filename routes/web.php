<?php

use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PostsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UsersController;

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
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top','Auth\PostsController@index');

Route::get('/profile','Auth\UsersController@profile');

Route::get('/search','Auth\UsersController@index');

Route::get('/follow-list','Auth\PostsController@index');
Route::get('/follower-list','Auth\PostsController@index');

Route::get('/logout', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@login');
