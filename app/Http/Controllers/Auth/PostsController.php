<?php

namespace App\Http\Controllers\Auth;

use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //投稿フォームを表示
    public function index()
    {
        $posts = Post::orderBy('id','desc')->get();
        return view('posts.index' , compact('posts'));
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
}
