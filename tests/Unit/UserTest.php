<?php
 
namespace Tests\Feature;
 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
 
class UserTest extends TestCase
{
    // use RefreshDatabase;

    // /* Models */
    // public function testCreateUser()
    // {
    //     $testData = [
    //         'name' => 'Test User',
    //         'email' => 'user@test.com',
    //         'password' => 'password',
    //     ];
    //     $user = User::create($testData);
    //     $this->assertInstanceOf(User::class, $user);
    //     $this->assertEquals($testData['name'], $user->name);
    //     $this->assertEquals($testData['email'], $user->email);
    // }

    // public function testGetUsers()
    // {
    //     User::factory()->create([
    //         'name' => 'Test User 1',
    //         'email' => 'user1@test.com',
    //         'password' => 'password1',
    //     ]);
    //     User::factory()->create([
    //         'name' => 'Test User 2',
    //         'email' => 'user2@test.com',
    //         'password' => 'password2',
    //     ]);
    //     $users = User::all();
    //     $this->assertCount(2, $users);
    // }

    // /* Controllers */
    // public function testEditUser(){
    //     $user = User::factory()->create(['name' => 'Test User 1', 'email' => 'user1@test.com', 'password' => 'password1',]);
    //     $userID = User::find($user->id);
    //     $userID->update(['name' => 'Test User 2']);
    //     $user = User::find($user->id);
    //     $this->assertEquals('Test User 2', $user->name);
    // }

    // public function testDeleteUser(){
    //     $user = User::factory()->create(['name' => 'Test User 1', 'email' => 'user1@test.com', 'password' => 'password1',]);
    //     $userID = User::find($user->id);
    //     $userID->delete();
    //     $user = User::find($user->id);
    //     $this->assertNull($user);
    // }

    // public function testGetCategory(){
    //     $user = User::factory()->create(['name' => 'Test User 1', 'email' => 'user1@test.com', 'password' => 'password1',]);
    //     $userID = User::find($user->id);
    //     $this->assertEquals('Test User 1', $userID->name);
    // }
}