@php
    /**
 * @var array $posts
 */
@endphp

@extends('layouts.app')

@section('content')

    @forelse($posts as $key => $post)
        {{-- Possibilty to use @break, @continue, $loop --}}
        @if($loop->even)
            <h3> {{ $key }}. {{ $post['title'] }}</h3>
        @else
            <h3 style="background-color: #ddd"> {{ $key }}. {{ $post['title'] }}</h3>
        @endif
    @empty
        <div> No posts here</div>
    @endforelse

@endsection
