<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!--IEブラウザ対策-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="ページの内容を表す文章" />
        <title>AtlasSNS / 改修課題</title>
        <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
        <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
        <!-- ボタン -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    </head>
    <body>
        <header>
            <div class="head">
                <!-- Atlasアイコン -->
                <h1>
                    <div>
                        <a href="/top"><img src="{{ asset('images/atlas.png') }}" alt="Atlas"></a>
                    </div>
                </h1>

                <!-- ヘッダー右側 -->
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
                        <ul>
                            <li class="nav_item"><a href="/top">HOME</a></li>
                            <li class="nav_item"><a href="/profile">プロフィール編集</a></li>
                            <li class="nav_item">
                                <form action="{{ route('logout') }}" method="POST" id="logout-form">@csrf</form>
                                <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();">ログアウト</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="img_wrap">
                        @if(Auth::check())
                        <img
                        src="{{ Auth::user()->images
                        ? asset('storage/' . Auth::user()->images)
                        : asset('images/icon1.png') }}"
                        alt="ユーザーアイコン"
                        class="profile_item profile_icon">
                        @endif
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div id="row">
                <section id="container">
                    @yield('content')
                </section>
                <section id="sideBar">
                    <div class="side_top">
                         @auth
                        <div>
                            <!-- 「ログイン中のユーザー名表示」 -->
                            <p>{{ Auth::user()->username }}さんの</p>
                        </div>
                        <div class="follow_count_wrapper">
                            <p class="follow_count">フォロー数</p>
                            <!-- ログイン中のユーザーが Follow テーブルに持ってるfollowingsの件数表示 -->
                            <p>{{ Auth::user()->followings()->count() }}
人</p>
                        </div>
                        <div>
                            <a class="follow_button" href="/follow-list" role="button">フォローリスト</a>
                        </div>
                        <div class="follow_count_wrapper">
                            <p class="follow_count">フォロワー数</p>
                            <!-- ログイン中のユーザーが Follow テーブルに持ってるfollowersの件数表示 -->
                            <p>{{ Auth::user()->followers()->count() }}
人</p>
                        </div>
                        @endauth
                        <div>
                            <a class="follow_button" href="/follower-list" role="button">フォロワーリスト</a>
                        </div>
                    </div>
                    <div class="side_bottom">
                        <a class="follow_button" href="/search" role="button">ユーザー検索</a>
                    </div>
                </section>
            </div>
        </main>
        <footer></footer>
        <script src="{{ asset('/js/app.js') }}"></script>
        <script src="{{ asset('/js/script.js') }}"></script>
    </body>
</html>
