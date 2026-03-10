@extends('layouts.main')

@section('title', 'Редактирование проекта')

@section('body')
    <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="title" class="form-label">Название проекта</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $project->title) }}">
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
