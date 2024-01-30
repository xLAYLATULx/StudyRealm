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
    return view('welcome');
});

Route::get('/goals', function () {
    return view('goals');
});

Route::get('/taskmanager', function () {
    return view('taskmanager');
});

Route::get('/schedule', function () {
    return view('schedule');
});

Route::get('/report', function () {
    return view('report');
});

Route::get('/pomodoro', function () {
    return view('pomodoro');
});

Route::get('/userprofile', function () {
    return view('userprofile');
});
