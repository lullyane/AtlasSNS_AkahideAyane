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
// Route::get('/login', 'Auth\LoginController@login');
// Route::post('/login', 'Auth\LoginController@login');

// Route::get('/register', 'Auth\RegisterController@register');
// Route::post('/register', 'Auth\RegisterController@register');

// Route::get('/added', 'Auth\RegisterController@added');
// Route::post('/added', 'Auth\RegisterController@added');

// register ビューファイルで新規登録したユーザー名を added ファイルに渡す
Route::post('Auth/register', [RegisterController::class, 'register']);
Route::get('/added', function () {
    return view('auth.added');
})->name('added');
// URL が /register で、HTTP メソッドが POST のときは、
// RegisterController の registerメソッド を実行してね
// （registerメソッドに色々設定してるけど、そのうち、username を session に保存してくれるのも含まれてる）
// URL が /added で、HTTP メソッドが GET のときは、
// auth.added のビューファイルを表示してね。
// ⭐method指定しなければ自動で GET になること忘れず
// ⭐加えて、Form ファサード (Form::open()) は method="POST" を自動で生成する


// ログインしたときそのユーザーのセッション情報を読み込む
// = ユーザーがログインしているか（認証済みか）をチェックするミドルウェア
Route::get('/top', 'Auth\PostsController@index')->middleware('auth');

//ログイン中のページ
Route::get('/profile','Auth\UsersController@profile');

Route::get('/search','Auth\UsersController@index');

Route::get('/follow-list','Auth\PostsController@index');
Route::get('/follower-list','Auth\PostsController@index');

// Route::get('/logout', 'Auth\LoginController@login');
// Route::post('/logout', 'Auth\LoginController@login');
