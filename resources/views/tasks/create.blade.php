@extends('layouts.main')

@section('title', 'Создание задачи')

<div class="col-md-8">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-plus-circle me-2"></i>
                Новая задача
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.tasks.store', $project) }}" method="POST">
                @csrf

                {{-- Название задачи --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Название задачи <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control form-control-lg @error('title') is-invalid @enderror"
                           id="title"
                           name="title"
                           value="{{ old('title') }}"
                           placeholder="Введите название задачи"
                           required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Описание задачи --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description"
                              name="description"
                              rows="4"
                              placeholder="Подробное описание задачи">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Приоритет --}}
                    <div class="col-md-4 mb-3">
                        <label for="priority" class="form-label">Приоритет <span class="text-danger">*</span></label>
                        <select class="form-select @error('priority') is-invalid @enderror"
                                id="priority"
                                name="priority"
                                required>
                            <option value="">Выберите приоритет</option>
                            <option value="1" {{ old('priority') == 1 ? 'selected' : '' }}>Высокий</option>
                            <option value="2" {{ old('priority') == 2 ? 'selected' : '' }}>Средний</option>
                            <option value="3" {{ old('priority') == 3 ? 'selected' : '' }}>Низкий</option>
                        </select>
                        @error('priority')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Дедлайн --}}
                    <div class="col-md-4 mb-3">
                        <label for="deadline" class="form-label">Дедлайн</label>
                        <input type="date"
                               class="form-control @error('deadline') is-invalid @enderror"
                               id="deadline"
                               name="deadline"
                               value="{{ old('deadline') }}"
                               min="{{ date('Y-m-d') }}">
                        @error('deadline')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Исполнитель --}}
                    <div class="col-md-4 mb-3">
                        <label for="assignee_id" class="form-label">Исполнитель</label>
                        <select class="form-select @error('assignee_id') is-invalid @enderror"
                                id="assignee_id"
                                name="assignee_id">
                            <option value="">Не назначен</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('assignee_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('assignee_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Кнопки --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('projects.tasks.index', $project) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Назад к задачам
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-2"></i>Создать задачу
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
