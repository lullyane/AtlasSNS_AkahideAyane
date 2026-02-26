@extends('layouts.login')

@section('content')

<div class="search_form">
{!! Form::open(['method' => 'GET']) !!}
    {!! Form::text('s', $search ?? '') !!}
    {!! Form::submit('検索') !!}
{!! Form::close() !!}

@if(!empty($search))
    <p>検索ワード：{{ $search }}</p>
@endif

</div>

@foreach($data as $user)
<div>
    <div>{{{ $user->images }}}</div>
    <div>{{{ $user->username }}}</div>
</div>
@endforeach

@endsection
