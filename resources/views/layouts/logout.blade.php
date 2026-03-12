<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!--IEブラウザ対策-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="ページの内容を表す文章" />
        <title>AtlasSNS / 改修課題</title>
        <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
        <link rel="stylesheet" href="{{ asset('css/logout.css') }} ">
    </head>
    <body>
        <header class="head">
            <h1>
                <div>
                    <img src="{{ asset('images/atlas.png') }}" alt="Atlas">
                </div>
            </h1>
            <p class="h1_font">Social Network Service</p>
        </header>
        @yield('content')
        <script src="{{ asset('/js/app.js') }}"></script>
        <script src="{{ asset('/js/script.js') }}"></script>
    </body>
</html>
