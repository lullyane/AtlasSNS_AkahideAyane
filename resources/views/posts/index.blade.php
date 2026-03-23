@extends('layouts.login')

@section('content')

<div>
    <div class="error_area">
        {{-- 未入力の場合に出るエラーメッセージ --}}
        @if ($errors->any())
        <p class="error has_error">{{ $errors->first() }}</p>
        @else
        <p class="error"></p>
        @endif

        {{-- 150文字以上入力で出るエラーメッセージ --}}
        <p id="countError" class="textarea_error">※投稿内容は150文字以内で入力してください。</p>
    </div>
    <form action="/top" method="post" class="post_form">
        <div class="form_box">
            <div>
                <img
                src="{{ Auth::user()->profile_image_url }}"
                alt="ユーザーアイコン"
                class="posts_icon">
            </div>
            <!-- CSRF攻撃対策 -->
            @csrf
            <textarea name="post" placeholder="投稿内容を入力してください"></textarea>
            <div class="img_wrap">
                <button><img class="post" src="images/post.png" alt="投稿"></button>
            </div>
        </div>
    </form>
</div>

@foreach ($posts as $post)
<div class="list">
    <div class="list_box">
        <div>
            <!-- 投稿者のアイコン（プロフィールリンク設定） -->
            <a href="/profile/{{ $post->user->id }}">
                <img class="form_icon"
                src="{{ $post->user->images
                ? asset('storage/' . $post->user->images)
                : asset('images/icon1.png') }}"
                alt="ユーザーアイコン">
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
            <div>
                <p class="created_at">{{ $post->created_at->format('Y-m-d H:i') }}</p>
            </div>
            <!-- ボタン2種の箱 -->
            <div class="list_button">
                <!-- ifの役割：ログインIDと投稿者のIDが一致している投稿については、以下のボタンを表示する -->
                @if (Auth::check() && Auth::user()->id === $post->user_id)
                <!-- 編集ボタン -->
                <div>
                    <button class="images_edit" data-id="{{ $post->id }}" data-text="{{ $post->post }}"><img src="/images/edit.png" alt="編集"></button>
                </div>
                <!-- 削除ボタン -->
                <div>
                    <form onsubmit="return confirm('本当に削除しますか？');" class="delete_message">
                    <!-- このformationのURLとルートのURLを合わせる -->
                    <button formaction="/post/{{ $post->id }}/delete" formmethod="get">
                        <div class="trash_images">
                            <img src="images/trash.png" class="images_trash" alt="削除">
                            <img src="images/trash-h.png" class="images_trash_h" alt="削除">
                        </div>
                    </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- 編集モーダル -->
<div id="editModal" class="modal">
    <div class="modal_wrap">
        <form action="/post/update" method="post">
            @csrf
            <input type="hidden" name="id" id="editId">
            <div class="modal_text">
                <textarea name="post" id="editText"></textarea>
            </div>
            <div class="update_button_wrap">
                <button type="submit" class="update_button"><img src="/images/edit.png" alt="更新"></button>
            </div>
        </form>
    </div>
</div>

@endforeach

@endsection
