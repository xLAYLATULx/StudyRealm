<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::where('userID', auth()->user()->id)->orderBy('deadline', 'desc')->orderBy('priority', 'desc')->get();
        return view("livewire.task-manager.index", compact('tasks'));
    }
}
