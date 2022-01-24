<?php
/**
 * Used as boilerplate layout across different views files
 */
?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- mix() takes care of versioning itself --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>

    <title>Laravel App - @yield('title')</title>
</head>
<body>
@if(session('status'))
    <div style="background-color: #4a5568; color: white">
        {{ session('status') }}
    </div>
@endif
@yield('content')

@section('footer')
    <h2 style="margin-top: 1rem">FOOTER</h2>
@show

</body>
</html>
