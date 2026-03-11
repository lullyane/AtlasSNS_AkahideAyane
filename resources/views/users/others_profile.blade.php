@extends('layouts.login')

@section('content')

 @foreach ($user as $user)
<div class="post_form others_top">
  <img class="form_icon" src="{{ asset('storage/' . $user->images) }}">
  <div class="others_user">
    <div class="others_block">
      <p class="item">ユーザー名</p>
      <p>{{ $user->username }}</p>
    </div>
    <div class="others_block">
      <p class="item">自己紹介</p>
      <p>{{ $user->bio }}</p>
    </div>
  </div>
  @auth
    @if (Auth::user()->id !== $user->id)
    @if (Auth::user()->isFollowing($user->id))
    <!-- route：ルートファイルのnameから拾ってる -->
      <form action="{{ route('unfollow_follow', ['id' => $user->id]) }}" method="POST">
        @csrf
        <button type="submit" class="btn follow_unfollow">
          フォロー解除
        </button>
      </form>
      @else
      <form action="{{ route('following_follow', ['id' => $user->id]) }}" method="POST">
        @csrf
        <button type="submit" class="btn follow_follow">
        フォローする
        </button>
      </form>
    @endif
    @endif
  @endauth
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
      <p class="created_at">{{ $post->created_at->format('Y-m-d H:i') }}</p>
    </div>
  </div>
</div>
@endforeach

@endsection
