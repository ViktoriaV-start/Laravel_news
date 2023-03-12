@extends('layouts.main_layout')

@section('title', 'Категории')

@section('menu')
    @include('menu')
@endsection

@section('content')
    <main class="one-news container">
        {{--        <h2 class="title__h2">{{ $category['title'] ?? "" }}</h2>--}}
        <h2 class="title__h2">{{ $category ?? "" }}</h2>

        @forelse($news as $item)
            <a class="text-decoration-none link-secondary" href="{{ route('news.one', $item->id) }}" class="news-line__href">
                <p class="h4">{{ $item->title }}</p>
            </a>

        @empty
            <p>Нет новостей</p>
        @endforelse

    </main>

@endsection
