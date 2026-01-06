<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home',[
        "title" => "home"
    ]);
});

Route::get('/about', function () {
    return view('about',[
         "title" => "about",
        
        "name" => "rivaldi",
        "email" => "rivaldi@gmail.com",
        "image" => "rivaldi.img"
    ]);
});

Route::get('/blog', function () {
    return view('posts',[
         "title" => "blog"
    ]);
});
