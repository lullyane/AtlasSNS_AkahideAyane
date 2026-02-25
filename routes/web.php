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

// Route::get('/home', 'HomeController@index')->name('home');

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
Route::get('/top', [PostsController::class, 'index'])->middleware('auth');
Route::post('/top', [PostsController::class, 'form'])->middleware('auth');

//ログイン中のページ
Route::get('/profile', [UsersController::class, 'profile'])->middleware('auth');

Route::get('/search', [UsersController::class, 'search'])->middleware('auth');

Route::get('/follow-list', [HomeController::class, 'followList'])->middleware('auth');

Route::get('/follower-list', [HomeController::class, 'followerList'])->middleware('auth');

Route::get('/post/{id}/delete', [PostsController::class, 'delete'])->middleware('auth');

Route::post('/post/update',[PostsController::class, 'update'])
->middleware('auth')
->name('post.update');

// Route::get('/logout', 'Auth\LoginController@login');
// Route::post('/logout', 'Auth\LoginController@login');
