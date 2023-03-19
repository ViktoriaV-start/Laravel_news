@extends('layouts.main_layout')

@section('title', 'Лента новостей')

@section('menu')
    @include('menu')
@endsection

@section('content')
    <main class="news-line container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="title__h3">Лента новостей</h3>
                        @forelse($news as $item)
                            <a class="text-decoration-none link-secondary" href="{{ route('news.one', $item->id) }}"><p class="h5">{{ $item->title }}</p></a>
                        @empty
                            <p>Нет новостей</p>
                        @endforelse
                            <div class="mt-5">{{ $news->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

{{--    <?php foreach ($news as $item): ?>--}}
{{--    <a href="<?=route('one', $item['id'])?>"><h3><?=$item['title']?></h3></a>--}}
{{--    <?php endforeach;?>--}}
{{--    Заменили foreach синтаксисом blade:  <?php  ?>/ <?= foreach ($news as $item): ?> меняем на {{  }}--}}



