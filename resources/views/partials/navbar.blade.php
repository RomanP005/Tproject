<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Таск-трекер на Laravel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li><a class="nav-link active" href="{{ route('register') }}">Регистрация</a></li>
                    <li><a class="nav-link active" href="{{ route('login') }}">Вход</a></li>
                <li><a class="nav-link active" href="{{ route('logout') }}">Выйти</a></li>
{{--              q--}}
{{--                    <li><a class="nav-link active" href="#">Pricing</a></li>--}}
{{--                    <li><a class="nav-link active" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>--}}
            </ul>
        </div>
    </div>
</nav>
