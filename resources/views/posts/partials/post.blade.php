<h3><a href="{{ route('posts.show', ['post' => $post->id] ) }}">{{ $post->title }}</a></h3>

<p>
    Added {{ $post->created_at->diffForHumans() }}
    by {{$post->user->name}}
</p>

@if($post->comments_count)
    <p>{{$post->comments_count}} comments</p>
@else
    <p>No comments Yet !</p>
@endif

<div class="mb-3">
    @can('update', $post)
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
    @endcan

    @can('delete', $post)
        <form class="d-inline" action="{{route('posts.destroy', ['post' => $post->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete" class="btn btn-primary">
        </form>
    @endcan
</div>
