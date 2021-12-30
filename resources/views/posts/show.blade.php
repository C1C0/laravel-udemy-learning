@php
    /**
 * @var array $post
 */
@endphp

@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    {{-- Mustache syntax - before outputing data, run through htmlspecialchars function --}}
    <h1>{{ $post['title'] }}</h1>
    <p> {{ $post['content'] }}</p>
@endsection

{{-- Conditional rendering --}}
@if($post['is_new'])
    <div>A new blog post</div>
@elseif(!$post['is_new'])
    <div>An old blog post</div>
@else
    <div>Dummy data</div>
@endif

@unless($post['is_new'])
    <div>Using unless on old post</div>
@endunless

{{-- same as isset() in php --}}
@isset($post['has_comments'])
    <div>The post has some comments</div>
@endisset

{{-- same as empty() in php --}}
@empty($post['has_comments'])
    <div>The post doesn't have any comments</div>
@endempty

@section('footer')
    @parent

    <h4>I'm very important here as well</h4>
@endsection
