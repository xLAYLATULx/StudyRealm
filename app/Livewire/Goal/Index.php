<?php

namespace App\Livewire\Goal;

use App\Models\Goal;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $goalName, $description, $deadline, $goal_id;
    public $showGoals = false;

    public function rules(){
        return [
            'goalName' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
        ];
    }

    public function storeGoal(){
        Goal::create([
            'userID' => auth()->user()->id,
            'goalName' => $this->goalName,
            'description' => $this->description,
            'progress' => 0.00,
            'deadline' => $this->deadline,
            'completed' => false,
        ]);
        session()->flash('success', 'Goal Created Successfully');
        $this->dispatch('close-modal');
        $this->resetInputs();
    }

    public function editGoalFields(int $goal_id){
        $this->goal_id = $goal_id;
        $goal = Goal::findOrFail($goal_id);
        $this->goalName = $goal->goalName;
        $this->description = $goal->description;
        $this->deadline = $goal->deadline;
    }

    public function editGoal(){
        Goal::findOrFail($this->goal_id)->update([
            'userID' => auth()->user()->id,
            'goalName' => $this->goalName,
            'description' => $this->description,
            'progress' => 0.00,
            'deadline' => $this->deadline,
            'completed' => false,
        ]);
        session()->flash('success', 'Goal Updated Successfully');
        $this->dispatch('close-modal');
        $this->resetInputs();
    }

    public function completedGoal($goalId)
    {
        
        $g = Goal::find($goalId);
        if ($g->completed == true) {
            $g->update(['completed' => false]);
            session()->flash('success', 'Goal Marked As Incomplete');
        } elseif ($g->completed == false) {
            $g->update(['completed' => true]);
            session()->flash('success', 'Goal Marked As Complete');
        }
        $this->resetInputs();
        return redirect()->to('/goals');
    }

    public function deleteGoalButton(int $goal_id){
        $this->goal_id = $goal_id;
    }

    public function deleteGoal(){
        Goal::findOrFail($this->goal_id)->delete();
        session()->flash('success', 'Goal Deleted Successfully');
        $this->dispatch('close-modal');
        $this->resetInputs();
    }

    public function resetInputs(){
        $this->goalName = NULL;
        $this->description = NULL;
        $this->deadline = NULL;
        $this->goal_id = NULL;
    }

    public function closeModal(){
        $this->resetInputs();
    }

    public function openModal(){
        $this->resetInputs();
    }

    public function showGoalsButton()
    {
        $this->showGoals = !$this->showGoals;
    }

    public function render()
    {
        $goalList = Goal::where('userID', auth()->user()->id);

        if ($this->showGoals) {
            $goalList->where('completed', true);
        } else {
            $goalList->where('completed', false);
        }
        
        $goals = $goalList->orderBy('deadline', 'asc')->paginate(3);

        return view('livewire.goal.index', ['goals' => $goals])->extends('layouts.navbar')->section('content');
    }

}
