@extends('layouts.main')

@section('title', 'Редактирование задачи')

@section('body')
    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="title" class="form-label">Наименование задачи</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $task->title) }}">
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="project_id" class="form-label">Проект</label>
            <select name="project_id" id="project_id" class="form-select @error('project_id') is-invalid @enderror">
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                        {{ $project->title }}
                    </option>
                @endforeach
            </select>
            @error('project_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="form-label">Описание задачи</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $task->description) }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="status" class="form-label">Статус</label>
            <input type="text" class="form-control" value="{{ $task->status->value ?? $task->status }}" readonly disabled>
        </div>

        <div class="mb-4">
            <label for="priority" class="form-label">Приоритет</label>
            <input type="number" name="priority" id="priority" class="form-control @error('priority') is-invalid @enderror" value="{{ old('priority', $task->priority) }}">
            @error('priority') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="deadline" class="form-label">Дедлайн</label>
            <input type="date" name="deadline" id="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline', $task->deadline instanceof \Carbon\Carbon ? $task->deadline->format('Y-m-d') : $task->deadline) }}">
            @error('deadline') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="assignee_id" class="form-label">Исполнитель</label>
            <select name="assignee_id" id="assignee_id" class="form-select @error('assignee_id') is-invalid @enderror">
                <option value="">Не назначен</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('assignee_id', $task->assignee_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('assignee_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
