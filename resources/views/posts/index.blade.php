@extends('layouts.login')

@section('content')

<form action="/top" method="post" class="post_form">
  <div class="form_box">
    <img class="form_icon" src="images/icon1.png">
    <!-- CSRF攻撃対策 -->
    @csrf
    <textarea name="post" placeholder="投稿内容を入力してください"></textarea>
    <button><img class="post" src="images/post.png"></button>
  </div>
</form>

@foreach ($posts as $post)
<div class="list">
  <div class="list_box">
    <img class="form_icon" src="images/icon1.png">
    <div class="contents_box">
      <p class="contents_username">{{ $post->user->username }}</p>
      <p class="post_username">{{ $post->post }}</p>
      <!-- ↑空白が適用されちゃうから改行しない -->

    </div>
    <div class="others_box">
      <!-- 投稿日時の秒非表示 -->
      <p class="created_at">{{ $post->created_at->format('Y-m-d H:i') }}</p>

      <div class="list_button">
        @if (Auth::check() && Auth::user()->id === $post->user_id)
        <!-- 🍊リンク設定未完了 -->
        <a href=""><img src="images/edit.png" class="images_edit"></a>
        @endif

        @if(Auth::check() && (Auth::user()->id === $post->user_id || Auth::user()->isAdmin()))
        <!-- 🍊デリート機能の実装未完了 -->
        <form action="/top" method="POST" onsubmit="return confirm('本当に削除しますか？');" class="delete_form">
        @csrf
        @method('DELETE')
        <button><img src="images/trash.png" class="images_trash"></button>
        </form>
        @endif
      </div>

    </div>
  </div>
</div>
@endforeach

@endsection
