@extends('layouts.shop')

@section('title', 'Shopping Cart')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Shopping Cart</h1>
    </div>
</div>

@if($cartItems->count() > 0)
<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->product->name }}</strong>
                            <br>
                            <small class="text-muted">{{ $item->product->description }}</small>
                        </td>
                        <td>${{ number_format($item->product->price, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="form-control form-control-sm" style="width: 80px;" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-dark">
                        <th colspan="3">Total</th>
                        <th>${{ number_format($total, 2) }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 text-end">
        <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">Continue Shopping</a>
        <a href="{{ route('checkout.index') }}" class="btn btn-success">Proceed to Checkout</a>
    </div>
</div>
@else
<div class="row">
    <div class="col-12 text-center">
        <h3>Your cart is empty</h3>
        <p class="text-muted">Add some products to get started!</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Browse Products</a>
    </div>
</div>
@endif
@endsection
