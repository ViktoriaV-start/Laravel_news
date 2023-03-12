<header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow main-color">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('index') }}">Ньюс Лайн</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Найти" aria-label="Search">

    <img src="{{ Auth::User()->avatar }}" width="40" alt="">
    <div class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('updateProfile') }}">
                {{ __('Профиль') }}
            </a>
        </div>
    </div>

    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <!--TODO ПРОВЕРИТЬ СЛЕДУЮЩИЙ КУСОК <a class="nav-link px-3" href="#" -->
            <a class="nav-link px-3" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                Выход
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                <a class="nav-link px-3" href="#">Выход</a>
            </form>
        </div>
    </div>
</header>


