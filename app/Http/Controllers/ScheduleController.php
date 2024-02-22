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
                'id' => $s->id,
                'title' => $s->title,
                'description' => $s->description,
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
        'description' => $request->description,
        'startDate' => $request->startDate,
        'endDate' => $request->endDate,
    ]);

    return response()->json($schedule);
}

public function drag(Request $request, $id)
{
    $schedule = Schedule::find($id);
    if(!$schedule){
        return response()->json(['error' => 'Event not found'], 404);
    }
    $schedule->update([
        'startDate' => $request->startDate,
        'endDate' => $request->endDate,
    ]);
    return response()->json("Event Updated");

}


public function update(Request $request, $id)
{
    $schedule = Schedule::find($id);
    if(!$schedule){
        return response()->json(['error' => 'Event not found'], 404);
    }
    $schedule->update([
        'title' => $request->title,
        'description' => $request->description,
        'startDate' => $request->startDate,
        'endDate' => $request->endDate,
    ]);
    return response()->json("Event Updated");

}

public function destroy($id){
    $schedule = Schedule::find($id);
    if(!$schedule){
        return response()->json(['error' => 'Event not found'], 404);
    }
    $schedule->delete();
    return $id;
}

}
