<?php
// Simple PHP script to run the Laravel code without framework

require_once 'Модель';

// Create some fake stores
$stores = [
    new Store([
        'name' => 'Магазин Центральный',
        'street' => 'ул. Ленина, 10',
        'city' => 'Москва',
        'postal_code' => '101000',
        'phone' => '+7 (495) 123-45-67',
        'email' => 'central@store.ru',
        'map_url' => 'https://yandex.ru/maps/?text=Москва, ул. Ленина, 10',
        'working_hours' => [
            'Пн-Пт' => '10:00–20:00',
            'Сб' => '11:00–19:00',
            'Вс' => 'выходной',
        ],
        'is_active' => true,
    ]),
    new Store([
        'name' => 'Магазин Северный',
        'street' => 'пр. Победы, 25',
        'city' => 'Москва',
        'postal_code' => '102000',
        'phone' => '+7 (495) 987-65-43',
        'email' => 'north@store.ru',
        'map_url' => 'https://yandex.ru/maps/?text=Москва, пр. Победы, 25',
        'working_hours' => [
            'Пн-Пт' => '09:00–21:00',
            'Сб' => '10:00–20:00',
            'Вс' => '12:00–18:00',
        ],
        'is_active' => true,
    ]),
];

// Render the view
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты и адреса магазинов</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h1 class="mb-3">Контакты и адреса</h1>

    <?php if(empty($stores)): ?>
        <p>Пока нет активных магазинов.</p>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            <?php foreach($stores as $store): ?>
                <div class="col">
                    <section class="card h-100 p-3">
                        <h3 class="h5 mb-2"><?php echo htmlspecialchars($store->name); ?></h3>

                        <p class="mb-2">
                            <?php echo htmlspecialchars($store->getFullAddressAttribute()); ?>
                            <?php if($store->map_url): ?>
                                <br>
                                <a class="link-primary" href="<?php echo htmlspecialchars($store->map_url); ?>" target="_blank" rel="noopener">Открыть карту</a>
                            <?php endif; ?>
                        </p>

                        <?php if($store->phone): ?>
                            <p class="mb-1">
                                <strong>Телефон:</strong>
                                <a href="<?php echo htmlspecialchars($store->getTelephoneHrefAttribute()); ?>"><?php echo htmlspecialchars($store->phone); ?></a>
                            </p>
                        <?php endif; ?>

                        <?php if($store->email): ?>
                            <p class="mb-2">
                                <strong>E‑mail:</strong>
                                <a href="mailto:<?php echo htmlspecialchars($store->email); ?>"><?php echo htmlspecialchars($store->email); ?></a>
                            </p>
                        <?php endif; ?>

                        <?php if(!empty($store->working_hours)): ?>
                            <div>
                                <strong>Время работы:</strong>
                                <ul class="mb-0">
                                    <?php foreach($store->working_hours as $days => $hours): ?>
                                        <li>
                                            <span><?php echo htmlspecialchars($days); ?>:</span>
                                            <span><?php echo htmlspecialchars($hours); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </section>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
