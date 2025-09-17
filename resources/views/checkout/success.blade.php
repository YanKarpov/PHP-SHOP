@extends('layouts.shop')

@section('title', 'Order Success')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    <h1 class="text-success mt-3">Order Placed Successfully!</h1>
                </div>
                
                <p class="lead">Thank you for your order. Your items have been processed and stock has been updated.</p>
                
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-primary me-2">Continue Shopping</a>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">View Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
