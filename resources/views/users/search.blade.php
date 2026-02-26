@extends('layouts.login')

@section('content')

<div class="search_form">
{!! Form::open(['method' => 'GET']) !!}
    {!! Form::text('s', $search ?? '') !!}
    {!! Form::submit('検索') !!}
{!! Form::close() !!}
</div>

@foreach($data as $post)
<div>
    <div>{{{ $post->id }}}</div>
    <div>{{{ $post->post }}}</div>
</div>
@endforeach

@endsection
