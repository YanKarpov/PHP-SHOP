<?php
try {

    $pdo = new PDO('sqlite:cat.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Ошибка подключения к базе: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список категорий</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            display: flex;
            gap: 10px;
        }
        input[type="text"] {
            flex: 1;
            padding: 8px;
            border: 1px solid #e4a7e8;
            border-radius: 4px;
        }
        button {
            padding: 9px 16px;
            background-color: #d05ad8;
            color: rgba(228, 167, 232, 0.85);
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #9c2fa3;
        }
        ul {
            max-width: 400px;
            margin: 0 auto;
            padding: 0;
            list-style: none;
        }
        li {
            background-color: #f8f5f5;
            margin-bottom: 10px;
            padding: 10px;
            border: 4px solid;
            border-color: #333;
            border-radius: 9px;
        }
    </style>
</head>
<body>
<h1>Список категорий</h1>

<ul>
    <?php if ($categories): ?>
        <?php foreach ($categories as $row): ?>
            <li><?= htmlspecialchars($row['name']) ?></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Категории отсутствуют</li>
    <?php endif; ?>
</ul>
</body>
</html>