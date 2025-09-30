<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интернет-магазин</title>
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>
    <header>
        @include('menu.main')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
    </footer>
</body>
</html>
