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
        'user_id',
    ];

    protected function casts()
    {
        return [
          'deadline' => 'datetime',
        ];
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function taskstatuslogs()
    {
        return $this->hasMany(TaskStatusLog::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function setStatusAttribute($value)
    {
        $allowedTransitions = [
            'new' => ['job'], 'job' => ['success'], 'success' => [],
        ];
        $old = $this->status ?? 'new';
        if ($old !== $value && !in_array($value, $allowedTransitions[$old] ?? [])) {
            throw new \Exception("Invalid status transition from {$old} to {$value}");
        }
        $this->attributes['status'] = $value;
    }
}
