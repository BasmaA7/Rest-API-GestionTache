<?php

namespace Tests\Feature\Api;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    use RefreshDatabase; 

    public function testCanGetAllTasks()
    {
        $user = User::factory()->create();
        $tasks = Task::factory(5)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'api')->get('/api/v1/tasks');

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }
}
