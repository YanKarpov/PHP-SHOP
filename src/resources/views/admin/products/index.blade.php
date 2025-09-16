@extends('admin.layout')

@section('title', 'Управление товарами')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Список товаров</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success">
        + Добавить товар
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Остаток</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price, 2) }} ₽</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-info">
                            👀
                        </a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-primary">
                            ✏️
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить товар?')">
                                🗑️
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $products->links() }}
</div>
@endsection