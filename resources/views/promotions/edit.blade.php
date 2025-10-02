<h1>Редактирование акции</h1>
<form action="{{ route('admin.promotions.update', $promotion->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $promotion->title }}">
    <input type="number" name="discount_percentage" value="{{ $promotion->discount_percentage }}">
    <input type="date" name="start_date" value="{{ $promotion->start_date }}">
    <input type="date" name="end_date" value="{{ $promotion->end_date }}">
    <button type="submit">Обновить</button>
</form>
<a href="{{ route('admin.promotions.index') }}">Назад</a>