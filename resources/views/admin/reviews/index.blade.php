@extends('admin.layout')

@section('title', 'Модерация отзывов')

@section('content')
    <h1 class="mb-4">Модерация отзывов</h1>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">Все отзывы ({{ $reviews->total() }})</h5>
                </div>
                <div class="col-md-6 text-end">
                    <span class="badge bg-success">Одобрено: {{ $reviews->where('is_approved', true)->count() }}</span>
                    <span class="badge bg-warning ms-2">На модерации: {{ $reviews->where('is_approved', false)->count() }}</span>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            @if($reviews->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Продукт</th>
                                <th>Автор</th>
                                <th>Оценка</th>
                                <th>Статус</th>
                                <th>Дата</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td><strong>{{ $review->product->name }}</strong></td>
                                    <td>
                                        {{ $review->author_name }}<br>
                                        <small class="text-muted">{{ $review->author_email }}</small>
                                    </td>
                                    <td>
                                        <span class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </span>
                                    </td>
                                    <td>
                                        @if($review->is_approved)
                                            <span class="badge bg-success">Одобрен</span>
                                        @else
                                            <span class="badge bg-warning">На модерации</span>
                                        @endif
                                    </td>
                                    <td>{{ $review->created_at->format('d.m.Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.reviews.edit', $review) }}" 
                                               class="btn btn-sm btn-primary" title="Редактировать">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="{{ route('admin.reviews.show', $review) }}" 
                                               class="btn btn-sm btn-info" title="Просмотр">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if(!$review->is_approved)
                                                <form action="{{ route('admin.reviews.approve', $review) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success" title="Одобрить">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.reviews.reject', $review) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-warning" title="Отклонить">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('admin.reviews.destroy', $review) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Удалить отзыв?')" title="Удалить">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <strong>Комментарий:</strong><br>
                                        {{ \Illuminate\Support\Str::limit($review->comment, 150) }}
                                        @if(strlen($review->comment) > 150)
                                            ... <a href="{{ route('admin.reviews.show', $review) }}">читать полностью</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $reviews->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    Нет отзывов для модерации.
                </div>
            @endif
        </div>
    </div>
@endsection
