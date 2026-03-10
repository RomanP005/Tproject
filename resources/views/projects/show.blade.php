@extends('layouts.main')

@section('title', 'Просмотр проекта')

@section('body')
    <div class="card">
        <div class="card-header">
            <h3>{{ $project->title }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Описание:</strong> {{ $project->description ?? '—' }}</p>
            <p><strong>Создатель:</strong> {{ $project->creator->name }}</p>
            <p><strong>Дата создания:</strong> {{ $project->created_at->format('d.m.Y') }}</p>

            <h4 class="mt-4">Задачи проекта</h4>
            @if($tasks->isNotEmpty())
                <ul class="list-group">
                    @foreach($tasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a>
                            <span>
                                Статус: {{ $task->status->value ?? $task->status }} |
                                Исполнитель: {{ $task->assignee->name ?? 'Не назначен' }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>В этом проекте пока нет задач.</p>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Назад к списку</a>
            @if($project->creator_id === Auth::id())
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning">Редактировать</a>
            @endif
        </div>
    </div>
@endsection
