<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    function schedule(){
        return view('schedule');
    }
}
