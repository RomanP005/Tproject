<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\TaskStatusLog;
use App\Notifications\TaskAssignedNotification;
use Illuminate\Support\Facades\Auth;

class TaskObserver
{
    public function created(Task $task): void
    {

        if ($task->assignee_id) {
            $task->assignee->notify(new TaskAssignedNotification($task));
        }
    }

    public function updated(Task $task): void
    {
        if ($task->isDirty('status')) {
            TaskStatusLog::create([
                'task_id'    => $task->id,
                'user_id'    => Auth::id(),
                'old_status' => $task->getOriginal('status'),
                'new_status' => $task->status->value,
            ]);
        }
        $task->assignee->notify(new TaskAssignedNotification($task));
    }

}
