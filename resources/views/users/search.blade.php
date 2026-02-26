@extends('layouts.login')

@section('content')

<div class="search_form">
{!! Form::open(['method' => 'GET']) !!}
    <div class="search_box">
    {!! Form::text('s', $search ?? '',['class'=>'search_window','placeholder' => 'ユーザー名']) !!}
    <button type="submit">
    <img src="/images/search.png" class="search_icon">
    </button>

    @if(!empty($search))
    <p class="search_word">検索ワード：{{ $search }}</p>
    @endif

    </div>
{!! Form::close() !!}
</div>

@foreach($data as $user)
<div class="search_results">
    <div><img src="{{ asset('/images/' . $user->images) }}" class="search_icon"></div>
    <div>{{{ $user->username }}}</div>
</div>
@endforeach

@endsection
