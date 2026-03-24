@extends('layouts.login')

@section('content')

<div class="post_form follow_top">
    <p>フォロワーリスト</p>
    <div class="follow_img">
        @foreach ($users as $user)
        <!-- アイコン横にスペースが入らないようにaタグとimgタグは間を空けずに置く -->
        <a href="/profile/{{ $user->id }}"><img
            class="form_icon"
            src="{{ $user->profile_image_url }}"
            alt="ユーザーアイコン"></a>
        @endforeach
    </div>
</div>

@foreach ($posts as $post)
<div class="list">
    <div class="list_box">
        <div>
            <a href="/profile/{{ $post->user->id }}">
            <!-- 投稿者のアイコン -->
            <img class="form_icon" src="{{ $post->user->images }}" alt="ユーザーアイコン">
            </a>
        </div>
        <div class="contents_box">
            <!-- 投稿ユーザー名 -->
            <p class="contents_username">{{ $post->user->username }}</p>
            <!-- 投稿内容 -->
            <p class="contents_post">{{ $post->post }}</p>
            <!-- ↑空白が適用されちゃうから改行しない -->
        </div>
        <div class="others_box">
            <!-- 投稿日時（秒非表示） -->
            <p class="created_at">{{ $post->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>
</div>
@endforeach

@endsection
