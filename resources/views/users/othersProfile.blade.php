@extends('layouts.login')

@section('content')

 @foreach ($users as $user)
<div class="post_form follow_top">
  <img class="form_icon" src="{{ asset('storage/' . $user->images) }}">
  <div>
    <p>ユーザー名</p>
    <p>{{ $user->username }}</p>
  </div>
  <div>
    <p>自己紹介</p>
    <p>{{ $user->bio }}</p>
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
      <p class="created_at">{{ $post->created_at->format('Y-m-d H:i') }}</p>
    </div>
  </div>
</div>
@endforeach

@endsection
