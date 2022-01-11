@extends('layouts.app')

@section('title', 'Update the post')

@section('content')
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
        @csrf

        {{-- hidden form field for enabling updating --}}
        @method('PUT')

        @include('posts.partials.form')
        <div><input type="submit" name="Create"></div>
    </form>
@endsection
