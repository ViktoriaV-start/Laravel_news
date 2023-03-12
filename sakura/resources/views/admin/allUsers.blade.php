@extends('layouts.admin')

@section('title')
    @parent Пользователи
@endsection

@section('content')
    {{--    передать в главный layout сам контент--}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Зарегистрированные пользователи</h1>
    </div> 

 



    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>id</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Email</th>
                <th>Права администратора</th>
                
                <th>Удалить пользователя</th>
                </tr>
            </thead>
            <tbody>
            @forelse($users as $item)
                <tr>
                
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->surname }}</td>
                    <td>{{ $item->email }}</td>
                    <td class="{{ $item->is_admin ? 'font-colored' : '' }} ">
                        {{ $item->is_admin ? 'администратор' : 'пользователь' }}

                        @if (!$item->is_admin)

                        <form method="POST" action="{{ route('admin.user.update', $item) }}">
                        @csrf
                        @if ($item->id) @method('PUT') @endif

                        <button class="btn-special">
                            Добавить права администратора</button>
                        </form>

                        @endif

                        @if ($item->is_admin )

                        <form method="POST" action="{{ route('admin.user.update', $item) }}">
                        @csrf
                        @if ($item->id) @method('PUT') @endif

                        <button class="btn-delete">
                            Удалить права администратора</button>
                        </form>

                        @endif
                        
                    </td>

                    <td>
                    <form action="{{ route('admin.user.destroy', $item) }}" method="post">
                    @csrf
                    @method('DELETE')

                    @if (!$item->is_admin )
                        <button type="submit" class="btn-delete">Удалить</button>
                    @endif    
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
