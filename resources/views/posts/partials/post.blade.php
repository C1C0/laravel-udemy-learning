@if($loop->even)
    <h3> {{ $key }}. {{ $post['title'] }}</h3>
@else
    <h3 style="background-color: #ddd"> {{ $key }}. {{ $post['title'] }}</h3>
@endif
