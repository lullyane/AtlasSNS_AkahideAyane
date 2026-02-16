<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    // ログアウト
    function logout() {
    removeItem('token'); // ローカルストレージからトークンを削除
    return redirect('/login'); // ログインページにリダイレクト
}

    // フォロワー、フォローユーザー
    public function show($id)
    {
    $user = User::withCount(['followings', 'followers'])
                ->findOrFail($id);

    return view('users.show', compact('user'));
    }
}
