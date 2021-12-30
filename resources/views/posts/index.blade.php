@php
    /**
 * @var array $posts
 */
@endphp

@extends('layouts.app')

@section('content')

    @notEmpty($posts)

    @foreach($posts as $key => $post)
        <h3> {{ $key }}. {{ $post['title'] }}</h3>
    @endforeach

    @else
        <div> No posts posted here </div>
    @endnotEmpty
@endsection
