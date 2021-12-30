@extends('layouts.app')

@section('title', 'Home page')

@section('content')
    <h1>Hello world</h1>
@endsection

@section('footer')
    @parent

    <h4>I'm very important here as well</h4>
@endsection
