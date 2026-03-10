<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatusLog extends Model
{
    protected $fillable = [
        'task_id',
        'user_id',
        'old_status',
        'new_status',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
