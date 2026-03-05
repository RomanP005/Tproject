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
//    public function setStatusAttribute($value)
//    {
//        $allowedTransitions = [
//            'new' => ['job'], 'job' => ['success'], 'success' => [],
//        ];
//        $old = $this->status ?? 'new';
//        if ($old !== $value && !in_array($value, $allowedTransitions[$old] ?? [])) {
//            throw new \Exception("Invalid status transition from {$old} to {$value}");
//        }
//        $this->attributes['status'] = $value;
//    }
}
