@extends('layouts.main')

@section('title', 'Создание проекта')

@section('body')
    <form action="{{ route('projects.store') }}" method="post">
        @csrf
        <div class="mb-4">
            <label for="title" class="form-label">Наименование проекта</label>
            <input type="text" name="title" id="title" placeholder="Наименование проекта"
                   class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title') }}">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="form-label">Описание проекта</label>
            <textarea name="description" id="description" rows="4"
                      placeholder="Описание проекта"
                      class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="creator_id" class="form-label">Создатель проекта</label>
            <select name="creator_id" id="creator_id" class="form-select @error('creator_id') is-invalid @enderror">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('creator_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('creator_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Создать проект</button>
    </form>
@endsection
