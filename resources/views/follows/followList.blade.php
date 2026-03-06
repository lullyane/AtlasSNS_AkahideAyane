@extends('layouts.login')

@section('content')

<div class="post_form follow_top">
  <p>フォローリスト</p>
  <div class="follow_img">
  @foreach ($posts as $post)
  <img class="form_icon" src="{{ $post->user->images }}">
  @endforeach
  </div>
</div>

@foreach ($posts as $post)
<div class="list">
  <div class="list_box">
    <!-- 投稿者のアイコン -->
    <img class="form_icon" src="{{ $post->user->images }}">

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
