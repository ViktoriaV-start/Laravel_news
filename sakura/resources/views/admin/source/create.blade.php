@extends('layouts.admin')

@section('title', 'Добавить ресурс')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить ресурс</h1>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.source.store') }}">
        @csrf

        <div class="form-group row mb-3">
            <label for="sourceTitle" class="col-md-2 col-form-label text-md-end">Название ресурса</label>

            <div class="col-md-8">
                <input id="sourceTitle" type="text" class="form-control" name="title" value="{{ old('title') }}" autofocus>
            </div>
            {{--            Логика для ошибки: блок будет генерироваться в случае ошибки --}}
            @if($errors->has('title'))
                <div class="col-md-8 me-2 offset-md-2 alert alert-danger mt-3" role="alert">
                    @foreach($errors->get('title') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row mb-3">
            <label for="sourceLink" class="col-md-2 col-form-label text-md-end">Адрес ресурса</label>

            <div class="col-md-8">
                <input id="sourceLink" type="text" class="form-control" name="source" value="{{ old('source') }}" autofocus>
            </div>
            {{--            Логика для ошибки: блок будет генерироваться в случае ошибки --}}
            @if($errors->has('source'))
                <div class="col-md-8 me-2 offset-md-2 alert alert-danger mt-3" role="alert">
                    @foreach($errors->get('source') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row mb-0">
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2 offset-md-2">
                    <button type="submit" class="btn btn-sm btn-outline-secondary btn-colored shadow-sm">Добавить ресурс</button>
                </div>
            </div>
        </div>
    </form>

@endsection



