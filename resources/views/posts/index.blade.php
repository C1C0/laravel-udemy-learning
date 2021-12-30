@php
    /**
 * @var array $posts
 */
@endphp

@extends('layouts.app')

@section('content')

    @forelse($posts as $key => $post)

        {{-- @include inherits all variables that are available at the place
             where it was called, also accepts array for variable passing --}}
        @include('posts.partials.post', [])

    @empty
        <div> No posts here</div>
    @endforelse

@endsection
