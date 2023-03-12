@extends('layouts.main_layout')
{{--расширяет главный layout, который находится по указанному пути--}}

@section('title')
    @parent Admin test1
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    {{--    передать в главный layout сам контент--}}
    @include('admin/admin_menu')
    <main class="title container">
        <h1 class="title__h1">Cтраница админа</h1>
        <h3 class="title__h3">Тест 1</h3>
    </main>
@endsection
