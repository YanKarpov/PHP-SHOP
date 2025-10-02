\
Contacts / Store Locations module (Laravel 7/8) — Public + Admin CRUD (Dark)
--------------------------------------------------------------------------

ПУБЛИЧНО:
  GET  /contacts           -> список точек
  GET  /contacts/{id}      -> страница одной точки
  GET  /api/contacts       -> JSON со списком активных точек

АДМИНКА (без auth по умолчанию):
  GET    /admin/contacts             -> список + поиск
  GET    /admin/contacts/create      -> форма создания
  POST   /admin/contacts             -> сохранить новую
  GET    /admin/contacts/{id}/edit   -> форма редактирования
  PUT    /admin/contacts/{id}        -> обновить
  DELETE /admin/contacts/{id}        -> удалить

Подключение маршрутов в routes/web.php:
  // Laravel 7 public + admin:
  require_once base_path('routes/contacts.php');
  require_once base_path('routes/admin_contacts.php');

  // ИЛИ Laravel 8+ public + admin:
  require_once base_path('routes/contacts_l8.php');
  require_once base_path('routes/admin_contacts_l8.php');

Дальше:
  php artisan migrate
  php artisan db:seed --class=StoreLocationSeeder   # опционально
  Откройте: /contacts и /admin/contacts

Примечания:
  - Модели даны в двух вариантах: app/StoreLocation.php (L7) и app/Models/StoreLocation.php (L8).
  - Если в проекте включён auth — оберните админ-маршруты: Route::middleware('auth')->group(...).
  - Стили — тёмные, без внешних зависимостей.
