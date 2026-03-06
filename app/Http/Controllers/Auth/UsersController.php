<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //プロフィール画面表示
    public function profile(){
        $user = Auth::user();
        return view('users.profile',compact('user'));
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

    // ユーザーのプロフィール情報アップロード処理
    public function update(Request $request)
    {
    $user = Auth::user();

    $validated = $request->validate([
        'username' => 'required|between:2,12',
        'mail' => 'required|between:5,40|unique:users,mail,' . $user->id . '|email',
        // パスワード確認は自動で参照される
        'password' => 'required|nullable|alpha_num|between:8,20|confirmed',
        'bio' => 'nullable|max:150',
        'images' => 'nullable|image'
    ]);

    // 名前、アドレス、自己紹介
    $user->username = $validated['username'];
    $user->mail = $validated['mail'];
    $user->bio = $validated['bio'] ?? $user->bio;

    // パスワード確認
    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    // プロフィール画像
    // ファイル名を images/ランダム文字列.png にしないように設定
    if ($request->hasFile('images')) {
        $filename = $request->file('images')->getClientOriginalName();
        $path = $request->file('images')->storeAs('images', $filename, 'public');
        $user->images = 'images/' . $filename;
    }

    $user->save();

    return redirect('/profile');
    }
}
