@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Каталог товаров</h1>
    
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card product-card">
                <img src="{{ $product->image ?? '/images/placeholder.jpg' }}" 
                     class="card-img-top" 
                     alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ number_format($product->price, 0, ',', ' ') }} ₽</p>
                    <a href="{{ route('products.show', $product->id) }}" 
                       class="btn btn-primary">Подробнее</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Пагинация -->
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection