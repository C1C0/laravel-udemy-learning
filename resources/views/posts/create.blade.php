@extends('layouts.app')

@section('title', 'Create the post')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        {{-- Without @csrf -> 419 returned (POST, PUT, PATCH, DELETE) --}}
        {{-- check for CSRF is done in csrf middleware --}}
        @csrf

        <div><input type="text" name="title"></div>
        @error('title')
        <p>{{$message}}</p>
        @enderror
        {{-- show specific error --}}

        <div><textarea name="content"></textarea></div>

        {{-- Show all errors --}}
        @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div><input type="submit" name="Create"></div>
    </form>
@endsection
