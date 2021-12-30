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

Route::get('/', function () {
    return view('welcome');
})->name('home.index');

Route::get('/contact', function(){
   return 'Contact';
})->name('home.contact');

// Parameters are passed to function argument list
// in order as they're defined in URI
// Name doesn't have to match

// Names can consist of alphabetical chars. and "_"
// should be enclosed in {} braces
Route::get('/posts/{id}', function(int $id){
    return 'Blog Post ' . $id;
});