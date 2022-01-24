@php
/**
 * @var object $post
 */
@endphp

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', optional($post ?? null)->title) }}" class="form-control">
</div>
@error('title')
<div class="alert alert-danger">{{$message}}</div>
@enderror
{{-- show specific error --}}

<div class="form-group">
    <label for="content">Content</label>
    <textarea id="content" name="content" class="form-control">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>

{{-- Show all errors --}}
@if($errors->any())
    <div class="mb-3">
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item list-group-item-danger"> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif
