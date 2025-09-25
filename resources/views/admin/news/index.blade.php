@extends('layouts.app')

@section('content')
<h1>🛠️ Админ-панель: Новости</h1>

<a href="{{ route('admin.news.create') }}" class="btn btn-success mb-3">➕ Добавить новость</a>

@foreach($news as $item)
    <div class="card mb-3">
        <div class="card-body">
            <h3>{{ $item->title }}</h3>
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" style="max-width: 300px;">
            @endif
            <p>{{ Str::limit($item->content, 150) }}</p>

            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-warning">✏️ Редактировать</a>

            <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Удалить?')">🗑️ Удалить</button>
            </form>
        </div>
    </div>
@endforeach

{{ $news->links() }}
@endsection
