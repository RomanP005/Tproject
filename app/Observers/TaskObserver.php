<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\TaskStatusLog;
use Illuminate\Support\Facades\Auth;

class TaskObserver
{
    public function created(Task $task): void
    {
        //
    }

    public function updated(Task $task): void
    {
        if($task->isDirty('status'))
        {
            TaskStatusLog::create([
               'task_id' => $task->id,
               'user_id' => Auth::id(),
               'old_status' => $task->getOriginal('status'),
               'new_status' => $task->status,
            ]);
        }
    }

    public function deleted(Task $task): void
    {
        //
    }

    public function restored(Task $task): void
    {
        //
    }

    public function forceDeleted(Task $task): void
    {
        //
    }
}
