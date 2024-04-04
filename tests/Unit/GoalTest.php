<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Goal;
use App\Models\User;

class GoalTest extends TestCase
{
    use RefreshDatabase;

    /** Model */
    public function testCreateGoal()
{
    $user = User::factory()->create();
    $testData = [
        'userID' => $user->id,
        'goalName' => 'Test Goal',
        'description' => 'Test Description',
        'progress' => 0,
        'startDate' => '2024-08-01',
        'deadline' => '2024-08-31',
        'completed' => 0,
    ];
    $goal = Goal::create($testData);
    $this->assertInstanceOf(Goal::class, $goal);
    $this->assertEquals($testData['userID'], $goal->userID);
    $this->assertEquals($testData['goalName'], $goal->goalName);
    $this->assertEquals($testData['description'], $goal->description);
    $this->assertEquals($testData['progress'], $goal->progress);
    $this->assertEquals($testData['startDate'], $goal->startDate);
    $this->assertEquals($testData['deadline'], $goal->deadline);
    $this->assertEquals($testData['completed'], $goal->completed);
}


     public function testGetGoals()
     {
        $user = User::factory()->create();
        Goal::create([
            'userID' => $user->id,
            'goalName' => 'Test Goal 1',
            'description' => 'Test Description',
            'progress' => 0,
            'startDate' => '2024-08-01',
            'deadline' => '2024-08-31',
            'completed' => 0,
        ]);
        Goal::create([
            'userID' => $user->id,
            'goalName' => 'Test Goal 2',
            'description' => 'Test Description',
            'progress' => 0,
            'startDate' => '2024-08-01',
            'deadline' => '2024-08-31',
            'completed' => 0,
        ]);
         $goals = Goal::all();
         $this->assertCount(2, $goals);
     }

      /** Controller */
      public function testEditGoal(){
        $user = User::factory()->create();
        $goal = Goal::factory()->create(['userID' => $user->id, 'goalName' => 'Test Goal 1', 'description' => 'Test Description', 'progress' => 0, 'startDate' => '2024-08-01', 'deadline' => '2024-08-31', 'completed' => 0,]);
        $goalID = Goal::find($goal->id);
        $goalID->update(['goalName' => 'Test Goal 2']);
        $goal = Goal::find($goal->id);
        $this->assertEquals('Test Goal 2', $goal->goalName);
    }

    public function testDeleteGoal(){
        $user = User::factory()->create();
        $goal = Goal::factory()->create(['userID' => $user->id, 'goalName' => 'Test Goal 1', 'description' => 'Test Description', 'progress' => 0, 'startDate' => '2024-08-01', 'deadline' => '2024-08-31', 'completed' => 0,]);
        $goalID = Goal::find($goal->id);
        $goalID->delete();
        $goal = Goal::find($goal->id);
        $this->assertNull($goal);
    }

    public function testGetGoal(){
        $user = User::factory()->create();
        $goal = Goal::factory()->create(['userID' => $user->id, 'goalName' => 'Test Goal 1', 'description' => 'Test Description', 'progress' => 0, 'startDate' => '2024-08-01', 'deadline' => '2024-08-31', 'completed' => 0,]);
        $goalID = Goal::find($goal->id);
        $this->assertEquals('Test Goal 1', $goalID->goalName);
    }
}