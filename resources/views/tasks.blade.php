@extends('layouts.main')

@section('title', 'Главная')

@section('body')
    <div class="text-center">
        <h2>Добро пожаловать в Task Tracker</h2>
    </div>

    @if($tasks->isNotEmpty())
        <div class="row">
            @foreach($tasks as $task)
                <div class="col-6">
                    <div class="border border-success border-opacity-25 rounded-4 p-4">
                        <h3>Задача №{{ $task->id }} от {{ $task->created_at->format('d.m.Y H:i') }}</h3>
                        <h4>Пользователь: {{ $task->user->name }}</h4>
                        <p class="mb-3"><strong>Наименование проекта: {{ $task->project->title }}</strong></p>
                        <p class="mb-3"><strong>Наименование задачи: {{ $task->title }}</strong></p>
                        <p class="mb-3"><strong>Дедлайн задачи: </strong>{{ $task->deadline->format('d.m.Y') }}</p>
                        <p class="mb-3"><strong>Приоритет задачи: {{ $task->priority }}</strong></p>
                        <div class="d-flex gap-2 align-items-center mb-3">
                            <span class="badge bg-success">{{ $task->status }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-light text-center py-5 fs-5 rounded-2">
            Вы еще не создали задачу!
        </div>
    @endif
@endsection
