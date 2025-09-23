<!-- resources/views/promotions/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Активные акции нашего магазина</title>
</head>

<body>




    @php
    // Если $promotions не передан или равен null, заменяем на пустой массив
    $promotions = $promotions ?? [];
    @endphp

    @if(count($promotions) > 0)
    <h1>Наши акции!</h1>
    <ul>
        @foreach ($promotions as $promotion)
        <li>
            <strong>{{ $promotion->title }}</strong><br />
            <small>(скидка {{ $promotion->discount_percentage }}%)</small><br />
            {{ $promotion->description }}
        </li>
        @endforeach
    </ul>
    @else
    <p>Сейчас никаких акций нет :(</p>
    @endif

</body>

</html>