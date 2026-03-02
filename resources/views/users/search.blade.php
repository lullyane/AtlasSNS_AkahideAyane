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

@auth
    @if (Auth::user()->id !== $user->id)
        @if (Auth::user()->isFollowing($user->id))
            {{-- フォロー解除 --}}
            <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    フォロー解除
                </button>
            </form>
        @else
            {{-- フォロー --}}
            <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">
                    フォローする
                </button>
            </form>
        @endif
    @endif
@endauth

@endforeach

@endsection
