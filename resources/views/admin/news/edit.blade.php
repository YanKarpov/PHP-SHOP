@extends('layouts.app')

@section('content')
<h1>Редактировать новость</h1>

<form method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Заголовок:</label>
    <input type="text" name="title" value="{{ $news->title }}" required>

    <label>Текст:</label>
    <textarea name="content" required>{{ $news->content }}</textarea>

    <label>Изображение:</label>
    <input type="file" name="image">

    @if($news->image)
        <p>Текущее изображение:</p>
        <img src="{{ asset('storage/' . $news->image) }}" style="max-width: 300px;">
    @endif

    <button type="submit">Обновить</button>
</form>
@endsection