<?php

namespace App\Livewire\Goal;

use App\Models\Goal;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $goalName, $description, $deadline;

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
        $this->resetInputs();
    }

    public function resetInputs(){
        $this->goalName = NULL;
        $this->description = NULL;
        $this->deadline = NULL;
    }

    public function render()
    {
        $goals = Goal::where('userID', auth()->user()->id)->orderBy('deadline', 'desc')->paginate(10);
        return view('livewire.goal.index', ['goals' => $goals])->extends('layouts.navbar')->section('content');
    }
}
