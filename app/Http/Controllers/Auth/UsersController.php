<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //プロフィール画面表示
    public function profile(){
        return view('users.profile');
    }

    // ユーザー検索ページ表示
    public function search(Request $request)
    {
        // 検索するテキスト取得
        $search = $request->input('s');
        $query = User::query();

        // 検索するテキストが入力されている場合のみ検索
        if(!empty($search)) {
            $query->where('username', 'like', '%'.$search.'%');
        }

        // 結果を取得して
        $data = $query->get();

        // ビューファイルに渡す
        return view('users.search', compact('data', 'search'));
    }

    //プロフィール閲覧で使用するユーザー情報の取得
    public function get_user($user_id){

        $user = User::with('following')->with('followed')->findOrFail($user_id);
        return response()->json($user);
    }

    // ユーザーのプロフィール画像アップロード処理
    public function update_image(Request $request)
    {
    // ⭐バリデーションは後で
    // $request->validate([
    //     'user_image' => ['required', 'image', 'max:2048'], // 例
    // ]);

    $user = Auth::user();
    $originalImg = $request->file('user_image');

    if ($originalImg && $originalImg->isValid()) {
        // storage/app/public/images に保存
        $filePath = $originalImg->store('images', 'public');

        // DB にはファイル名（またはパス）だけ保存
        $user->images = $filePath; // 例: "images/xxxxxx.png"
        $user->save();
    }

    return redirect()->back();
    }

}
