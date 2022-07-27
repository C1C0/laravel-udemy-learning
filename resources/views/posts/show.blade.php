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
    <p>
        Added {{ $post->created_at->diffForHumans() }}
        by {{$post->user->name}}
    </p>

    {{-- Carbon diffInMinutes --}}
    @if(now()->diffInMinutes($post->created_at) < 20)
        @component('posts.badge', ['type' => 'primary'])
            Brand new Post !
        @endcomponent
    @endif

    <h3>Comments</h3>
    @forelse($post->comments as $comment)
        <div class="p-2 border border-dark shadow-sm mt-3">
            <p>{{$comment->content}}, <span class="font-italic">added: {{$comment->created_at->diffForHumans()}}</span>
            </p>
        </div>
    @empty
        <p>No comments posted yet</p>
    @endforelse

@endsection
