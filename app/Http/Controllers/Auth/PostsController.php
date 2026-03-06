<?php

namespace App\Http\Controllers\Auth;

use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Followモデルをインポート
use App\Follow;
// Authファサードを読み込む
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //投稿一覧表示（ログインユーザー/フォローしているユーザーのみ）
    public function index(Follow $follow)
    {
    // ログインしているユーザーの情報取得
    $user = auth()->user();

    // 自分がフォローしているユーザーID一覧を取得
    $follow_ids = $follow->followingIds($user->id)
                         ->pluck('followed_id')
                         ->toArray();
    // followモデルのfollowingIds()を呼び出して、フォローしているユーザーのレコード一覧（コレクション）を取得する
    // コレクションの中からfollowed_idの値だけを取り出す
    // コレクションの状態からarrayに変換してwhereInに渡せる形にする

    // 自分自身のIDも含める
    $target_ids = array_merge([$user->id], $follow_ids);

    // 自分＋フォローしているユーザーの投稿だけ取得
    $posts = Post::whereIn('user_id', $target_ids)
                 ->orderBy('id', 'desc')
                 ->get();

    return view('posts.index', compact('posts'));
    }

    // 投稿を保存する
    public function form(Request $request){
        // 入力必須、1文字以上,150文字以内のバリデーション
        $request->validate([
            'post' => 'required|between:1,150',
        ]);

        // Postモデルを使って投稿を保存
        Post::create([
            // user_idにはログイン中のユーザーID
            'user_id' => auth()->id(),
            // postには投稿内容を入れる
            'post' => $request->post,
        ]);

        // 投稿し終わったらトップへ戻る
        return redirect('/top');
    }

    // 投稿削除
    public function delete($id)
    {
        post::where('id', $id)->delete();
        return redirect('/top');
    }

    // 投稿更新
    public function update(Request $request)
    {
    // dd($request->all());

    $post = Post::find($request->id);

    if (!$post) {
        return redirect('/top')->with('error', '投稿が見つかりませんでした');
    }

    $post->post = $request->post;
    $post->save();

    return redirect('/top')->with('success', '更新しました');
    }

    //フォローユーザーの投稿一覧表示
    public function followList(Follow $follow)
    {
    // ログインしているユーザーの情報取得
    $user = auth()->user();

    // 自分がフォローしているユーザーID一覧を取得
    $follow_ids = $follow->followingIds($user->id)
                         ->pluck('followed_id')
                         ->toArray();

    // フォローしているユーザーの投稿だけ取得
    $posts = Post::whereIn('user_id', $follow_ids)
                 ->orderBy('id', 'desc')
                 ->get();

    //フォローユーザー一覧ページ表示
    //$postsの変数をビューに渡す
    return view('follows.followList', compact('posts'));
    }
}

// (Request $request)は登録済みの情報が詰まってる箱から値を取り出すのに必要な引数
// この引数にすることで、例えば$request->input('s'); としたときはsearchビューファイルのtext('s')を持ってこれる。
// また、($request->id)の場合は、今回のリクエストにidがあればという意味になる。
