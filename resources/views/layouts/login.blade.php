<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div class="head">
            <h1><a href="/top"><img src="images/atlas.png"></a></h1>
            <div class="head_right">
                @auth
                <p class="profile_item profile_name">{{ Auth::user()->username }}</p> <p class="profile_item profile_name">さん</p>
                @endauth
                <!-- アコーディオンメニュー プルダウン -->
                <div class="menu_trigger">
                    <span></span>
                    <span></span>
                </div>
                <!-- アコーディオンメニュー -->
                <nav class="menu_nav">
                <div class="nav_wrapper">
                    <ul>
                        <li class="nav_item"><a href="/top">HOME</a></li>
                        <li class="nav_item"><a href="/profile">プロフィール編集</a></li>
                        <li class="nav_item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                            <a href="javascript:void(0);"
                            onclick="document.getElementById('logout-form').submit();">
                            ログアウト
                            </a>
                        </li>
                    </ul>
                </div>
                </nav>
                <img class="profile_item profile_icon" src="images/icon1.png">
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                @auth
                <!-- 「ログイン中のユーザー名表示」 -->
                <p class="side_space">{{ Auth::user()->username }}さんの</p>
                @endauth
                <div class="side_follow">
                    <div class="side_block">
                        <p class="side_item side_space">フォロー数</p>
                        @auth
                        <!-- ログイン中のユーザーが Follow テーブルに持ってるfollowingsの件数表示 -->
                        <p class="side_item side_space">{{ Auth::user()->followings()->count() }}
人</p>
                        @endauth
                    </div>
                    <div class="side_space">
                        <p class="follow_button"><a href="/follow-list">フォローリスト</a></p>
                    </div>
                    <div class="side_block">
                        <p class="side_item side_space">フォロワー数</p>
                        @auth
                        <!-- ログイン中のユーザーが Follow テーブルに持ってるfollowersの件数表示 -->
                        <p class="side_item side_space">{{ Auth::user()->followers()->count() }}
人</p>
                        @endauth
                    </div>
                </div>
                <div class="side_space">
                    <p class="follow_button side_space"><a href="/follower-list">フォロワーリスト</a></p>
                </div>
            </div>
            <div class="side_divider">
                <p class="search_button"><a href="/search">ユーザー検索</a></p>
            </div>
        </div>
    </div>
    <footer>
    </footer>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>
