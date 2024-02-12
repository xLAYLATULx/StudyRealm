<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use auth;

class GoalController extends Controller
{
    public function index(){
        $goals = Goal::where('userID', auth()->user()->id)->orderBy('deadline', 'desc')->get();
        return view("livewire.goals.index", compact('goals'));
    }
}
