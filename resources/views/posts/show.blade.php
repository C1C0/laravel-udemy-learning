@php
    /**
 * @var object $post
 */
@endphp

@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>{{ $post->title }}</h1>
    <p> {{ $post->content }}</p>

    {{-- Using carbon time library --}}
    <p>Added {{ $post->created_at->diffForHumans() }}</p>

    {{-- Carbon diffInMinutes --}}
    @if(now()->diffInMinutes($post->created_at) < 5)
        <div class="alert alert-info">New !</div>
    @endif

@endsection
