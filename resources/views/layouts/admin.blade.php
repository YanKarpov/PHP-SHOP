<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель - Управление меню</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .admin-navbar {
            background: #343a40;
            padding: 1rem 0;
        }
        .admin-navbar .nav-link {
            color: white !important;
            padding: 0.5rem 1rem;
        }
        .admin-navbar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg admin-navbar">
        <div class="container">
            <span class="navbar-brand text-white">Админ-панель</span>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('admin.menu.index') }}">Управление меню</a>
                <a class="nav-link" href="{{ url('/') }}">На сайт</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>