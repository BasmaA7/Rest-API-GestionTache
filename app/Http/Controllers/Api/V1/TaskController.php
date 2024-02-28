<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\V1\StoreTaskRequest;
use App\Http\Requests\V1\UpdateTaskRequest;
use App\Http\Resources\V1\TaskCollection;
use App\Http\Resources\V1\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class TaskController extends Controller
{
      /**
     * Display a listing of the resource.
     */
       /**
     * @OA\Get(
     *     path="/api/v1/tasks",
     *     summary="Get all tasks",
     *     @OA\Response(response="200", description="List of tasks"),
     * )
     */
    public function index()
    {
        // return Task::all();
        return new TaskCollection(Task::all());
    }


       /**
     * Display the specified resource.
     */
       /**
     * @OA\Get(
     *     path="/api/v1/tasks/{id}",
     *     summary="Get a specific task",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Task found"),
     *     @OA\Response(response="404", description="Task not found")
     * )
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

     /**
     * @OA\Put(
     *     path="/api/v1/tasks/{id}",
     *     summary="Update a specific task",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Task title",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Task description",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Task status",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Task updated"),
     *     @OA\Response(response="404", description="Task not found")
     * )
     */
    public function update(UpdateTaskRequest $request,Task $task){
        $this->authorize('manage', $task);
        $task->update($request->all());
        return response()->json(['message' => 'Task Updated successfully'], 200);

    }

  /**
     * Store a newly created resource in storage.
     */
      /**
     * @OA\Post(
     *     path="/api/v1/tasks",
     *     summary="Create a new task",
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Task name", 
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Task description", 
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="user_id", 
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status", 
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Task created"),
     * )
     */
    public function store(StoreTaskRequest $request){
        
        return new TaskResource(Task::create($request->all()) );

    }
      /**
     * @OA\Delete(
     *     path="/api/v1/tasks/{id}",
     *     summary="Delete a specific task",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Task deleted"),
     *     @OA\Response(response="404", description="Task not found")
     * )
     */
 
    public function destroy(Task $task)
{
    $this->authorize('manage', $task);

    $task->delete();

    return response()->json(['message' => 'Task deleted successfully'], 200);
}
}
