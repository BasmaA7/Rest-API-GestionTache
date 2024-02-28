<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function manage(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
