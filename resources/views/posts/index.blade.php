@php
    /**
 * @var array $posts
 */
@endphp

@extends('layouts.app')

@section('content')
    @foreach($posts as $key => $post)
        <h3> {{ $key }}. {{ $post['title'] }}</h3>
    @endforeach
@endsection
