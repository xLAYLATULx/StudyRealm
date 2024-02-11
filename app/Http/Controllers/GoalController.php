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

    public function create(){
        return view("livewire.goals.create");
    }

    // public function store(Request $request){
    //     $request->validate([
    //         'goalName' => 'required',
    //         'goalDescription' => 'required',
    //         'goalDeadline' => 'required|date',
    //     ]);
    //     Goal::create([
    //         'userID' => auth()->user()->id,
    //         'goalName' => $request->goalName,
    //         'description' => $request->goalDescription,
    //         'progress' => 0.00,
    //         'deadline' => $request->goalDeadline,
    //         'completed' => false,
    //     ]);
    //     return redirect(route('goals.index'))->with('success', 'Goal Created Successfully');
    // }
    // function showGoals(){
    //     $goals = Goal::where('userID', auth()->user()->id)->get();
    //     return view('goals', ['goals' => $goals]);
    // }

    // function goalCreate(){
    //     return view('createGoal');
    // }

    // function goalEdit($id){
    //     $goal = Goal::findOrFail($id);
    //     return view('editGoal', ['goal' => $goal]);
    // }

    // function goalDelete($id){
    //     $goal = Goal::findOrFail($id);
    //     $goal->delete();
    //     return redirect(route('goal'))->with('success', 'Goal Deleted Successfully');
    // }


    // function createGoal(Request $request){
    //     $request->validate([
    //         'goalName' => 'required',
    //         'goalDeadline' => 'required|date'
    //     ]);
    //     $goal = new Goal();
    //     $goal->userID = auth()->user()->id;
    //     $goal->goalName = $request->input('goalName');
    //     $goal->deadline = $request->input('goalDeadline');
    //     $goal->completed = false;
    //     $goal->save();

    //     if(!$goal){
    //         return redirect(route('goal'))->with("error", "Creating Goal Failed. Please Try Again.");
    //     }
    //     return redirect(route('createGoal'));
        
    // }

    // function editGoal(Request $request, $id){
    //     $request->validate([
    //         'newGoalName' => 'required',
    //         'newGoalDeadline' => 'required|date'
    //     ]);
        
    //     $goal = Goal::find($id);
    //     $goal->goalName = $request->newGoalName;
    //     $goal->deadline = $request->newGoalDeadline;
    //     $goal->save();
        
    //     return redirect(route('goal'))->with('success', 'Goal Updated Successfully');
    // }
}
