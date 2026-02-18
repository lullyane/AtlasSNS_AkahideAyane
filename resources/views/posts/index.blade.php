@extends('layouts.login')

@section('content')
<form action="/top" method="post">
    <div class="form">
      <img class="form_icon" src="images/icon1.png">
      <!-- CSRF攻撃対策 -->
      @csrf
      <textarea name="post" placeholder="投稿内容を入力してください"></textarea>
      <button><img class="post" src="images/post.png"></button>
    </div>
</form>

@foreach ($posts as $post)
    <div>
      <img class="form_icon" src="images/icon1.png">
      <p>{{ $post->user->username }}</p>
      <p>{{ $post->created_at }}</p>
      <p>{{ $post->post }}</p>
    </div>
@endforeach

@endsection
