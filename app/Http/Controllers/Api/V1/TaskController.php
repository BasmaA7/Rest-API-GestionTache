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
    public function index()
    {
        // return Task::all();
        return new TaskCollection(Task::all());
    }


    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request,Task $task){
        $task->update($request->all());
        return response()->json(['message' => 'Task Updated successfully'], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function store(StoreTaskRequest $request){
        
        return new TaskResource(Task::create($request->all()) );

    }
 
    public function destroy(Task $task)
{
    $task->delete();

    return response()->json(['message' => 'Task deleted successfully'], 200);
}
}
