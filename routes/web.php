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
    // returns array of all query parameters
    dd($request->all());

    // behaves almost same as ->all(), but returns collection
    dd($request->collect());

    // returns only value of specified parameter or NULL or default value if specified
    // input look at all possible input places (whole request payload):
    // HTML form, query, XHR request
    dd($request->input('niae', 1));

    // looks only into query
    // if called without parameters, all of the query string values are returned as associative array
    dd($request->query('niae', 1));

    // Additional options:

    // when dealing with HTML elements which returns only 'truthy' values
    // returns true for: 1, "1", true, "true", "on", "yes"
    $request->boolean('HTMLOnCheckbox');

    // White(black)-listing certain values from the input
    // array or non-array values allowed
    $request->only(['username', 'password'], 'idunno');
    $request->except(['credit_card'], 'kidney');

    // check if request has specified value(s)
    if($request->has(['name', 'email'], 'maybeMe'));
    // check if request is missing (they cannot be presented) certain values
    if($request->missing(['name', 'email'], 'maybeMe'));

    // has with callback
    // only string as $key allowed
    $request->whenHas('email', function($input){});

    // check if request has at least one presented
    if($request->hasAny(['name', 'email'], 'maybeMe'));

    // checks if value name is presented and the data is FILLED (not empty)
    if($request->filled('name'));
    $request->whenFilled('name', function($input){});


    return view('posts.index', ['posts' => $posts]);
})->name('posts.index')
    // usually use ALIAS of middleware specified in Kernel.php
    ->middleware('auth');

Route::get('/posts/{id}', function (int $id) use ($posts) {
    abort_if(!isset($posts[$id]), 404);

    return view('posts.show', ['post' => $posts[$id]]);
})->name('posts.show');

Route::get('/recent-posts/{days_ago?}', function (int $daysAgo = 20) {
    return "Posts from ".$daysAgo." days ago";
})->name('posts.recent.index');

// Grouped routes share attributes: URL prefix, Name prefix, Middleware
Route::prefix('/fun')->name('fun.')->group(function() use($posts){
    Route::get('/responses', function () use ($posts) {

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
    })->name('responses');

    Route::get('/redirect', function () {
        // Redirect to specified page
        return redirect('/contact');
    })->name('redirect');

    Route::get('/back', function () {
        // Returning to previous page
        // Utilizes session -> the route should be in "web" middleware group
        return back();
    })->name('back');

    Route::get('/named-route', function () {
        // redirecting based on name

        // adds parameter as in route ... /posts/1
        return redirect()->route('posts.show', 1);

        // assigns parameter to specific name ... if not id, error would be thrown
//    return redirect()->route('posts.show', ['id' => 1]);
    })->name('named-route');

    Route::get('/away', function () {
        // redirecting from our website domain
        return redirect()->away('https://google.com');
    })->name('away');

    Route::get('/json', function () use ($posts) {
        // redirecting from our website domain
        return response()->json($posts);
    })->name('json');

    Route::get('/download', function () use ($posts) {
        // redirecting from our website domain
        // it's required that file has ASCII file name
        return response()->download(public_path('/daniel.jpg'), 'face.jpg');
    })->name('download');

    Route::get('/display-image', function () {
        // Displays the image in the user's browser
        return response()->file(public_path('/daniel.jpg'));
    })->name('display-image');

});
