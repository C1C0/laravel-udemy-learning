@if($loop->even)
    <h3> {{ $key }}. {{ $post->title }}</h3>
@else
    <h3 style="background-color: #ddd"> {{ $key }}. {{ $post->title }}</h3>
@endif

<div>
    <form action="{{route('posts.destroy', ['post' => $post->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>
</div>
