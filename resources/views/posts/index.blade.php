@php
    /**
 * @var array $posts
 */
@endphp

@extends('layouts.app')

@section('content')

    {{-- Includes forelse functionality and calls specified partial, doesn't inherit all variables as @include does

         Arguments: partial name, collection to render, iteration variable inside template
         optional: @empty behaviour --}}
    @each('posts.partials.post', $posts, 'post')

@endsection
