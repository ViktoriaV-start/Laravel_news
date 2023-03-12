@extends('layouts.main_layout')

@section('title', 'Категории')

@section('menu')
    @include('menu')
@endsection

@section('content')
    <main class="container">
        <nav class="nav flex-column">
            <h3>Новости по категориям</h3>

            @forelse($categories as $category)

                <a class="text-decoration-none text-reset" href="{{  route('news.category.show', $category->slug) }}" class="nav-link">
                    <h4 class="text-decoration-none link-secondary">{{ $category->title }}</h4>
                </a>

            @empty
                Нет категорий
            @endforelse
        </nav>
    </main>
@endsection

