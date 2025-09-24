@extends('admin.layout')

@section('title', 'Редактирование отзыва')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Редактирование отзыва</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.reviews.update', $review) }}">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="author_name" class="form-label">Имя автора *</label>
                        <input type="text" class="form-control @error('author_name') is-invalid @enderror" 
                               id="author_name" name="author_name" 
                               value="{{ old('author_name', $review->author_name) }}" required>
                        @error('author_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="author_email" class="form-label">Email автора *</label>
                        <input type="email" class="form-control @error('author_email') is-invalid @enderror" 
                               id="author_email" name="author_email" 
                               value="{{ old('author_email', $review->author_email) }}" required>
                        @error('author_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="rating" class="form-label">Оценка *</label>
                        <select class="form-select @error('rating') is-invalid @enderror" 
                                id="rating" name="rating" required>
                            <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>5 - Отлично</option>
                            <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>4 - Хорошо</option>
                            <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>3 - Удовлетворительно</option>
                            <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>2 - Плохо</option>
                            <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>1 - Ужасно</option>
                        </select>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Статус</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_approved" 
                                   name="is_approved" value="1" 
                                   {{ old('is_approved', $review->is_approved) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_approved">
                                Одобрен
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Комментарий *</label>
                    <textarea class="form-control @error('comment') is-invalid @enderror" 
                              id="comment" name="comment" rows="6" required>{{ old('comment', $review->comment) }}</textarea>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <p class="text-muted">
                        <strong>Продукт:</strong> {{ $review->product->name }}<br>
                        <strong>Дата создания:</strong> {{ $review->created_at->format('d.m.Y H:i') }}<br>
                        <strong>Последнее обновление:</strong> {{ $review->updated_at->format('d.m.Y H:i') }}
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Сохранить изменения
                    </button>
                    
                    <a href="{{ route('admin.reviews.show', $review) }}" class="btn btn-secondary">
                        ← Отмена
                    </a>
                    
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary">
                        Список отзывов
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
