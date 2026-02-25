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
    <!-- 投稿者のアイコン -->
    <img class="form_icon" src="images/icon1.png">

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
      <!-- ボタン2種の箱 -->
      <div class="list_button">

        <!-- ifの役割：ログインIDと投稿者のIDが一致している投稿については、以下のボタンを表示する -->
        @if (Auth::check() && Auth::user()->id === $post->user_id)

        <!-- 編集ボタン -->
         <button class="edit_btn" data-id="{{ $post->id }}"
        data-text="{{ $post->post }}">
          <img src="/images/edit.png" class="images_edit">
        </button>

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

<!-- 編集モーダル -->
<div id="editModal" class="modal">
  <div class="modal_content">

    <form action="/post/update" method="post">
      @csrf
      <input type="hidden" name="id" id="editId">
      <div class="modal_box">
      <textarea name="post" id="editText"></textarea>
      <button type="submit"><img src="/images/edit.png" class="modal_button"></button>
      </div>
    </form>
  </div>
</div>

@endforeach

@endsection
