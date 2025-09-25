@extends('layouts.shop')

@section('title', 'Checkout')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Checkout</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Order Summary</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->product->price, 2) }}</td>
                                <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Order Total</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>Subtotal:</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Tax:</span>
                    <span>$0.00</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Shipping:</span>
                    <span>$0.00</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold">
                    <span>Total:</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                
                <form action="{{ route('checkout.process') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-success w-100">Place Order</button>
                </form>
                
                <a href="{{ route('cart.index') }}" class="btn btn-secondary w-100 mt-2">Back to Cart</a>
            </div>
        </div>
    </div>
</div>
@endsection
