@extends('layouts.app')

@section('title', 'Contact page')

@section('content')
    <h1>Contact Page</h1>

    <p>contact info</p>

    @can('home.secret')
        <p>Link to special secret page: <a href="{{route('home.secret')}}">Secret</a></p>
    @endcan
@endsection
