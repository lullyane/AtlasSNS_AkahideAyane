<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
