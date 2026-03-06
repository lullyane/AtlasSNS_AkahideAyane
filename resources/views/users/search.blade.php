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

    <div class="user_row">

        <div class="user_icon">
            <img src="{{ ($user->images) }}" class="search_icon">
        </div>

        <div class="user_name">
            {{{ $user->username }}}
        </div>

        @auth
            @if (Auth::user()->id !== $user->id)
                @if (Auth::user()->isFollowing($user->id))
                    <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn unfollow">
                            フォロー解除
                        </button>
                    </form>
                @else
                    <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn follow">
                            フォローする
                        </button>
                    </form>
                @endif
            @endif
        @endauth

    </div>

</div>
@endforeach

@endsection
