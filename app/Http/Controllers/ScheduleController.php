<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    
    public function index(){
        $events = array();
        $schedule = Schedule::all();
        foreach($schedule as $s){
            if($s->userID == auth()->id()){
            $events[] = [
                'title' => $s->title,
                'start' => $s->startDate,
                'end' => $s->endDate,
            ];
        }
        }
        return view('schedule.index', ['events' => $events]);
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'startDate' => 'required|date',
        'endDate' => 'required|date|after_or_equal:startDate',
    ]);

    $schedule = Schedule::create([
        'userID' => auth()->id(),
        'title' => $request->title,
        'description' => 'No description',
        'startDate' => $request->startDate,
        'endDate' => $request->endDate,
    ]);

    return response()->json($schedule);
}

}
