@extends('layouts.app')

@section('title', 'Update the post')

@section('content')
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" class="mx-3">
        @csrf

        {{-- hidden form field for enabling updating --}}
        @method('PUT')

        @include('posts.partials.form')
        <div><input type="submit" name="Create" class="btn btn-primary btn-block"></div>
    </form>
@endsection
