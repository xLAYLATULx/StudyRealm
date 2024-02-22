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


// Route::get('/taskCreate', [TaskController::class, 'taskCreate'])->name('taskCreate');

// Route::post('/tasks', [TaskController::class, 'createTask'])->name('createTask');

// Route::get('/taskEdit/{id}', [TaskController::class, 'taskEdit'])->name('taskEdit');

// Route::put('/taskEdit/{id}', [TaskController::class, 'editTask'])->name('editTask');

// Route::delete('/taskDelete/{id}', [TaskController::class, 'deleteTask'])->name('deleteTask');

// Route::get('/categoryCreate', [TaskController::class, 'categoryCreate'])->name('categoryCreate');

// Route::post('/tasks', [TaskController::class, 'createCategory'])->name('createCategory');

// Route::get('/categoryEdit/{id}', [TaskController::class, 'categoryEdit'])->name('categoryEdit');

// Route::put('/categoryEdit/{id}', [TaskController::class, 'editCategory'])->name('editCategory');

// Route::delete('/tasks', [TaskController::class, 'deleteCategory'])->name('deleteCategory');

Route::group(['middleware' => 'auth'], function(){

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
Route::patch('/schedule/update/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
Route::delete('/schedule/destroy/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

Route::get('/pomodoro', [PomodoroController::class, 'pomodoro'])->name('pomodoro');

Route::get('/report', function () { return view('report');});

});

Route::get ('/goals', App\Livewire\Goal\Index::class)->name('goal.index');
Route::get ('/tasks', App\Livewire\TaskManager\Index::class)->name('tasks');
