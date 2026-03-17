@extends('layouts.login')

@section('content')

@foreach ($user as $user)
<div class="others_top_wrapper">
    <div class="others_top">
    <img class="form_icon" src="{{ asset('storage/' . $user->images) }}">
    <div class="others_item">
            <p>ユーザー名</p>
            <p>自己紹介</p>
        </div>
        <div class="others_content">
            <p>{{ $user->username }}</p>
            <p>{{ $user->bio }}</p>
        </div>
    <div class="follow_area">
        @auth
        @if (Auth::user()->id !== $user->id)
        @if (Auth::user()->isFollowing($user->id))
        <!-- route：ルートファイルのnameから拾ってる -->
        <form action="{{ route('unfollow_follow', ['id' => $user->id]) }}" method="POST">
            @csrf
            <button type="submit" class="btn follow_unfollow">フォロー解除</button>
        </form>
        @else
        <form action="{{ route('following_follow', ['id' => $user->id]) }}" method="POST">
            @csrf
            <button type="submit" class="btn follow_follow">フォローする</button>
        </form>
        @endif
        @endif
        @endauth
    </div>
    </div>
</div>
@endforeach

@foreach ($posts as $post)
<div class="list">
    <div class="list_box">
        <!-- 投稿者のアイコン -->
        <img class="form_icon" src="{{ asset('storage/' . $post->user->images) }}">
        <div class="contents_box">
            <!-- 投稿ユーザー名 -->
            <p class="contents_username">{{ $post->user->username }}</p>
            <!-- 投稿内容 -->
            <p class="contents_post">{{ $post->post }}</p>
            <!-- ↑空白が適用されちゃうから改行しない -->
        </div>
        <div class="others_box">
            <!-- 投稿日時（秒非表示） -->
            <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>
</div>
@endforeach

@endsection
