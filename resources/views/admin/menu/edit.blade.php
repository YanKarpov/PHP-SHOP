@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Редактировать пункт меню</h1>

    <form action="{{ route('admin.menu.update', $menu) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="title" class="form-label">Название</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $menu->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $menu->url) }}" required>
        </div>

        <div class="mb-3">
            <label for="parent_id" class="form-label">Родительский пункт</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">-- Без родителя --</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" {{ $menu->parent_id == $parent->id ? 'selected' : '' }}>
                        {{ $parent->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="order" class="form-label">Порядок</label>
            <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $menu->order) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection