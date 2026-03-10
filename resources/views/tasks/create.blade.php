@extends('layouts.main')

@section('title', 'Добавление задачи')

@section('body')
    <form action="{{ route('tasks.store') }}" method="post">
        @csrf
        <div class="mb-4">
            <label for="title" class="form-label">Наименование задачи</label>
            <input type="text" name="title" id="title" placeholder="Наименование задачи" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="project_id" class="form-label">Наменование проекта</label>
            <select name="project_id" id="project_id" class="form-select">
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                @endforeach
            </select>
            @error('project_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="form-label">Описание задачи</label>
            <textarea type="text" name="description" id="description" placeholder="Описание задачи" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}"></textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="status" class="form-label">Статус задачи</label>
            <select name="status" id="status" class="form-select">
                @foreach(\App\Enums\StatusEnum::values() as $status)
                    <option>{{ $status }}</option>
                @endforeach
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="priority" class="form-label">Приоритет задачи</label>
            <input type="number" name="priority" id="priority" placeholder="Приоритет задачи" class="form-control @error('priority') is-invalid @enderror" value="{{ old('priority') }}">
            @error('priority')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="deadline" class="form-label">Дедлайн задачи</label>
            <input type="date" name="deadline" id="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline') ?? now()->format('Y-m-d') }}">
            @error('deadline')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="assignee_id" class="form-label">Исполнитель задачи</label>
            <select name="assignee_id" id="assignee_id" class="form-select">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('assignee_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('assignee_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary">Отправить</button>
    </form>


@endsection()
