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
    public function profile()
    {
        $user = Auth::user();
        return view('Users.profile',compact('user'));
    }


    // ユーザー検索ページ表示
    public function search(Request $request)
    {
        // 検索するテキスト取得
        $search = $request->input('s');
        $query = User::query();

        // 検索するテキストが入力されている場合のみ検索
        if(!empty($search))
        {
            $query->where('username', 'like', '%'.$search.'%');
        }

        // ログインユーザーは除外
        $query -> where('id','!=',Auth::user()->id);

        // 結果を取得して
        $data = $query->get();

        // ビューファイルに渡す
        return view('Users.search', compact('data', 'search'));
    }

    //プロフィール閲覧で使用するユーザー情報の取得
    public function getUser($user_id)
    {
        $user = User::with('following')->with('followed')->findOrFail($user_id);

        return response()->json($user);
    }

    // プロフィール更新処理
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate(
            [
                'username' => 'required|between:2,12',
                'mail' => 'required|between:5,40|unique:users,mail,' . $user->id . '|email',
                'password' => 'required|alpha_num|between:8,20|confirmed',
                'bio' => 'nullable|max:150',
                'images' => 'nullable|image'
                ],
            [
                'username.required' => '・ユーザー名は入力必須です。',
                'username.between' => '・ユーザー名は2文字以上12文字以内で入力してください。',

                'mail.required' => '・メールアドレスは入力必須です。',
                'mail.between' => '・メールアドレスは5文字以上40文字以内で入力してください。',
                'mail.unique' => '・このメールアドレスは既に登録されています。',
                'mail.email' => '・メールアドレスの形式が正しくありません。',

                'password.required' => '・パスワードは入力必須です。',
                'password.alpha_num' => '・パスワードは英数字のみ使用できます。',
                'password.between' => '・パスワードは8文字以上20文字以内で入力してください。',
                'password.confirmed' => '・パスワード確認が一致していません。',

                'bio.max' => '・自己紹介は150文字以内で入力してください。',

                'images.image' => '・アイコン画像には画像ファイルをアップロードしてください。',

            ]);

        // 名前、アドレス、自己紹介
        $user->username = $validated['username'];
        $user->mail = $validated['mail'];
        $user->bio = $validated['bio'] ?? $user->bio;

        // パスワード確認
        if (!empty($validated['password']))
            {
            $user->password = Hash::make($validated['password']);
            }

        // プロフィール画像
        // ファイル名を images/ランダム文字列.png にしないように設定
        if ($request->hasFile('images'))
            {
            $filename = $request->file('images')->getClientOriginalName();
            $path = $request->file('images')->storeAs('images', $filename, 'public');
            $user->images = 'images/' . $filename;
            }

        $user->save();

        return redirect('/top');
    }
}
