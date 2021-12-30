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

Route::get('/posts', function() use($posts){
    return view ('posts.index', ['posts' => $posts]);
})->name('posts.index');

// Parameters are passed to function argument list
// in order as they're defined in URI
// Name doesn't have to match

// Names can consist of alphabetical chars. and "_"
// should be enclosed in {} braces
Route::get('/posts/{id}', function (int $id) use ($posts) {
    // throws an HTTP exception, if a given boolean expression evaluates to TRUE
    abort_if(!isset($posts[$id]), 404);

    // Passing data to view
    return view('posts.show', ['post' => $posts[$id]]);
})->name('posts.show');

// Optional parameter
// required to specify DEFAULT VALUE
Route::get('/recent-posts/{days_ago?}', function (int $daysAgo = 20) {
    return "Posts from ".$daysAgo." days ago";
})->name('posts.recent.index');
