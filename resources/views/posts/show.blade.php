@php
    /**
 * @var object $post
 */
@endphp

@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1 class="d-flex align-items-start mt-3">
        <span class="mr-2">
        {{ $post->title }}
            </span>
        {{-- Carbon diffInMinutes --}}
        <x-badge type="primary" :show="now()->diffInMinutes($post->created_at) < 5">
            Brand new Post !
        </x-badge>
    </h1>
    <p> {{ $post->content }}</p>

    {{-- Using carbon time library --}}
    <p>
        Added {{ $post->created_at->diffForHumans() }}
        by {{$post->user->name}}
    </p>

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
