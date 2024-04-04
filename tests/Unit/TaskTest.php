<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;

class TaskTest extends TestCase
{

    /** Model */
    public function testCreateTask()
{
    $user = User::factory()->create();
    $category = Category::factory()->create(['userID' => $user->id, 'categoryName' => 'Category 1']);
    $testData = [
        'userID' => $user->id,
        'categoryID' => $category->id,
        'taskName' => 'Test Task',
        'description' => 'Test Description',
        'priority' => 'low',
        'startDate' => '2024-09-01',
        'dueDate' => '2024-09-30',
        'progress' => 0,
        'completed' => 0,
        'goalID' => NULL,
    ];
    $task = Task::create($testData);
    $this->assertInstanceOf(Task::class, $task);
    $this->assertEquals($testData['userID'], $task->userID);
    $this->assertEquals($testData['categoryID'], $task->categoryID);
    $this->assertEquals($testData['taskName'], $task->taskName);
    $this->assertEquals($testData['description'], $task->description);
    $this->assertEquals($testData['priority'], $task->priority);
    $this->assertEquals($testData['startDate'], $task->startDate);
    $this->assertEquals($testData['dueDate'], $task->dueDate);
    $this->assertEquals($testData['progress'], $task->progress);
    $this->assertEquals($testData['completed'], $task->completed);
    $this->assertEquals($testData['goalID'], $task->goalID);
    $task->delete();
    $user->delete();
    $category->delete();
}


     public function testGetTasks()
     {
        $user = User::factory()->create();
        $category = Category::factory()->create(['userID' => $user->id, 'categoryName' => 'Category 1']);
        Task::create([
            'userID' => $user->id,
            'categoryID' => $category->id,
            'taskName' => 'Test Task 1',
            'description' => 'Test Description',
            'priority' => 'low',
            'startDate' => '2024-09-01',
            'dueDate' => '2024-09-30',
            'progress' => 0,
            'completed' => 0,
            'goalID' => NULL,
        ]);
        Task::create([
            'userID' => $user->id,
            'categoryID' => $category->id,
            'taskName' => 'Test Task 2',
            'description' => 'Test Description',
            'priority' => 'low',
            'startDate' => '2024-09-01',
            'dueDate' => '2024-09-30',
            'progress' => 0,
            'completed' => 0,
            'goalID' => NULL,
        ]);
         $tasks = Task::all();
         $this->assertCount(2, $tasks);
         $tasks->each->delete();
         $user->delete();
         $category->delete();
     }

      /** Controller */
      public function testEditTask(){
        $user = User::factory()->create();
        $category = Category::factory()->create(['userID' => $user->id, 'categoryName' => 'Category 1']);
        $task = Task::factory()->create(['userID' => $user->id, 'categoryID' => $category->id, 'taskName' => 'Test Task 1', 'description' => 'Test Description', 'priority' => 'low', 'startDate' => '2024-09-01', 'dueDate' => '2024-09-30', 'progress' => 0, 'completed' => 0, 'goalID' => NULL,]);
        $taskID = Task::find($task->id);
        $taskID->update(['taskName' => 'Test Task 2']);
        $task = Task::find($task->id);
        $this->assertEquals('Test Task 2', $task->taskName);
        $task->delete();
        $user->delete();
        $category->delete();
    }

    public function testDeleteTask(){
        $user = User::factory()->create();
        $category = Category::factory()->create(['userID' => $user->id, 'categoryName' => 'Category 1']);
        $task = Task::factory()->create(['userID' => $user->id, 'categoryID' => $category->id, 'taskName' => 'Test Task 1', 'description' => 'Test Description', 'priority' => 'low', 'startDate' => '2024-09-01', 'dueDate' => '2024-09-30', 'progress' => 0, 'completed' => 0, 'goalID' => NULL,]);
        $taskID = Task::find($task->id);
        $taskID->delete();
        $task = Task::find($task->id);
        $this->assertNull($task);
        $user->delete();
        $category->delete();
    }

    public function testGetTask(){
        $user = User::factory()->create();
        $category = Category::factory()->create(['userID' => $user->id, 'categoryName' => 'Category 1']);
        $task = Task::factory()->create(['userID' => $user->id, 'categoryID' => $category->id, 'taskName' => 'Test Task 1', 'description' => 'Test Description', 'priority' => 'low', 'startDate' => '2024-09-01', 'dueDate' => '2024-09-30', 'progress' => 0, 'completed' => 0, 'goalID' => NULL,]);
        $taskID = Task::find($task->id);
        $this->assertEquals('Test Task 1', $taskID->taskName);
        $task->delete();
        $user->delete();
        $category->delete();
    }
}