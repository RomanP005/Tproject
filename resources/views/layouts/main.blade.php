<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Корочки.есть</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body class="bg-light">
@include('partials.navbar')

<section class="py-5">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between gap-4">
            <h2 class="mb-4">@yield('title')</h2>
            <div>
                @yield('button')
            </div>
        </div>
        <div class="p-5 bg-white rounded-4 shadow-sm">
            @yield('body')
        </div>
    </div>
</section>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
