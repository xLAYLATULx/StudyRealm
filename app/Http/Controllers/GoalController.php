<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use auth;

class GoalController extends Controller
{
    function showGoals(){
        $goals = Goal::where('userID', auth()->user()->id)->get();
        return view('goals', ['goals' => $goals]);
    }

    function createGoal(Request $request){
        $request->validate([
            'goalName' => 'required',
            'goalDeadline' => 'required|date'
        ]);
        $goal = new Goal();
        $goal->userID = auth()->user()->id;
        $goal->goalName = $request->input('goalName');
        $goal->deadline = $request->input('goalDeadline');
        $goal->completed = false;
        $goal->save();

        if(!$goal){
            return redirect(route('goal'))->with("error", "Creating Goal Failed. Please Try Again.");
        }
        return redirect(route('createGoal'));
        
    }
}
