@extends('layouts.main_layout')

@section('title', 'Профиль')

@section('menu')
    @include('menu')
@endsection

@section('content')

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Редактирование профиля</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('updateProfile') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid
                                        @enderror" name="name" value="{{ old('name') ??  $user->name }}"
                                        required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="surname" class="col-md-4 col-form-label text-md-end">Фамилия</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control
                                           @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') ?? $user->surname }}"
                                           required autocomplete="surname" autofocus>

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Почта</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control
                                        @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}"
                                           required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Текущий пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control
                                    @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-form-label text-md-end">Новый пароль</label>

                                <div class="col-md-6">
                                    <input id="newPassword" type="password" class="form-control
                                       @error('newPassword') is-invalid @enderror"
                                           name="newPassword" required autocomplete="new-password">

                                    @error('newPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Повторите пароль</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" 
                                    name="newPassword_confirmation"
                                    required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить изменения
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

