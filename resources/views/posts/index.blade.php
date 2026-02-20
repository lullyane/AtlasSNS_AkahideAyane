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
      <p class="contents_post">{{ $post->post }}</p>
      <!-- ↑空白が適用されちゃうから改行しない -->

    </div>
    <div class="others_box">
      <!-- 投稿日時の秒非表示 -->
      <p class="created_at">{{ $post->created_at->format('Y-m-d H:i') }}</p>

      <div class="list_button">
        <!-- ifの役割：ログインIDと投稿者のIDが一致している投稿については、以下のボタンを表示する -->
        @if (Auth::check() && Auth::user()->id === $post->user_id)
        <!-- 編集ボタン 🍊リンク設定未完了 -->
        <a href=""><img src="images/edit.png" class="images_edit"></a>
        <!-- 削除ボタン -->
        <form onsubmit="return confirm('本当に削除しますか？');">
          <!-- このformationのURLとルートのURLを合わせる -->
          <button formaction="/post/{{ $post->id }}/delete" formmethod="get">
            <div class="trash_images">
              <img src="images/trash.png" class="images_trash">
              <img src="images/trash-h.png" class="images_trash_h">
            </div>
          </button>
        </form>
        @endif
      </div>

    </div>
  </div>
</div>
@endforeach

@endsection
