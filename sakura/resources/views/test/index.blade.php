Hi!

<h1>Тест главная</h1>

<a href="{{ route('test.home') }}">Тест Главная</a>
<a href="{{ route('test.info') }}">Информация</a>



@forelse($news as $elem)

    <h3>{{ $elem['title'] }}</h3>
    <img src="{{ $elem['image'] }}">
    <p>{{ $elem['text'] }}</p>
    <p>Статус: {{ $elem['status'] }}</p>
    <p>{{ $elem['some'] }}</p>

    @empty

    <p>нет новостей</p>

@endforelse
