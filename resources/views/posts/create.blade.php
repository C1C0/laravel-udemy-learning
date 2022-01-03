@extends('layouts.app')

@section('title', 'Create the post')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        {{-- Without @csrf -> 419 returned (POST, PUT, PATCH, DELETE) --}}
        {{-- check for CSRF is done in csrf middleware --}}
        @csrf

        <div><input type="text" name="title"></div>
        <div><textarea name="content"></textarea></div>
        <div><input type="submit" name="Create"></div>
    </form>
@endsection
