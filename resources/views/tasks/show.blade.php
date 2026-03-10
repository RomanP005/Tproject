@extends('layouts.main')

@section('title', 'Просмотр задачи')

@section('body')
    <div class="card">
        <div class="card-header">
            <h3>Задача #{{ $task->id }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Название:</strong> {{ $task->title }}</p>
            <p><strong>Описание:</strong> {{ $task->description }}</p>
            <p><strong>Статус:</strong> {{ $task->status->value ?? $task->status }}</p>
            <p><strong>Приоритет:</strong> {{ $task->priority }}</p>
            <p><strong>Дедлайн:</strong> {{ $task->deadline instanceof \Carbon\Carbon ? $task->deadline->format('d.m.Y') : $task->deadline }}</p>
            <p><strong>Проект:</strong> {{ $task->project->title }}</p>
            <p><strong>Автор:</strong> {{ $task->user->name }}</p>
            <p><strong>Исполнитель:</strong> {{ $task->assignee->name ?? 'Не назначен' }}</p>
            <p><strong>Создано:</strong> {{ $task->created_at->format('d.m.Y H:i') }}</p>
            @if($task->deleted_at)
                <p><strong>Удалено:</strong> {{ $task->deleted_at->format('d.m.Y H:i') }}</p>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Назад к списку</a>
            @if($task->project->creator_id === Auth::id())
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Редактировать</a>
            @endif
        </div>
    </div>
@endsection
