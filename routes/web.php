<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
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

// Syntax for using controller actions
Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

// Syntax for using single action controller
Route::get('/single', AboutController::class);

Route::resource('posts', PostsController::class)
// if we wanna specify to use all CRUD actions Except specified
    ->except(['update', 'edit'])
// if we wanna specify to use only certain CRUD actions
    ->only(['index', 'show']);

//Route::get('/posts/', function (Request $request) use ($posts) {
//    return view('posts.index', ['posts' => $posts]);
//})->name('posts.index');
//
//Route::get('/posts/{id}', function (int $id) use ($posts) {
//    abort_if(!isset($posts[$id]), 404);
//
//    return view('posts.show', ['post' => $posts[$id]]);
//})->name('posts.show');

Route::get('/recent-posts/{days_ago?}', function (int $daysAgo = 20) {
    return "Posts from ".$daysAgo." days ago";
})->name('posts.recent.index');
