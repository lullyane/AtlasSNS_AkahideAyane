<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        if($request->isMethod('post')){

            // バリデーションチェック
            $request->validate([
                // 入力必須、2文字以上,12文字以内
                'username' => 'required|between:2,12',
                // 入力必須、5文字以上40文字以内、登録済みメールアドレス使用不可、メールアドレスの形式
                'mail' => 'required|between:5,40|unique:users,mail|email',
                //入力必須、英数字のみ、8文字以上20文字以内
                'password' => 'required|alpha_num|between:8,20',
                // Password入力欄と一致しているか
                'PasswordConfirm' => 'same:password',
            ]);

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),]);

            $registered_username = $request->input('username');

            session(['username' => $registered_username]);

            return redirect()->route('added');

        }
        return view('auth.register');
    }
}
