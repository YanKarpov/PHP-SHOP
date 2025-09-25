@extends('layouts.shop')

@section('title', 'Products')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Products</h1>
    </div>
</div>

<div class="row">
    @foreach($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <div class="mt-auto">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="h5 text-primary">${{ number_format($product->price, 2) }}</span>
                        <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                            {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}
                        </span>
                    </div>
                    
                    @if($product->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST" class="d-flex">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control me-2" style="width: 80px;">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                    @else
                    <button class="btn btn-secondary" disabled>Out of Stock</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
