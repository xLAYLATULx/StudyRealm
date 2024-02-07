<?php

use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PomodoroController;
use App\Http\Controllers\ScheduleController;

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

Route::post('/goals', [GoalController::class, 'createGoal'])->name('createGoal');

Route::get('/goals', [GoalController::class, 'showGoals'])->name('goal')->middleware('auth');

Route::group(['middleware' => 'auth'], function(){

Route::get('/tasks', [TaskController::class, 'tasks'])->name('tasks');

Route::get('/schedule', [ScheduleController::class, 'schedule'])->name('schedule');

Route::get('/pomodoro', [PomodoroController::class, 'pomodoro'])->name('pomodoro');

Route::get('/report', function () {
    return view('report');
});

});
