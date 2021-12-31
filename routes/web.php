<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to Laravel',
        'is_new' => true,
        'has_comments' => true,
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false,
    ],
];

Route::view('/', 'home.index')->name('home.index');;
Route::view('/contact', 'home.contact')->name('home.contact');;

Route::get('/posts', function () use ($posts) {
    return view('posts.index', ['posts' => $posts]);
})->name('posts.index');

Route::get('/posts/{id}', function (int $id) use ($posts) {
    abort_if(!isset($posts[$id]), 404);

    return view('posts.show', ['post' => $posts[$id]]);
})->name('posts.show');

Route::get('/recent-posts/{days_ago?}', function (int $daysAgo = 20) {
    return "Posts from ".$daysAgo." days ago";
})->name('posts.recent.index');

Route::get('/fun/responses', function () use ($posts) {
    // Use response, when there is need to add something else like header or cookie
    // or change resp. code
    // On this method you can add ->view() as well
    return response($posts, 201)
        // -> view()
        ->header('Content-Type', 'application/json')
        // Posibility to use also
        // ->withHeaders([
        //     'header1' => '1',
        //     'header2' => '2',
        // ])
        ->cookie('MY_COOKIE', 'Kiko', 3600);
});

Route::get('/fun/redirect', function () {
    // Redirect to specified page
    return redirect('/contact');
});

Route::get('/fun/back', function () {
    // Returning to previous page
    // Utilizes session -> the route should be in "web" middleware group
    return back();
});

Route::get('/fun/named-route', function () {
    // redirecting based on name

    // adds parameter as in route ... /posts/1
    return redirect()->route('posts.show', 1);

    // assigns parameter to specific name ... if not id, error would be thrown
//    return redirect()->route('posts.show', ['id' => 1]);
});

Route::get('/fun/away', function () {
    // redirecting from our website domain
    return redirect()->away('https://google.com');
});

Route::get('/fun/json', function () use($posts) {
    // redirecting from our website domain
    return response()->json($posts);
});

Route::get('/fun/download', function () use($posts) {
    // redirecting from our website domain
    // it's required that file has ASCII file name
    return response()->download(public_path('/daniel.jpg'), 'face.jpg');
});

