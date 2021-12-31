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
