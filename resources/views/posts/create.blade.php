@extends('layouts.app')

@section('title', 'Create the post')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        {{-- Without @csrf -> 419 returned (POST, PUT, PATCH, DELETE) --}}
        {{-- check for CSRF is done in csrf middleware --}}
        @csrf
        @include('posts.partials.form')
        <div><input type="submit" name="Create" class="btn btn-primary btn-block"></div>
    </form>
@endsection
