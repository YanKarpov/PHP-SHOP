<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список категорий</title>
    <style>
        body { font-family: Arial, sans-serif; background: #ffffff; padding: 20px; }
        h1 { text-align: center; color: #333; }
        ul { max-width: 400px; margin: 0 auto; padding: 0; list-style: none; }
        li { background: #f8f5f5; margin-bottom: 10px; padding: 10px;
            border: 2px solid #333; border-radius: 9px; }
    </style>
</head>
<body>
<h1>Список категорий</h1>
<ul>
    @forelse($categories as $category)
        <li>{{ $category->name }}</li>
    @empty
        <li>Категории отсутствуют</li>
    @endforelse
</ul>
</body>
</html>

