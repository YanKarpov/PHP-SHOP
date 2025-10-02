<h1>Акции (админка)</h1>

<a href="{{ route('admin.promotions.create') }}">Добавить акцию</a>

<ul>
    @foreach($promotions as $promotion)
    <li>
        <strong>{{ $promotion->title }}</strong> ({{ $promotion->discount_percentage }}%)
        <a href="{{ route('admin.promotions.show', $promotion) }}">Просмотр</a> |
        <a href="{{ route('admin.promotions.edit', $promotion) }}">Редактировать</a> |
        <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Удалить</button>
        </form>
    </li>
    @endforeach
</ul>