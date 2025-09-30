@extends('layouts.app')

@section('content')
<h1>Добавить новость</h1>

<form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
    @csrf

    <label>Заголовок:</label>
    <input type="text" name="title" required>

    <label>Текст:</label>
    <textarea name="content" required></textarea>

    <label>Изображение:</label>
    <input type="file" name="image">

    <button type="submit">Сохранить</button>
</form>
@endsection
