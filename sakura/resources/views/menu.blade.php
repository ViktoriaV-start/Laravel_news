<div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">

        <a class="p-2 text-decoration-none link-secondary {{ request()->routeIs('index')?'font-colored':'' }}" href="{{ route('index') }}"><span class="font-nav">Главная</span></a>
        <a class="p-2 text-decoration-none link-secondary {{ request()->routeIs('about')?'font-colored':'' }}" href="{{ route('about') }}"><span class="font-nav">О нас</span></a>
        <a class="p-2 text-decoration-none link-secondary {{ request()->routeIs('news.category.index')?'font-colored':'' }}" href="{{ route('news.category.index') }}"><span class="font-nav">Категории</span></a>
        <a class="p-2 text-decoration-none link-secondary {{ request()->routeIs('news.index')?'font-colored':'' }}" href="{{ route('news.index') }}"><span class="font-nav">Лента новостей</span></a>

        <a class="p-2 text-decoration-none link-secondary
        {{ request()->getRequestUri() == '/news/category/world'?'font-colored':'' }}"
        href="{{ route('news.category.show', 'world') }}">
            <span class="font-nav">Мир</span>
        </a>

        <a class="p-2 text-decoration-none link-secondary
        {{ request()->getRequestUri() == '/news/category/business'?'font-colored':'' }}"
        href="{{ route('news.category.show', 'business') }}">
            <span class="font-nav">Бизнес</span>
        </a>

        <a class="p-2 text-decoration-none link-secondary
        {{ request()->getRequestUri() == '/news/category/politics'?'font-colored':'' }}"
           href="{{ route('news.category.show', 'politics') }}">
            <span class="font-nav">Политика</span>
        </a>

        <a class="p-2 text-decoration-none link-secondary
        {{ request()->getRequestUri() == '/news/category/sport'?'font-colored':'' }}"
        href="{{ route('news.category.show', 'sport') }}">
            <span class="font-nav">Спорт</span>
        </a>

        <a class="p-2 text-decoration-none link-secondary
        {{ request()->getRequestUri() == '/news/category/culture'?'font-colored':'' }}"
        href="{{ route('news.category.show', 'culture') }}">
           <span class="font-nav">Культура</span>
        </a>

    </nav>
</div>

@guest
@else
    @if(Auth::user()->is_admin)
    <a class="p-2 text-decoration-none link-secondary" href="{{ route('admin.index') }}">
        <span class="font-nav">Админ</span>
    </a>
@endif
@endguest



{{--d({{ request()->getRequestUri() == '/news/category/culture'?1:2 }});--}}

{{--d({{ request()->getRequestUri() }});--}}
