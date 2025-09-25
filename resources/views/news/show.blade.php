@extends('layouts.app')

@section('content')
<h1>{{ $item->title }}</h1>

@if($item->image)
    <img src="{{ asset('storage/' . $item->image) }}" alt="Изображение новости" style="max-width: 600px;">
@endif

<p>{{ $item->content }}</p>
<a href="{{ route('news.index') }}">← Назад</a>
@endsection
