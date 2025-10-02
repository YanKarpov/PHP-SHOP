@extends('layouts.app')

@section('content')
    <h1>Категории</h1>

    <a href="{{ route('admin.categories.create') }}">Добавить категорию</a>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Действия</th>
        </tr>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id) }}">Редактировать</a> |
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Удалить категорию?')">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $categories->links() }}
@endsection
