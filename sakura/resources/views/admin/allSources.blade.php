@extends('layouts.admin')

@section('title')
    @parent Ресурсы
@endsection

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ресурсы</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <a class="me-2" href="{{ route('admin.source.create') }}">
                <button type="button" class="btn btn-sm btn-outline-secondary btn-width">Добавить</button>
            </a>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>id</th>
                <th>Название</th>
                <th>Адрес</th>
                <th>Опции</th>
            </tr>
            </thead>
            <tbody>
            @forelse($sources as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->source }}</td>
                    <td>
                        <form action="{{ route('admin.source.destroy', $item) }}" method="post">

                            <a href="{{ route('admin.source.edit', $item) }}" class="font-colored nav-link p-0">Редактировать</a>
                            @csrf
                            @method('DELETE')
                            {{--                            // скрытый инпут с именем _method и значением DELETE--}}
                            <button type="submit" class="btn-delete">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Нет записей</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection


