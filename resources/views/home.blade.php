@extends('layouts.main')

@section('title', 'Главная')

@section('body')
    <div class="text-center">
        <h1>Добро пожаловать в Task Tracker</h1>
        @auth
            <p>Вы вошли как {{ Auth::user()->name }}.</p>
            <a href="#" class="btn btn-primary">Перейти к проектам</a>
        @else
            <p>Пожалуйста, <a href="{{ route('login') }}">войдите</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a>.</p>
        @endauth
    </div>

@endsection
