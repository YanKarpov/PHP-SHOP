@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Просмотр пункта меню</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $menu->title }}</h5>
            <p><strong>URL:</strong> {{ $menu->url }}</p>
            <p><strong>Родитель:</strong> {{ $menu->parent ? $menu->parent->title : 'Нет' }}</p>
            <p><strong>Порядок:</strong> {{ $menu->order }}</p>
            <p><strong>Создан:</strong> {{ $menu->created_at }}</p>
            <p><strong>Обновлен:</strong> {{ $menu->updated_at }}</p>
        </div>
    </div>

    <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary mt-3">Назад к списку</a>
</div>
@endsection