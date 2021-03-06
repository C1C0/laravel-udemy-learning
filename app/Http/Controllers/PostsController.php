<?php

/**
 * GENERATED by command:
 * php artisan make:controller PostsController --resource
 *
 * Creates file with all the CRUD actions
 */

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use function PHPUnit\Framework\returnArgument;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')
            ->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => BlogPost::latest()->withCount('comments')
                ->get(),
            'mostCommented' => BlogPost::mostCommented()->take(5)->get(),
            'mostActive' => User::withMostBlogPosts()->take(5)->get(),
            'mostActiveLastMonth'=> User::withMostBlogPostsLastMonth()->take(5)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePost  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();


        if (isset($validated['user_id'])) {
            $validated += $request->validate(['user_id' => ['required', 'numeric', 'gt:0']]);
        } else {
            $validated['user_id'] = Auth::user()->id;
        }

        $post = BlogPost::create($validated);

        $request->session()->flash('status', 'The blog post was created');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return  \Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
//        return view('posts.show', ['post' => BlogPost::with(['comments' => function ($query){
//            return $query->latest();
//        }])->findOrFail($id)]);

        return view('posts.show', ['post' => BlogPost::with('comments')->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize($post);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize($post);

        $validated = $request->validated();
        $post->fill($validated);
        $post->save();


        $request->session()->flash('status', 'Blog post was updated !');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize($post);

        $post->delete();

        session()->flash('status', 'Post Deleted !');
        return redirect()->route('posts.index');
    }
}
