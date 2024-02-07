<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PomodoroController extends Controller
{
    function pomodoro(){
        return view('pomodoro');
    }
}
