<?php

use Illuminate\Http\Request;
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

Route::get('/posts/', function (Request $request) use ($posts) {
    return view('posts.index', ['posts' => $posts]);
})->name('posts.index');

Route::get('/posts/{id}', function (int $id) use ($posts) {
    abort_if(!isset($posts[$id]), 404);

    return view('posts.show', ['post' => $posts[$id]]);
})->name('posts.show');

Route::get('/recent-posts/{days_ago?}', function (int $daysAgo = 20) {
    return "Posts from ".$daysAgo." days ago";
})->name('posts.recent.index');

// Grouped routes share attributes: URL prefix, Name prefix, Middleware
Route::prefix('/fun')->name('fun.')->group(function () use ($posts) {
    Route::get('/responses', function () use ($posts) {
        return response($posts, 201)
            ->header('Content-Type', 'application/json')
            ->cookie('MY_COOKIE', 'Kiko', 3600);
    })->name('responses');

    Route::get('/redirect', function () {
        return redirect('/contact');
    })->name('redirect');

    Route::get('/back', function () {
        return back();
    })->name('back');

    Route::get('/named-route', function () {
        return redirect()->route('posts.show', 1);
    })->name('named-route');

    Route::get('/away', function () {
        return redirect()->away('https://google.com');
    })->name('away');

    Route::get('/json', function () use ($posts) {
        return response()->json($posts);
    })->name('json');

    Route::get('/download', function () use ($posts) {
        return response()->download(public_path('/daniel.jpg'), 'face.jpg');
    })->name('download');

    Route::get('/display-image', function () {
        return response()->file(public_path('/daniel.jpg'));
    })->name('display-image');

});
