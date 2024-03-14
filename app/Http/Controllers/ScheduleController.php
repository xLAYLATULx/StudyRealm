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
                if($s->isGoal == 1){
                    $colour = "GoldenRod";
                } else if($s->isTask == 1){
                    $colour = "IndianRed";
                } else {
                    $colour = "#0D98BA";
                }
            $events[] = [
                'id' => $s->id,
                'title' => $s->title,
                'description' => $s->description,
                'start' => $s->startDate,
                'end' => $s->endDate,
                'backgroundColor' => $colour,
            ];
            
        }
        }
        return view('schedule.index', ['events' => $events]);
    }

    public function rules(){
        return [
            'title' => 'required|string|unique:schedule',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Please enter a title.',
            'title.unique' => 'This event already exists. Please enter a different title.',
            'startDate.required' => 'Please enter a start date.',
            'startDate.date' => 'Please enter a valid date for the start date.',
            'endDate.required' => 'Please enter an end date.',
            'endDate.date' => 'Please enter a valid date for the end date.',
            'endDate.after_or_equal' => 'End date should be after or equal to the start date.',
        ];
    }

    public function store(Request $request)
{
    $validatedData = $this->validate($request, $this->rules(), $this->messages());
    $schedule = Schedule::create([
        'userID' => auth()->id(),
        'title' => $request->title,
        'description' => $request->description,
        'startDate' => $request->startDate,
        'endDate' => $request->endDate,
        'isGoal' => $request->isGoal,
        'isTask' => $request->isTask,
    ]);
    $this->resetInputs();
    return response()->json("Event Created");
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
    $this->resetInputs();
    return response()->json("Event Updated");

}


public function update(Request $request, $id)
{
    $schedule = Schedule::find($id);
    if(!$schedule){
        return response()->json(['error' => 'Event not found'], 404);
    }
    $this->validate($request, [
        'title' => 'required|string|unique:schedule,title,'.$id,
        'description' => 'required|string',
        'startDate' => 'required|date',
        'endDate' => 'required|date|after_or_equal:startDate',
    ], [
        'title.required' => 'Please enter a title.',
        'title.unique' => 'This event already exists. Please enter a different title.',
        'startDate.required' => 'Please enter a start date.',
        'startDate.date' => 'Please enter a valid date for the start date.',
        'endDate.required' => 'Please enter an end date.',
        'endDate.date' => 'Please enter a valid date for the end date.',
        'endDate.after_or_equal' => 'End date should be after or equal to the start date.',
    ]);
    $schedule->update([
        'title' => $request->title,
        'description' => $request->description,
        'startDate' => $request->startDate,
        'endDate' => $request->endDate,
    ]);
    $this->resetInputs();
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

public function resetInputs(){
    $this->title = '';
    $this->description = '';
    $this->startDate = '';
    $this->endDate = '';
    $this->isGoal = '';
    $this->isTask = '';
}

}
