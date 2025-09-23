<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог продуктов</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Наши продукты</h1>
        
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <p class="text-primary fw-bold">${{ number_format($product->price, 2) }}</p>
                            
                            <div class="mb-2">
                                <span class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= round($product->average_rating) ? '' : '-o' }}"></i>
                                    @endfor
                                </span>
                                <small class="text-muted">
                                    ({{ number_format($product->average_rating, 1) }})
                                </small>
                            </div>
                            
                            <p class="text-muted">
                                {{ $product->approved_reviews_count }} отзывов
                            </p>
                            
                            <a href="{{ route('products.show', $product) }}" class="btn btn-primary">
                                Подробнее и отзывы
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>