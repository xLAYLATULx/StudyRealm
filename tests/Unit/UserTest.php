<?php
 
namespace Tests\Feature;
 
use Tests\TestCase;
use App\Models\User;
 
class UserTest extends TestCase
{
    /* Models */
    public function testCreateUser()
    {
        $testData = [
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => 'password',
        ];
        $user = User::create($testData);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($testData['name'], $user->name);
        $this->assertEquals($testData['email'], $user->email);
        $user->delete();
    }

    public function testGetUsers()
    {
        User::factory()->create([
            'name' => 'Test User 1',
            'email' => 'user1@test.com',
            'password' => 'password1',
        ]);
        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'user2@test.com',
            'password' => 'password2',
        ]);
        $user1 = User::where('name', 'Test User 1')->get();
        $user2 = User::where('name', 'Test User 2')->get();
        $user1ID = $user1->first();
        $user2ID = $user2->first();
        $this->assertEquals('Test User 1', $user1ID->name);
        $this->assertEquals('Test User 2', $user2ID->name);
        $user1ID->delete();
        $user2ID->delete();
    }

    /* Controllers */
    public function testEditUser(){
        $user = User::factory()->create(['name' => 'Test User 1', 'email' => 'user1@test.com', 'password' => 'password1',]);
        $userID = User::find($user->id);
        $userID->update(['name' => 'Test User 2']);
        $user = User::find($user->id);
        $this->assertEquals('Test User 2', $user->name);
        $user->delete();
    }

    public function testDeleteUser(){
        $user = User::factory()->create(['name' => 'Test User 1', 'email' => 'user1@test.com', 'password' => 'password1',]);
        $userID = User::find($user->id);
        $userID->delete();
        $user = User::find($user->id);
        $this->assertNull($user);
    }

    public function testGetUser(){
        $user = User::factory()->create(['name' => 'Test User 1', 'email' => 'user1@test.com', 'password' => 'password1',]);
        $userID = User::find($user->id);
        $this->assertEquals('Test User 1', $userID->name);
        $user->delete();
    }
}