@php
/**
 * @var object $post
 */
@endphp

<div><input type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}"></div>
@error('title')
<p>{{$message}}</p>
@enderror
{{-- show specific error --}}

<div><textarea name="content">{{ old('content', optional($post ?? null)->content) }}</textarea></div>

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
