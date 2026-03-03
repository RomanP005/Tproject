@extends('layouts.main')

@section('title', 'Авторизация')

@section('body')


    <form action="{{ route('login.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label  for="name" class="form-label">Ваш логин</label>
            <input type="text" name="name" placeholder="логин" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label  for="email" class="form-label">Ваша почта</label>
            <input type="email" name="email" placeholder="qweqwe@mail.ru" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label  for="password" class="form-label">Ваш пароль</label>
            <input type="password" name="password" placeholder="пароль" id="password" class="form-control" required>
        </div>
        <div class="m-3">
            <button class="btn btn-primary">Войти</button>
        </div>
    </form>


@endsection
