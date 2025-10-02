Contacts / Store Locations module (Laravel 7)
-------------------------------------------
Routes:
  GET  /contacts           -> список точек
  GET  /contacts/{id}      -> страница одной точки
  GET  /api/contacts       -> JSON список

Установка:
  1) Скопируйте содержимое в корень вашего Laravel-проекта.
  2) В routes/web.php добавьте:
       require_once base_path('routes/contacts.php');
  3) Выполните:
       php artisan migrate
       php artisan db:seed --class=StoreLocationSeeder   # опционально
  4) Откройте /contacts

Примечание: модуль рассчитан на Laravel 7 (контроллеры строкой 'Controller@method').
Если используете Laravel 8+, можно заменить на [Controller::class, 'method'].


---
Laravel 8+ подключение:
  1) Используйте модель app/Models/StoreLocation.php
  2) Подключите маршруты: require_once base_path('routes/contacts_l8.php');
  3) Контроллер: App\Http\Controllers\StoreLocationControllerL8
