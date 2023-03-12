@extends('layouts.admin')
{{--расширяет главный layout, который находится по указанному пути--}}

@section('title')
  @parent Администрирование
@endsection


@section('content')
{{--    передать в главный layout сам контент--}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Администрирование</h1>
    </div>

<div class="btn-toolbar mb-2 mb-md-0">
    <a class="me-2" href="{{ route('admin.test1') }}">
        <button type="button" class="btn btn-sm btn-outline-secondary btn-width">Скачать JSON</button>
    </a>
    <a href="{{ route('admin.test2') }}">
        <button type="button" class="btn btn-sm btn-outline-secondary btn-width">Скачать IMAGE</button>
    </a>
</div>

@endsection
