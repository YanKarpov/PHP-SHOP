@extends('admin.layout')

@section('title', $product->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Просмотр товара: {{ $product->name }}</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>ID:</strong> {{ $product->id }}
                </div>
                <div class="mb-3">
                    <strong>Название:</strong> {{ $product->name }}
                </div>
                <div class="mb-3">
                    <strong>Описание:</strong> {{ $product->description }}
                </div>
                <div class="mb-3">
                    <strong>Цена:</strong> {{ number_format($product->price, 2) }} ₽
                </div>
                <div class="mb-3">
                    <strong>Остаток:</strong> {{ $product->quantity }} шт.
                </div>
                <div class="mb-3">
                    <strong>Создан:</strong> {{ $product->created_at->format('d.m.Y H:i') }}
                </div>
                
                <div class="d-grid gap-2 d-md-flex">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary me-md-2">
                         Редактировать
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        ← Назад к списку
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection