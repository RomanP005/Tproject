@extends('layouts.main')

@section('title', 'Главная')

@section('button')
    <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">Добавить задачу</a>
    <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm">Добавить проект</a>

@endsection

@section('body')
    <div class="text-center">
        <h2>Добро пожаловать в Task Tracker</h2>
    </div>

    <div class="row mb-4">
        <div class="col-md-10 offset-md-1">
            <form action="{{ route('tasks.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Поиск по названию или описанию" value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Все статусы</option>
                        @foreach(\App\Enums\StatusEnum::values() as $statusOption)
                            <option value="{{ $statusOption }}" {{ request('status') == $statusOption ? 'selected' : '' }}>
                                {{ $statusOption }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="priority" class="form-control" placeholder="Приоритет" value="{{ request('priority') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="deadline" class="form-control" value="{{ request('deadline') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Применить</button>
                </div>
                @if(request()->anyFilled(['search', 'status', 'priority', 'deadline']))
                    <div class="col-md-2">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary w-100">Сброс</a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    @if($projects->isNotEmpty())
        <h3 class="row mb-3">Ваши проекты</h3>
        <div class="row">
            @foreach($projects as $project)
                <div class="col-12 mb-3">
                    <div class="border border-primary border-opacity-25 rounded-4 p-4 h-100">
                        <h3>Проект №{{ $project->id }} от {{ $project->created_at->format('d.m.Y H:i') }}</h3>
                        <h4>Проект: {{ $project->title }}</h4>
                        <p class="mb-3"><strong>Описание: </strong> {{ $project->description ?? '—' }}</p>
                        <p class="mb-3"><strong>Создатель: </strong> {{ $project->creator->name ?? 'Неизвестно' }}</p>
                        <p class="mb-3"><strong>Дата создания: </strong> {{ $project->created_at->format('d.m.Y') }}</p>
                        <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            @if($project->creator_id === Auth::id())
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                                </form>
                                <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-primary">Посмотреть</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-light text-center py-5 fs-5 rounded-2 mt-4">
            У вас пока нет проектов. <a href="{{ route('projects.create') }}">Создайте проект</a>!
        </div>
    @endif
    @if($tasks->isNotEmpty())
        <div class="row mb-3">
            @foreach($tasks as $task)
                <div class="col-12 mb-3">
                    <div class="border border-success border-opacity-25 rounded-4 p-4">
                        <h3>Задача №{{ $task->id }} от {{ $task->created_at->format('d.m.Y H:i') }}</h3>
                        <h4>Пользователь: {{ $task->user->name }}</h4>
                        <p class="mb-3"><strong>Исполнитель: {{ $task->assignee->name ?? 'Не назначен' }}</strong></p>
                        <p class="mb-3"><strong>Наименование проекта: {{ $task->project->title }}</strong></p>
                        <p class="mb-3"><strong>Наименование задачи: {{ $task->title }}</strong></p>
                        <p class="mb-3"><strong>Дедлайн задачи: </strong>{{ $task->deadline->format('d.m.Y') }}</p>
                        <p class="mb-3"><strong>Приоритет задачи: {{ $task->priority }}</strong></p>
                        <div class="d-flex gap-2 align-items-center mb-3">
                            <span class="badge bg-success">{{ $task->status }}</span>
                        </div>
                        @if($task->project->creator_id === Auth::id())
                            <div class="d-flex gap-2 mt-3">
                                @if($task->status === \App\Enums\StatusEnum::NEW)
                                    <form action="{{ route('tasks.start', $task) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-primary">Взять в работу</button>
                                    </form>
                                @elseif($task->status === \App\Enums\StatusEnum::JOB)
                                    <form action="{{ route('tasks.complete', $task) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success">Завершить</button>
                                    </form>
                                @endif
                            </div>

                        @endif
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        @if($task->project->creator_id === Auth::id())
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                            </form>
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-primary">Посмотреть</a>
                        @endif
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
