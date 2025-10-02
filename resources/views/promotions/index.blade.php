<!DOCTYPE html>
<html>

<head>
    <title>Акции</title>
</head>

<body>
    <h1>Список акций</h1>
    @foreach($promotions as $promotion)
    <p>{{ $promotion->title }} - {{ $promotion->discount_percentage }}%</p>
    @endforeach
    <a href="{{ route('admin.promotions.create') }}">Создать новую</a>


    @foreach($promotions as $promotion)
    <li>
        <strong>{{ $promotion->title }}</strong> ({{ $promotion->discount_percentage }}%)
        <a href="{{ route('admin.promotions.show', $promotion) }}">Просмотр</a> |
        <a href="{{ route('admin.promotions.edit', $promotion) }}">Редактировать</a> |

        <form action="{{ route('admin.promotions.destroy', $promotion) }}"
            method="POST"
            style="display:inline"
            onsubmit="return confirm('Удалить эту акцию?');">
            @csrf
            @method('DELETE')
            <button type="submit">Удалить</button>
        </form>
    </li>
    @endforeach

</body>

</html>