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
    <title>Laravel App - @yield('title')</title>
</head>
<body>
{{-- Renders content of specific section --}}
{{-- Defined in child templates --}}
@yield('content')

{{-- This syntax used, if we expect the @section being extentded --}}
{{-- Important: Ending with @show directive --}}
@section('footer')
    <h2 style="margin-top: 1rem">FOOTER</h2>
@show

</body>
</html>
