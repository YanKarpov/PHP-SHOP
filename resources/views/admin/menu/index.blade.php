@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Управление меню</h1>
    
    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary mb-3">Добавить пункт меню</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>URL</th>
                <th>Родитель</th>
                <th>Порядок</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->title }}</td>
                <td>{{ $menu->url }}</td>
                <td>{{ $menu->parent ? $menu->parent->title : '-' }}</td>
                <td>{{ $menu->order }}</td>
                <td>
                    <a href="{{ route('admin.menu.show', $menu) }}" class="btn btn-info btn-sm">Просмотр</a>
                    <a href="{{ route('admin.menu.edit', $menu) }}" class="btn btn-warning btn-sm">Редактировать</a>
                    <form action="{{ route('admin.menu.destroy', $menu) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить?')">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection