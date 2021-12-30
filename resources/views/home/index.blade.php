{{-- Specifies, which layout the child view should inherit --}}
@extends('layouts.app')

{{-- Used for "simpler" yielding --}}
@section('title', 'Home page')

{{-- Section specifies, where in extended layout should --}}
{{-- Content appear --}}
@section('content')
    <h1>Hello world</h1>
@endsection

@section('footer')
    {{-- Used for appending (rather than overwriting) content to the --}}
    {{-- to the specified layout's section (content)  --}}
    @parent

    <h4>I'm very important here as well</h4>
@endsection
