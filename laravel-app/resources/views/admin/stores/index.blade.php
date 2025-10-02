@extends('layouts.app')

@section('title', 'Управление магазинами')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">Управление магазинами</h1>

    <a href="{{ route('admin.stores.create') }}" class="btn btn-primary mb-3">Добавить магазин</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Город</th>
                    <th>Телефон</th>
                    <th>Активен</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stores as $store)
                    <tr>
                        <td>{{ $store->id }}</td>
                        <td>{{ $store->name }}</td>
                        <td>{{ $store->city }}</td>
                        <td>{{ $store->phone }}</td>
                        <td>{{ $store->is_active ? 'Да' : 'Нет' }}</td>
                        <td>
                            <a href="{{ route('admin.stores.show', $store) }}" class="btn btn-sm btn-info">Просмотр</a>
                            <a href="{{ route('admin.stores.edit', $store) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <form action="{{ route('admin.stores.destroy', $store) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Нет магазинов</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
