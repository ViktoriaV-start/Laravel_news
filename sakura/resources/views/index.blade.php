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
        <div>
             <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
{{--окончание секции--}}

