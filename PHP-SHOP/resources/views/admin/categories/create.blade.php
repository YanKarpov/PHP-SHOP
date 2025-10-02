@extends('layouts.app')

@section('content')
    <h1>Добавить категорию</h1>

    @if ($errors->any())
        <div style="color:red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <label>Название:</label>
        <input type="text" name="name" value="{{ old('name') }}">
        <button type="submit">Сохранить</button>
    </form>
@endsection
