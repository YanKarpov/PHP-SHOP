@extends('layouts.app')

@section('content')
    <h1>Редактировать категорию</h1>

    @if ($errors->any())
        <div style="color:red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Название:</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}">
        <button type="submit">Обновить</button>
    </form>
@endsection
