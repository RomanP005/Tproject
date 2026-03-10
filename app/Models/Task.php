<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'deadline',
        'project_id',
        'user_id',
        'assignee_id'
    ];

    protected function casts()
    {
        return [
          'deadline' => 'datetime',
            'status' => StatusEnum::class,
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
    public function setStatusAttribute($value)
    {
        if ($value instanceof \App\Enums\StatusEnum) {
            $newStatus = $value->value;
        } else {
            $newStatus = $value;
        }

        $oldStatus = $this->status ? $this->status->value : 'Новый';

        $allowedTransitions = [
            'Новый'     => ['В работе'],
            'В работе'  => ['Выполнена'],
            'Выполнена' => [],
        ];

        if ($oldStatus !== $newStatus && !in_array($newStatus, $allowedTransitions[$oldStatus] ?? [])) {
            throw new \InvalidArgumentException("Недопустимый переход статуса: из {$oldStatus} в {$newStatus}");
        }

        $this->attributes['status'] = $newStatus;
    }
}
