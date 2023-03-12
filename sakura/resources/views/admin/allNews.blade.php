@extends('layouts.admin')

@section('title')
    @parent Новости
@endsection

@section('content')

    {{--    передать в главный layout сам контент--}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Новости</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <a class="me-2" href="{{ route('admin.news.create') }}">
                <button type="button" class="btn btn-sm btn-outline-secondary btn-width">Добавить</button>
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>id</th>
                <th>Категория</th>
                <th>Заголовок</th>
                <th>Текст</th>
                <th>Ресурс</th>
                <th>Время</th>
                <th>Приватность</th>
                <th>Статус</th>
                <th>Опции</th>
            </tr>
            </thead>
            <tbody>
            @forelse($news as $item)
                <tr data-id="{{ $item->id }}">
                    <td>{{ $item->id }}</td>

                    <td>
                        @foreach($categoriesTitle as $category)
                            @if ($category->id == $item->category_id)
                            {{ $category->title }}
                            @endif
                        @endforeach
                    </td>

                    <td>{{ $item->title }}</td>
                    <td>{!!  $item->text !!}</td>

                    <td>
                        @foreach($sourcesTitle as $source)
                            @if ($source->id == $item->source_id)
                                {{ $source->title }}
                            @endif
                        @endforeach
                    </td>

                    <td>{{ $item->created_at }}
                    </td>
                    <td>{{ !$item->isPrivate ? 'открытая' : 'закрытая' }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <form action="{{ route('admin.news.destroy', $item) }}" method="post">

                            <a href="{{ route('admin.news.edit', $item) }}" class="font-colored nav-link p-0">Редактировать</a>
                            @csrf
                            @method('DELETE')
{{--                            // скрытый инпут с именем _method и значением DELETE--}}

                            <span class="note">первый способ удаления</span>
                            <button type="submit" class="btn-delete">Удалить</button>
                        </form>
                        <span class="note">асинхронное удаление</span>
                        <button type="submit" class="dlt" value="{{ $item->id }}">Удалить</button>
                    </td>
                </tr>

            @empty
                <tr><td colspan="4">Нет записей</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $news->links() }}</div>
@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const elements = document.querySelectorAll('.dlt');

            elements.forEach(function(item, index) {

                item.addEventListener('click', function () {

                    const id = item.value;
                    let newsItem = document.querySelector(`[data-id="${id}"]`);

                    if (confirm(`Подтвердите удаление записи с ID ${id}`)) {
                        //ОТПРАВИТЬ форму на удаление новости
                        send(`/admin/news/${id}`).then(() => {
                            alert("Запись была удалена");
                            // location.reload(); // Это перезагрузка страницы
                            newsItem.remove(); // удаление элемента
                        });
                    }
                });
                // console.log(item.dataset['price']);
                // console.log(item.value);
            });
        });
        async function send(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content')
                }
            });
            let result = await response.json();

            return result.ok;
        }
    </script>
@endpush
