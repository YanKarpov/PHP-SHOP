@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Добавить пункт меню</h1>

    <form action="{{ route('admin.menu.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Название</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="text" class="form-control" id="url" name="url" required>
        </div>

        <div class="mb-3">
            <label for="parent_id" class="form-label">Родительский пункт</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">-- Без родителя --</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="order" class="form-label">Порядок</label>
            <input type="number" class="form-control" id="order" name="order" value="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Создать</button>
        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection