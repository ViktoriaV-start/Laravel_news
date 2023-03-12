@extends('layouts.main_layout')

@section('title')
    @parent О нас
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <main class="about container">
        <h1 class="title__h1">Новостной сайт Ньюс Лайн</h1>
        <h4 class="title__h3">О сайте</h4>

        <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <h3 class="title__h3 mt-5 mb-3">Форма обратной связи</h3>
        <form method="POST" action="{{ route('about') }}">
            @csrf

            <div class="form-group row mb-3">
                <label for="name" class="col-md-2 col-form-label text-md-start">Имя</label>

                <div class="col-md-8">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus required>
                </div>

            </div>

            <div class="form-group row mb-3">
                <label for="surname" class="col-md-2 col-form-label text-md-start">Фамилия</label>

                <div class="col-md-8">
                    <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}">
                </div>

            </div>

            <div class="form-group row mb-3">
                <label for="mail" class="col-md-2 col-form-label text-md-start">Адрес электронной почты</label>

                <div class="col-md-8">
                    <input id="mail" type="text" class="form-control" name="mail" value="{{ old('mail') }}" required placeholder=" Введите адрес электронной почты">
                    <span class="font-colored {{ $mailWarn }}">{{ $message }}</span>
                </div>

            </div>

            <div class="form-group row mb-3">
                <label for="comment" class="col-md-2 col-form-label text-md-start">Комментарий</label>
                <div class="col-md-8">
                    <textarea id="comment" type="text" class="form-control" name="comment" required>{{ old('comment') }}</textarea>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2 offset-md-2">
                        <button type="submit" class="btn btn-sm btn-outline-secondary btn-width shadow-sm">Добавить</button>
                    </div>
                </div>
            </div>

        </form>

        <span class="font-colored {{ $done}}">Комментарий отправлен </span>

    </main>
@endsection

