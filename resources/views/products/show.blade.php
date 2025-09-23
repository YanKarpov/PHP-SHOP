<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Отзывы</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary mb-3">← Назад к продуктам</a>
        
        <div class="card mb-4">
            <div class="card-body">
                <h2>{{ $product->name }}</h2>
                <p class="card-text">{{ $product->description }}</p>
                <p class="text-primary fw-bold fs-4">${{ number_format($product->price, 2) }}</p>
                
                @php
                    $avgRating = $product->approvedReviews()->avg('rating');
                    $reviewsCount = $product->approvedReviews()->count();
                @endphp
                
                <div class="mb-2">
                    <span class="text-warning fs-5">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star{{ $i <= round($avgRating) ? '' : '-o' }}"></i>
                        @endfor
                    </span>
                    <span class="ms-2">
                        {{ number_format($avgRating, 1) }} из 5 ({{ $reviewsCount }} отзывов)
                    </span>
                </div>
            </div>
        </div>

        <h3 class="mb-3">Отзывы покупателей</h3>
        
        <!-- Форма добавления отзыва -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Оставить отзыв</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('reviews.store', $product) }}">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="author_name" class="form-label">Ваше имя *</label>
                            <input type="text" class="form-control @error('author_name') is-invalid @enderror" 
                                   id="author_name" name="author_name" value="{{ old('author_name') }}" required>
                            @error('author_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="author_email" class="form-label">Email *</label>
                            <input type="email" class="form-control @error('author_email') is-invalid @enderror" 
                                   id="author_email" name="author_email" value="{{ old('author_email') }}" required>
                            @error('author_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="rating" class="form-label">Оценка *</label>
                        <select class="form-select @error('rating') is-invalid @enderror" 
                                id="rating" name="rating" required>
                            <option value="">Выберите оценку</option>
                            <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5 - Отлично</option>
                            <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 - Хорошо</option>
                            <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 - Удовлетворительно</option>
                            <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 - Плохо</option>
                            <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 - Ужасно</option>
                        </select>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Ваш отзыв *</label>
                        <textarea class="form-control @error('comment') is-invalid @enderror" 
                                  id="comment" name="comment" rows="5" required>{{ old('comment') }}</textarea>
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Отправить отзыв</button>
                </form>
            </div>
        </div>

        <!-- Список отзывов -->
        @if($reviews->count() > 0)
            @foreach($reviews as $review)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0">{{ $review->author_name }}</h5>
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                        </div>
                        
                        <p class="text-muted small mb-2">
                            {{ $review->created_at->format('d.m.Y H:i') }}
                        </p>
                        
                        <p class="card-text">{{ $review->comment }}</p>
                    </div>
                </div>
            @endforeach

            <!-- Пагинация -->
            <div class="d-flex justify-content-center">
                {{ $reviews->links() }}
            </div>
        @else
            <div class="alert alert-info">
                Пока нет отзывов. Будьте первым!
            </div>
        @endif
    </div>
</body>
</html>