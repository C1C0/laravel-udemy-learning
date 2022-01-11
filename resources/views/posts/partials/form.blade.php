@php
/**
 * @var object $post
 * */
@endphp

<div><input type="text" name="title" value="{{ old('title', $post->title) }}"></div>
@error('title')
<p>{{$message}}</p>
@enderror
{{-- show specific error --}}

<div><textarea name="content">{{ old('content', $post->content) }}</textarea></div>

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
