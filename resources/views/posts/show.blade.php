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

@section('footer')
    @parent

    <h4>I'm very important here as well</h4>
@endsection
