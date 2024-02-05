<?php

use App\Http\Controllers\AuthManager;
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

Route::get('/', [AuthManager::class, 'login'])->name('login');

Route::post('/', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/register', [AuthManager::class, 'register'])->name('register');

Route::post('/register', [AuthManager::class, 'registerPost'])->name('register.post');

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('/profile/{id}', [AuthManager::class, 'profile'])->name('profile' )->middleware(['auth']);

Route::put('/profile/{id}', [AuthManager::class, 'updateDetails'])->name('profile.update');

Route::group(['middleware' => 'auth'], function(){

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

});
