@extends('layouts.app')

@section('title', 'Просмотр магазина')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">{{ $store->name }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Информация о магазине</h5>
            <p><strong>Адрес:</strong> {{ $store->getFullAddressAttribute() }}</p>
            <p><strong>Телефон:</strong> {{ $store->phone }}</p>
            <p><strong>Email:</strong> {{ $store->email }}</p>
            <p><strong>Карта:</strong> <a href="{{ $store->map_url }}" target="_blank">{{ $store->map_url }}</a></p>
            <p><strong>Время работы:</strong></p>
            <ul>
                @foreach($store->working_hours as $day => $hours)
                    <li>{{ $day }}: {{ $hours }}</li>
                @endforeach
            </ul>
            <p><strong>Активен:</strong> {{ $store->is_active ? 'Да' : 'Нет' }}</p>
        </div>
    </div>

    <a href="{{ route('admin.stores.edit', $store) }}" class="btn btn-warning mt-3">Редактировать</a>
    <a href="{{ route('admin.stores.index') }}" class="btn btn-secondary mt-3">Назад</a>
</div>
@endsection
