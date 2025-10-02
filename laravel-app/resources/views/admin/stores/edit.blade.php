@extends('layouts.app')

@section('title', 'Редактировать магазин')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">Редактировать магазин</h1>

    <form action="{{ route('admin.stores.update', $store) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $store->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="street" class="form-label">Улица</label>
            <input type="text" class="form-control" id="street" name="street" value="{{ old('street', $store->street) }}" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Город</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $store->city) }}" required>
        </div>

        <div class="mb-3">
            <label for="postal_code" class="form-label">Почтовый индекс</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code', $store->postal_code) }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $store->phone) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $store->email) }}">
        </div>

        <div class="mb-3">
            <label for="map_url" class="form-label">URL карты</label>
            <input type="url" class="form-control" id="map_url" name="map_url" value="{{ old('map_url', $store->map_url) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Время работы (JSON)</label>
            <textarea class="form-control" name="working_hours" rows="5">{{ old('working_hours', json_encode($store->working_hours, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $store->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Активен</label>
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
        <a href="{{ route('admin.stores.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection
