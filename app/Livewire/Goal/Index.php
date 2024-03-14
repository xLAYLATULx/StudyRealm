<?php

namespace App\Livewire\Goal;

use App\Models\Goal;
use App\Models\Schedule;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $goalName, $description, $progress = 0.00, $startDate, $deadline, $goal_id, $completed;
    public $filter = 'all';
    public $sortByAsc = true;
    public $goalHasTasks = false;

    public function rules()
    {
        return [
            'goalName' => 'required|unique:goal',
            'description' => 'required',
            'progress' => 'required',
            'startDate' => 'required|date',
            'deadline' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'goalName.required' => 'Please enter a goal name.',
            'goalName.unique' => 'This goal name already exists. Please enter a different goal name.',
            'description.required' => 'Please enter a description.',
            'progress.required' => 'Please enter a progress.',
            'startDate.required' => 'Please enter a start date.',
            'startDate.date' => 'Please enter a valid date for the start date.',
            'deadline.required' => 'Please enter a deadline.',
            'deadline.date' => 'Please enter a valid date for the deadline.',
        ];
    }

    public function storeGoal()
    {
        $this->validate();
        if ($this->progress >= 100) {
            $this->completed = true;
        } else {
            $this->completed = false;
        }
        Goal::create([
            'userID' => auth()->user()->id,
            'goalName' => $this->goalName,
            'description' => $this->description,
            'progress' => $this->progress,
            'startDate' => $this->startDate,
            'deadline' => $this->deadline,
            'completed' => $this->completed,
        ]);
        Schedule::create([
            'userID' => auth()->user()->id,
            'title' => $this->goalName,
            'description' => $this->description,
            'startDate' => $this->startDate,
            'endDate' => $this->deadline,
            'isGoal' => true,
            'isTask' => false,
        ]);
        session()->flash('success', 'Goal Created Successfully');
        $this->dispatch('close-modal');
        $this->resetInputs();
    }

    public function editGoalFields(int $goal_id)
    {
        $this->goal_id = $goal_id;
        $goal = Goal::findOrFail($goal_id);
        $goalTasks = Task::where('goalID', $this->goal_id)->get();
        if(count($goalTasks) > 0) {
            $this->goalHasTasks = true;
        }else{
            $this->goalHasTasks = false;
        }
        $this->goalName = $goal->goalName;
        $this->description = $goal->description;
        $this->progress = $goal->progress;
        $this->startDate = $goal->startDate;
        $this->deadline = $goal->deadline;

    }

    public function editGoal()
    {
        $editEvent = Goal::findOrFail($this->goal_id);
        $editEventName = $editEvent->goalName;
        if ($this->progress >= 100) {
            $this->completed = true;
        } else {
            $this->completed = false;
        }

        Goal::findOrFail($this->goal_id)->update([
            'userID' => auth()->user()->id,
            'goalName' => $this->goalName,
            'description' => $this->description,
            'progress' => $this->progress,
            'startDate' => $this->startDate,
            'deadline' => $this->deadline,
            'completed' => $this->completed,
            'isGoal' => true,
            'isTask' => false,
        ]);
        Schedule::where('title', $editEventName)->update([
            'userID' => auth()->user()->id,
            'title' => $this->goalName,
            'description' => $this->description,
            'startDate' => $this->startDate,
            'endDate' => $this->deadline,
            'isGoal' => '0',
            'isTask' => '0',
        ]);
        session()->flash('success', 'Goal Updated Successfully');
        $this->dispatch('close-modal');
        $this->resetInputs();
    }

    public function deleteGoalButton(int $goal_id)
    {
        $this->goal_id = $goal_id;
    }

    public function deleteGoal()
    {
        $deleteEvent = Goal::findOrFail($this->goal_id);
        $deleteEventName = $deleteEvent->goalName;
        Goal::findOrFail($this->goal_id)->delete();
        Schedule::where('title', $deleteEventName)->delete();
        $this->dispatch('close-modal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->goalName = NULL;
        $this->description = NULL;
        $this->progress = 0.00;
        $this->startDate = NULL;
        $this->deadline = NULL;
        $this->goal_id = NULL;
    }

    public function closeModal()
    {
        $this->resetInputs();
    }

    public function openModal()
    {
        $this->resetInputs();
    }

    public function showAllGoalsButton()
    {
        $this->filter = 'all';
    }

    public function showCompletedGoalsButton()
    {
        $this->filter = 'completed';
    }

    public function showNotCompletedGoalsButton()
    {
        $this->filter = 'notCompleted';
    }

    public function sortByAscButton()
    {
        $this->sortByAsc = !$this->sortByAsc;
    }

    public function render()
    {
        $goalList = Goal::where('userID', auth()->user()->id);
        $gs = $goalList->get();
        foreach ($gs as $goal) {
            if($goal->tasks->count() > 0){
                $totalProgress = $goal->tasks->sum('progress');
                $totalTasks = $goal->tasks->count();
                $goal->overallProgress = $totalTasks > 0 ? ($totalProgress / $totalTasks) : 0;
                $goal->progress = $goal->overallProgress;
            }else{
                $goal->overallProgress = $goal->progress;
            }
            if($goal->progress == 100){
                Goal::findOrFail($goal->id)->update([
                    'progress' => $goal->overallProgress,
                    'completed' => true,
                ]);
            }else{
                Goal::findOrFail($goal->id)->update([
                    'progress' => $goal->overallProgress,
                    'completed' => false,
                ]);
            }
        }
        

        if ($this->filter == 'completed') {
            $goalList->where('completed', true);
        } elseif ($this->filter == 'notCompleted') {
            $goalList->where('completed', false);
        } elseif ($this->filter == 'all') {
            $goalList->where('completed', true)->orWhere('completed', false);
        }
        if ($this->sortByAsc) {
            $goalList->orderBy('deadline', 'asc');
        } else {
            $goalList->orderBy('deadline', 'desc');
        }

        $goals = $goalList->paginate(5);


        return view('livewire.goal.index', ['goals' => $goals])->extends('layouts.navbar')->section('content');
    }


}
