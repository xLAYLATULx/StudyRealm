<?php
 
namespace Tests\Feature;
 
use Tests\TestCase;
use App\Models\Schedule;
use App\Models\User;
 
class ScheduleTest extends TestCase
{

    /* Models */
    public function testCreateSchedule()
    {
        $user = User::factory()->create();
        $testData = [
            'userID' => $user->id,
            'title' => 'Test Schedule',
            'description' => 'Test Description',
            'startDate' => '2024-08-01',
            'endDate' => '2024-08-31',
            'isGoal' => 0,
            'isTask' => 0,
        ];
        $schedule = Schedule::create($testData);
        $this->assertInstanceOf(Schedule::class, $schedule);
        $this->assertEquals($testData['userID'], $schedule->userID);
        $this->assertEquals($testData['title'], $schedule->title);
        $this->assertEquals($testData['description'], $schedule->description);
        $this->assertEquals($testData['startDate'], $schedule->startDate);
        $this->assertEquals($testData['endDate'], $schedule->endDate);
        $this->assertEquals($testData['isGoal'], $schedule->isGoal);
        $this->assertEquals($testData['isTask'], $schedule->isTask);
        $schedule->delete();
        $user->delete();
    }

    public function testGetSchedules()
    {
        $user = User::factory()->create();
        Schedule::create([
            'userID' => $user->id,
            'title' => 'Test Schedule 1',
            'description' => 'Test Description 1',
            'startDate' => '2024-08-01',
            'endDate' => '2024-08-31',
            'isGoal' => 0,
            'isTask' => 0,
        ]);
        Schedule::create([
            'userID' => $user->id,
            'title' => 'Test Schedule 2',
            'description' => 'Test Description 2',
            'startDate' => '2024-08-01',
            'endDate' => '2024-08-31',
            'isGoal' => 0,
            'isTask' => 0,
        ]);
        $schedules = Schedule::all();
        $this->assertCount(2, $schedules);
        $schedules->each->delete();
        $user->delete();
    }

    /* Controllers */
    public function testEditSchedule(){
        $user = User::factory()->create();
        $schedule = Schedule::factory()->create(['userID' => $user->id, 'title' => 'Test Schedule 1', 'description' => 'Test Description 1', 'startDate' => '2024-08-01', 'endDate' => '2024-08-31', 'isGoal' => 0, 'isTask' => 0,]);
        $scheduleID = Schedule::find($schedule->id);
        $scheduleID->update(['title' => 'Test Schedule 2']);
        $schedule = Schedule::find($schedule->id);
        $this->assertEquals('Test Schedule 2', $schedule->title);
        $schedule->delete();
        $user->delete();
    }

    public function testDeleteSchedule(){
        $user = User::factory()->create();
        $schedule = Schedule::factory()->create(['userID' => $user->id, 'title' => 'Test Schedule 1', 'description' => 'Test Description 1', 'startDate' => '2024-08-01', 'endDate' => '2024-08-31', 'isGoal' => 0, 'isTask' => 0,]);
        $scheduleID = Schedule::find($schedule->id);
        $scheduleID->delete();
        $schedule = Schedule::find($schedule->id);
        $this->assertNull($schedule);
        $user->delete();
    }

    public function testGetSchedule(){
        $user = User::factory()->create();
        $schedule = Schedule::factory()->create(['userID' => $user->id, 'title' => 'Test Schedule 1', 'description' => 'Test Description 1', 'startDate' => '2024-08-01', 'endDate' => '2024-08-31', 'isGoal' => 0, 'isTask' => 0,]);
        $scheduleID = Schedule::find($schedule->id);
        $this->assertEquals('Test Schedule 1', $scheduleID->title);
        $user->delete();
        $schedule->delete();
    }
}