<?php

use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PostsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\FollowsController;

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

//ログイン中のページ表示
Route::get('/profile', [UsersController::class, 'profile'])->middleware('auth');
// プロフィール情報更新
Route::put('/profile', [UsersController::class, 'update'])->name('profile.update');
// 上記については /profile/{id} より下に持っていったらだめ

// ユーザー検索ページに飛ぶ
Route::get('/search', [UsersController::class, 'search'])->middleware('auth');

// 検索結果表示
Route::get('/search/form',[UsersController::class,'search']);

// フォローユーザーページ表示
Route::get('/follow-list',[PostsController::class, 'followList'])->middleware('auth');

// フォロワーページ表示
Route::get('/follower-list', [PostsController::class,'followerList'])->middleware('auth');

// 投稿削除
Route::get('/post/{id}/delete', [PostsController::class, 'delete'])->middleware('auth');

// 投稿更新
Route::post('/post/update',[PostsController::class, 'update'])
->middleware('auth')
->name('post.update');

//プロフィール閲覧で使用するユーザー情報の取得
Route::get('/profile/{id}',[UsersController::class,'get_user']);

//フォロー状態の確認
Route::get('/follow/status/{id}',[FollowsController::class,'check_following']);
//フォロー付与
Route::post('/users/{id}/follow', [FollowsController::class, 'following'])->name('follow');
//フォロー解除
Route::post('/users/{id}/unfollow', [FollowsController::class, 'unfollow'])->name('unfollow');

//該当ユーザーのプロフィール画面表示
Route::get('/profile/{id}',[PostsController::class, 'others_profile']);
//フォロー付与
Route::post('/profile/{id}/follow', [FollowsController::class, 'following_follow'])->name('following_follow');
//フォロー解除
Route::post('/profile/{id}/unfollow', [FollowsController::class, 'unfollow_follow'])->name('unfollow_follow');
// name＝このルートをビューファイルで呼び出すときの名前
