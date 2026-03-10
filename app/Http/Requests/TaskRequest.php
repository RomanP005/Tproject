<?php

namespace App\Http\Requests;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
//            'status'      => ['required', 'string', 'in:' . implode(',', StatusEnum::values())],
            'description' => 'required|string|max:255',
            'priority'    => 'required|integer',
            'deadline'    => 'required|date',
            'project_id'  => 'required|integer|exists:projects,id',
            'assignee_id' => 'required|integer|exists:users,id',
        ];
    }
}
