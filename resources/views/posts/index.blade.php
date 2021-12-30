@php
    /**
 * @var array $posts
 */
@endphp

@extends('layouts.app')

@section('content')

    @forelse($posts as $key => $post)
        @include('posts.partials.post')
    @empty
        <div> No posts here</div>
    @endforelse

@endsection
