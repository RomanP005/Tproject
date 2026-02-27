<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatusLog extends Model
{
    protected $fillable = [
        'task_id',
        'user_id',
        'old-status',
        'new-status',
        'created_at',
    ];
}
