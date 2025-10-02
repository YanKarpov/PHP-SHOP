@extends('layouts.app')

@section('title', 'Добавить магазин')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">Добавить магазин</h1>

    <form action="{{ route('admin.stores.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="street" class="form-label">Улица</label>
            <input type="text" class="form-control" id="street" name="street" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Город</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>

        <div class="mb-3">
            <label for="postal_code" class="form-label">Почтовый индекс</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="mb-3">
            <label for="map_url" class="form-label">URL карты</label>
            <input type="url" class="form-control" id="map_url" name="map_url">
        </div>

        <div class="mb-3">
            <label class="form-label">Время работы (JSON)</label>
            <textarea class="form-control" name="working_hours" rows="5" placeholder='{"Пн-Пт": "10:00–20:00", "Сб": "11:00–19:00", "Вс": "выходной"}'></textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
            <label class="form-check-label" for="is_active">Активен</label>
        </div>

        <button type="submit" class="btn btn-primary">Создать</button>
        <a href="{{ route('admin.stores.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection
