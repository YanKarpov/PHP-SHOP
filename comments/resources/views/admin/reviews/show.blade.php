<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр отзыва</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome@6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.reviews.index') }}">Панель модератора</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('admin.reviews.index') }}">← Назад к списку</a>
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Просмотр отзыва</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Информация об авторе</h5>
                        <p><strong>Имя:</strong> {{ $review->author_name }}</p>
                        <p><strong>Email:</strong> {{ $review->author_email }}</p>
                        <p><strong>Дата:</strong> {{ $review->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Информация о продукте</h5>
                        <p><strong>Продукт:</strong> {{ $review->product->name }}</p>
                        <p><strong>Цена:</strong> ${{ number_format($review->product->price, 2) }}</p>
                        <p><strong>Оценка:</strong> 
                            <span class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                @endfor
                            </span>
                            ({{ $review->rating }}/5)
                        </p>
                    </div>
                </div>

                <hr>

                <h5>Комментарий</h5>
                <div class="border p-3 bg-light">
                    {{ $review->comment }}
                </div>

                <hr>

                <h5>Статус</h5>
                <p>
                    @if($review->is_approved)
                        <span class="badge bg-success">Одобрен</span>
                    @else
                        <span class="badge bg-warning">На модерации</span>
                    @endif
                </p>

                <div class="mt-4">
                    @if(!$review->is_approved)
                        <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Одобрить отзыв
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.reviews.reject', $review) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-times"></i> Отклонить отзыв
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить отзыв?')">
                            <i class="fas fa-trash"></i> Удалить отзыв
                        </button>
                    </form>

                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">
                        ← Назад к списку
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>