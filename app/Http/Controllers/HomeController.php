<?php

/**
 * GENERATED by command:
 * php artisan make:controller HomeController
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth')->except('contact');
    }

    public function home(){
        return view('home.index');
    }

    public function contact(){
        return view('home.contact');
    }

    public function secret(){
        return view('home.secret');
    }
}
