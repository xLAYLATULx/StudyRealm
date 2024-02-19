<?php

namespace App\Livewire\TaskManager;

use App\Models\Task;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $userID, $categoryID, $taskName, $description, $priority, $dueDate, $progress = 0.00, $task_id, $completed; // Tasks Variables
    public $categoryName, $category_id; // Categories Variables
    public $showTasks = false;
    public $categoryTasks;
    public $filter = 'all';
    public $sortByAsc = true;
    public $sortByPriority = true;
    

    public function rules(){
        return [    
        'taskName' => 'required',
        'categoryID' => 'required',
        'priority' => 'required',
        'description' => 'required',
        'progress' => 'required|integer',
        'dueDate' => 'required|date',
        'categoryName' => 'required',

        ];
    }

    public function messages()
{
    return [
        'taskName.required' => 'Please enter a task name.',
        'categoryID.required' => 'Please select a project.',
        'priority.required' => 'Please select a priority level.',
        'description.required' => 'Please enter a task description.',
        'progress.required' => 'Please select progress for the task.',
        'progress.integer' => 'Progress should be an integer value.',
        'progress.between' => 'Progress should be between 0 and 100.',
        'dueDate.required' => 'Please select a due date.',
        'dueDate.date' => 'Due date should be a valid date.',
        'categoryName.required' => 'Please enter a category name.',
    ];
}

    

    public function storeCategory(){
        Category::create([
            'userID' => auth()->user()->id,
            'categoryName' => $this->categoryName,
        ]);
        session()->flash('success', 'Category Created Successfully');
        $this->dispatch('close-modal');
        $this->resetCategoryInputs();
    }

    public function editCategoryFields(int $category_id){
        $this->category_id = $category_id;
        $category = Category::findOrFail($category_id);
        $this->categoryName = $category->categoryName;
    }

    public function editCategory(){
        Category::findOrFail($this->category_id)->update([
            'userID' => auth()->user()->id,
            'categoryName' => $this->categoryName,
        ]);
        session()->flash('success', 'Category Updated Successfully');
        $this->dispatch('close-modal');
        $this->resetCategoryInputs();
    }

    public function deleteCategoryButton(int $category_id){
        $this->category_id = $category_id;
    }

    public function deleteCategory(){
        Category::findOrFail($this->category_id)->delete();
        session()->flash('success', 'Category Deleted Successfully');
        $this->dispatch('close-modal');
        $this->resetCategoryInputs();
    }

    public function ct($category_id){
        $this->categoryTasks = $category_id;
    }


    public function storeTask(){
        if($this->progress >= 100){
            $this->completed = true;
        }else{
            $this->completed = false;
        }
        Task::create([
            'userID' => auth()->user()->id,
            'categoryID' => $this->categoryID,
            'taskName' => $this->taskName,
            'description' => $this->description,
            'priority' => $this->priority,
            'dueDate' => $this->dueDate,
            'progress' => $this->progress,
            'completed' => $this->completed,
        ]);
        session()->flash('success', 'Task Created Successfully');
        $this->dispatch('close-modal');
        $this->resetTaskInputs();
    }

    public function editTaskFields(int $task_id){
        $this->task_id = $task_id;
        $task = Task::findOrFail($task_id);
        $this->categoryID = $task->categoryID;
        $this->taskName = $task->taskName;
        $this->description = $task->description;
        $this->priority = $task->priority;
        $this->progress = $task->progress;
        $this->dueDate = $task->dueDate;
    }
    

    public function editTask(){
        if($this->progress >= 100){
            $this->completed = true;
        }else{
            $this->completed = false;
        }
        Task::findOrFail($this->task_id)->update([
            'userID' => auth()->user()->id,
            'categoryID' => $this->categoryID,
            'taskName' => $this->taskName,
            'description' => $this->description,
            'priority' => $this->priority,
            'dueDate' => $this->dueDate,
            'progress' => $this->progress,
            'completed' => $this->completed,
        ]);
        session()->flash('success', 'Task Updated Successfully');
        $this->dispatch('close-modal');
        $this->resetTaskInputs();
    }

    public function deleteTaskButton(int $task_id){
        $this->task_id = $task_id;
    }

    public function deleteTask(){
        Task::findOrFail($this->task_id)->delete();
        session()->flash('success', 'Task Deleted Successfully');
        $this->dispatch('close-modal');
        $this->resetTaskInputs();
    }

    public function resetCategoryInputs(){
        $this->categoryName = NULL;
    }

    public function resetTaskInputs(){
        $this->categoryID = NULL;
        $this->taskName = NULL;
        $this->description = NULL;
        $this->priority = NULL;
        $this->dueDate = NULL;
        $this->progress = 0.00;
        $this->task_id = NULL;
    }

    public function closeModal(){
        $this->resetCategoryInputs();
        $this->resetTaskInputs();
    }

    public function openModal(){
        $this->resetCategoryInputs();
        $this->resetTaskInputs();
    }

    public function showAllTasksButton()
    {
        $this->filter = 'all';
    }

    public function showCompletedTasksButton()
    {
        $this->filter = 'completed';
    }

    public function showNotCompletedTasksButton()
    {
        $this->filter = 'notCompleted';
    }

    public function sortByDateButton()
    {
        $this->sortByAsc = !$this->sortByAsc;
    }

    public function sortByPriorityButton()
    {
        $this->sortByPriority = !$this->sortByPriority;
    }


    public function render()
    {
        $taskList = Task::where('userID', auth()->user()->id)->where('categoryID', $this->categoryTasks);

        if($this->filter == 'completed'){
            $taskList->where('completed', true);
        } else if($this->filter == 'notCompleted'){
            $taskList->where('completed', false);
        } else if($this->filter == 'all'){
            $taskList->where('completed', true)->orWhere('completed', false);
        }
        if($this->sortByAsc && $this->sortByPriority){
            $taskList->orderBy('dueDate', 'asc')->orderBy('priority', 'asc');
        } else if($this->sortByAsc && !$this->sortByPriority){
            $taskList->orderBy('dueDate', 'asc')->orderBy('priority', 'desc');
        } else if(!$this->sortByAsc && $this->sortByPriority){
            $taskList->orderBy('dueDate', 'desc')->orderBy('priority', 'asc');
        } else if(!$this->sortByAsc && !$this->sortByPriority){
            $taskList->orderBy('dueDate', 'desc')->orderBy('priority', 'desc');
        }

        $tasks = $taskList->paginate(3);
        $categories = Category::where('userID', auth()->user()->id)->get();

        return view('livewire.task-manager.index', compact('tasks', 'categories'))->extends('layouts.navbar')->section('content');
    }
}
