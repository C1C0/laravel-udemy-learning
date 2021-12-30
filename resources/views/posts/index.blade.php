@php
    /**
 * @var array $posts
 */
@endphp

@extends('layouts.app')

@section('content')

    @forelse($posts as $key => $post)
        <h3> {{ $key }}. {{ $post['title'] }}</h3>
    @empty
        <div> No posts here</div>
    @endforelse

@endsection
