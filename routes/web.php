<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\AboutController;

route::get('/', function () {
    return view('welcome');
});

route::get('/hello', function () {
    return view('hello');
});

route::get('/about', function () {
    return view('about');
});

Route::get('/home', [HomeController::class, 'index']);