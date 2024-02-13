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
    public $userID, $categoryID, $taskName, $description, $priority, $dueDate, $progress, $task_id; // Tasks
    public $categoryName, $category_id; // Categories
    public $showTasks = false;
    public $categoryTasks;

    public function rules(){
        return [    
            'taskName' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'dueDate' => 'required|date',
            'progress' => 'required',
        ];
    }

    public function storeCategory(){
        Category::create([
            'userID' => auth()->user()->id,
            'categoryName' => $this->categoryName,
            'sortbyPriority' => false,
            'sortbyDueDate' => false,
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
        Category::findOrFail()->update([
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

    public function categoryTasks($category_id){
        $this->categoryTasks = $category_id;
    }


    public function storeTask(){
        Task::create([
            'userID' => auth()->user()->id,
            'categoryID' => $this->categoryID,
            'taskName' => $this->taskName,
            'description' => $this->description,
            'priority' => $this->priority,
            'dueDate' => $this->dueDate,
            'progress' => $this->progress,
            'completed' => false,
        ]);
        session()->flash('success', 'Task Created Successfully');
        $this->dispatch('close-modal');
        $this->resetTaskInputs();
    }

    public function editTaskFields(int $task_id){
        $this->task_id = $task_id;
        $task = Task::findOrFail($task_id);
        $this->taskName = $task->taskName;
        $this->description = $task->description;
        $this->priority = $task->priority;
        $this->progress = $task->progress;
        $this->dueDate = $task->dueDate;
    }
    

    public function editTask(){
        Task::findOrFail($this->task_id)->update([
            'userID' => auth()->user()->id,
            'categoryID' => $this->categoryID,
            'taskName' => $this->taskName,
            'description' => $this->description,
            'priority' => $this->priority,
            'dueDate' => $this->dueDate,
            'progress' => $this->progress,
            'completed' => false,
        ]);
        session()->flash('success', 'Task Updated Successfully');
        $this->dispatch('close-modal');
        $this->resetTask();
    }

    public function completedTask($taskId)
    {
        
        $t = Task::find($taskId);
        if ($t->completed == true) {
            $t->update(['completed' => false]);
            session()->flash('success', 'Task Marked As Incomplete');
        } elseif ($t->completed == false) {
            $t->update(['completed' => true]);
            session()->flash('success', 'Task Marked As Complete');
        }
        $this->resetTaskInputs();
        return redirect()->to('/tasks');
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
        $this->progress = NULL;
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

    public function showTasksButton()
    {
        $this->showTasks = !$this->showTasks;
    }


    public function render()
    {
        $taskList = Task::where('userID', auth()->user()->id)->where('categoryID', $this->categoryTasks);

        if ($this->showTasks) {
            $taskList->where('completed', true);
        } else {
            $taskList->where('completed', false);
        }

        $tasks = $taskList->orderBy('dueDate', 'desc')->orderBy('priority', 'desc')->paginate(3);
        $categories = Category::where('userID', auth()->user()->id)->get();

        return view('livewire.task-manager.index', compact('tasks', 'categories'))->extends('layouts.navbar')->section('content');
    }
}
