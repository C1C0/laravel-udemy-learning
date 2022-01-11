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
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('posts.index', ['posts' => BlogPost::orderBy('created_at', 'desc')->get()]);
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
        return view('posts.show', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
