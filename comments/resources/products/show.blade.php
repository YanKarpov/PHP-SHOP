@extends('layouts.app')

@section('content')
<div class="container">
    <div class="product-page">
        <!-- Хлебные крошки -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Товары</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>

        <!-- Информация о товаре -->
        <div class="row">
            <div class="col-md-6">
                <div class="product-image">
                    <img src="{{ $product->image ?? '/images/placeholder.jpg' }}" 
                         alt="{{ $product->name }}" 
                         class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-info">
                    <h1>{{ $product->name }}</h1>
                    <div class="product-price">
                        <strong>{{ number_format($product->price, 0, ',', ' ') }} ₽</strong>
                    </div>
                    
                    <div class="product-description">
                        <p>{{ $product->description }}</p>
                    </div>

                    <!-- Кнопка добавления в корзину -->
                    <div class="add-to-cart">
                        <button class="btn btn-primary btn-lg">Добавить в корзину</button>
                    </div>

                    <!-- Характеристики товара -->
                    <div class="product-specs mt-4">
                        <h5>Характеристики:</h5>
                        <ul>
                            <li>Категория: {{ $product->category->name ?? 'Не указана' }}</li>
                            <li>Артикул: {{ $product->sku ?? 'Не указан' }}</li>
                            <li>В наличии: {{ $product->stock > 0 ? 'Да' : 'Нет' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Блок с отзывами -->
        <div class="row mt-5">
            <div class="col-12">
                @include('components.reviews', [
                    'product' => $product,
                    'reviews' => $reviews,
                    'averageRating' => $averageRating,
                    'totalReviews' => $totalReviews
                ])
            </div>
        </div>
    </div>
</div>
@endsection