<h1>{{ $promotion->title }}</h1>
<p>Скидка: {{ $promotion->discount_percentage }}%</p>
<p>Начало: {{ $promotion->start_date }}</p>
<p>Конец: {{ $promotion->end_date }}</p>
<a href="{{ route('admin.promotions.index') }}">Назад</a>