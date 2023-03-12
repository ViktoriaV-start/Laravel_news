@extends('layouts.main_layout')
{{--расширяет главный layout, который находится по указанному пути--}}

@section('title')
    @parent Главная
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    {{--    передать в главный layout сам контент--}}
    <main>
        <h1>Новостной сайт Ньюс Лайн</h1>
        <h3>Главная</h3>
        <div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
{{--окончание секции--}}

