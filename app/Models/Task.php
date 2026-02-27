<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'deadline',
        'project_id',
        'assignee_id',
        'deleted_at',
    ];

    protected function casts()
    {
        return [
          'deadline' => 'datetime',
        ];
    }
}
