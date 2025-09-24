@extends('admin.layout')

@section('title', 'Просмотр отзыва')

@section('content')
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
                    <p><strong>Цена:</strong> {{ number_format($review->product->price, 2) }} ₽</p>
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
                <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Редактировать отзыв
                </a>

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
@endsection
