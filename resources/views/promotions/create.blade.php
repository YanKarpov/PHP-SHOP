<h1>Создание новой акции</h1>
<form action="{{ route('admin.promotions.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Название">
    <input type="number" name="discount_percentage" placeholder="Скидка">
    <input type="date" name="start_date">
    <input type="date" name="end_date">
    <button type="submit">Сохранить</button>
</form>
<a href="{{ route('admin.promotions.index') }}">Назад</a>