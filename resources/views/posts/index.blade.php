@php
    /**
 * @var array $posts
 */
@endphp

@extends('layouts.app')

@section('content')

    <div class="row mt-3">
        <div class="col-8">
            @forelse($posts as $key => $post)
                @include('posts.partials.post')
            @empty
                <div> No posts here</div>
            @endforelse
        </div>
        <div class="col-4">
            <div class="container">
                <div class="row">
                    <div class="card" style="width: 100%">
                        <div class="card-body">
                            <h5 class="card-title">Most Commented</h5>
                            <h6 class="card-subtitle mb-2 text-muted">what people are currently talking about</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($mostCommented as $post)
                                <a href="{{route('posts.show', ['post' => $post->id])}}">
                                    <li class="list-group-item">{{$post->title}}</li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="card" style="width: 100%">
                        <div class="card-body">
                            <h5 class="card-title">Most Active</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Users with most posts written</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($mostActive as $user)
                                <li class="list-group-item">
                                    <span class="d-flex justify-content-between">
                                        <span>{{$user->name}}</span>
                                        <span title="Number of blog posts written">{{$user->blog_post_count}}</span>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="card" style="width: 100%">
                        <div class="card-body">
                            <h5 class="card-title">Most Active last month</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Users with most posts written last month</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($mostActiveLastMonth as $user)
                                <li class="list-group-item">
                                    <span class="d-flex justify-content-between">
                                        <span>{{$user->name}}</span>
                                        <span title="Number of blog posts written">{{$user->blog_post_count}}</span>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
