<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_all_tasks()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson('/api/v1/tasks');

        $response->assertStatus(200);
    }

  
   /** @test */
// public function it_can_get_a_specific_task()
// {
//     $user = User::factory()->create();
//     $task = Task::factory()->create(['user_id' => $user->id]);
//     $this->actingAs($user);

//     $response = $this->getJson("/api/v1/tasks/{$task->id}");

//     // Assert that the response status is 200 (OK)
//     $response->assertStatus(Response::HTTP_OK)
//         ->assertJsonStructure([
//             'data' => [
//                 'id',
//                 'title',
//                 'description',
//                 'user_id',
//                 'status',
//                 'created_at',
//                 'updated_at',
//             ],
//         ]);

//     // Additional assertions based on the specific data of the retrieved task
//     $response->assertJson([
//         'data' => [
//             'id' => $task->id,
//             'title' => $task->title,
//             'description' => $task->description,
//             'user_id' => $task->user_id,
//             'status' => $task->status,
//             'created_at' => $task->created_at->toISOString(),
//             'updated_at' => $task->updated_at->toISOString(),
//         ],
//     ]);
// }


 /** @test */
public function it_can_update_a_task()
{
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id]);
    $this->actingAs($user);

    $invalidTaskUpdateData = [
        'title' => '', // Missing required 'title'
        'description' => 'Updated Description',
        'user_id' => $user->id,
        'status' => 'updated',
    ];

    $response = $this->putJson("/api/v1/tasks/{$task->id}", $invalidTaskUpdateData);

    // Assert that the response status is 422 (Unprocessable Entity)
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

  
}


 
  /** @test */
public function it_can_create_a_task()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $invalidTaskData = [
       
        'description' => 'Task Description',
        'user_id' => $user->id,
        'status' => 'pending',
    ];

    $response = $this->postJson('/api/v1/tasks', $invalidTaskData);
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    $response->assertJsonValidationErrors(['title']);
}


    /** @test */
    public function it_can_delete_a_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->deleteJson("/api/v1/tasks/{$task->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
