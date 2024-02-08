<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function tasks(){
        return view('taskmanager');
    }

    function taskCreate(){
        return view('createTask');
    }

    function taskEdit($id){
        $task = Task::findOrFail($id);
        return view('editTask', ['task' => $task]);
    }

    function categoryCreate(){
        return view('createCategory');
    }

    function categoryEdit($id){
        $category = Category::findOrFail($id);
        return view('editCategory', ['category' => $category]);
    }

    function createTask(Request $request){
        $request->validate([
            'taskName' => 'required',
            'progress' => 'required',
            'priority' => 'required',
            'taskDeadline' => 'required|date'
        ]);
        $task = new Task();
        $task->userID = auth()->user()->id;
        $task->categoryID = $request->input('categoryID');
        $task->taskName = $request->input('taskName');
        $task->progress = $request->input('progress');
        $task->priority = $request->input('priority');
        $task->deadline = $request->input('taskDeadline');
        $task->completed = false;
        $task->save();

        if(!$task){
            return redirect(route('tasks'))->with("error", "Creating Task Failed. Please Try Again.");
        }
        return redirect(route('tasks'));
        
    }

    function editTask(Request $request, $id){
        $request->validate([
            'newTaskName' => 'required',
            'newProgress' => 'required',
            'newPriority' => 'required',
            'newTaskDeadline' => 'required|date'
        ]);
        
        $task = Task::find($id);
        $task->taskName = $request->newTaskName;
        $task->progress = $request->newProgress;
        $task->priority = $request->newPriority;
        $task->deadline = $request->newTaskDeadline;
        $task->save();
        
        return redirect(route('tasks'))->with('success', 'Task Updated Successfully');
    }

    function createCategory(Request $request){
        $request->validate([
            'categoryName' => 'required',
        ]);
        $category = new Category();
        $category->userID = auth()->user()->id;
        $category->categoryName = $request->input('categoryName');
        $category->sortbyPriority = false;
        $category->sortbyDueDate = false;
        $category->save();

        if(!$category){
            return redirect(route('tasks'))->with("error", "Creating Category Failed. Please Try Again.");
        }
        return redirect(route('tasks'));

    }

    function editCategory(Request $request, $id){
        $request->validate([
            'newCategoryName' => 'required',
            'newSortbyPriority' => 'required',
            'newSortbyDueDate' => 'required',
            'newDueDate' => 'required|date',
        ]);
        
        $category = Category::find($id);
        $category->categoryName = $request->newCategoryName;
        $category->sortbyPriority = $request->newSortbyPriority;
        $category->sortbyDueDate = $request->newSortbyDueDate;
        $category->dueDate = $request->newDueDate;
        $category->save();
        
        return redirect(route('tasks'))->with('success', 'Category Updated Successfully');
    }

    function deleteCategory(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect(route('tasks'))->with('success', 'Category Deleted Successfully');
    }
}
