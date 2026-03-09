<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Followモデルをインポート
use App\Follow;
// Authファサードを読み込む
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //フォローリスト表示
    public function followList(){
        return view('follows.followList');
    }

    // フォロワーリスト表示
    public function followerList(){
        return view('follows.followerList');
    }

    //フォローしているかどうかの状態確認
    public function check_following($id){
        //自分がフォローしているかどうか検索
        $check = Follow::where('following_id', Auth::id() )->where('followed_id', $id);

        if($check->count() == 0):
            //フォローしている場合
            return response()->json(['status' => false]);
        elseif($check->count() != 0):
            //まだフォローしていない場合
            return response()->json(['status' => true]);
        endif;
    }

    //フォローする(中間テーブルをインサート)
    public function following(Request $request){
        //自分がフォローしているかどうか検索
        $check = Follow::where('following_id', Auth::id())->where('followed_id', $request->user_id);

        //検索結果が0(まだフォローしていない)場合のみフォローする
        if($check->count() == 0):
            $follow = new Follow;
            $follow->following_id = Auth::id();
            $follow->followed_id = $request->id;
            $follow->save();
        endif;

        return redirect('/search');
    }

    //フォローを外す
    public function unfollow(Request $request){
        //削除対象のレコードを検索して削除
        $unfollowing = Follow::where('following_id', Auth::id())->where('followed_id', $request->id)->delete();

        return redirect('/search');
    }

    //フォローリストから飛んだユーザーをフォローする(中間テーブルをインサート)
    public function following_follow(Request $request){
        //自分がフォローしているかどうか検索
        $check = Follow::where('following_id', Auth::id())->where('followed_id', $request->user_id);

        //検索結果が0(まだフォローしていない)場合のみフォローする
        if($check->count() == 0):
            $follow = new Follow;
            $follow->following_id = Auth::id();
            $follow->followed_id = $request->id;
            $follow->save();
        endif;

        return redirect()->back();
    }

    //フォローを外す
    public function unfollow_follow(Request $request){
        //削除対象のレコードを検索して削除
        $unfollowing = Follow::where('following_id', Auth::id())->where('followed_id', $request->id)->delete();

        return redirect()->back();
    }
}
