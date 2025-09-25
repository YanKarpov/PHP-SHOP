# Крутое вступление
Наверное тут будет крутое описание нашего крутого проекта по PHP, ключевое, наверное...
Пока что тут просто танцующий Нико из OneShot.

![НикоDance](https://media.tenor.com/XyNq9PqC8FIAAAAi/niko-oneshot-niko-vibe.gif)

# Для моих симпапусиков-одногруппников
Все инструкции по работе с репозиторием см. в [CONTRIBUTING.md](CONTRIBUTING.md)


# Инструкция по развёртыванию
> **Предисловие**  
> Этот проект представляет собой групповое задание по созданию простого магазина, части которого разрабатывались разными людьми независимо.  
> Однако ветка **main** уже содержит рабочую сборку с Docker, поэтому для запуска достаточно следовать шагам ниже —  
> локально ставить PHP или Composer не требуется, всё запускается в контейнерах.

## 1. Клонируем репозиторий
```
git clone https://github.com/YanKarpov/PHP-SHOP.git
cd PHP-SHOP
```

## 2. Создаём файл окружения
```
cp .env.example .env
```
Важно: в .env указать настройки БД, соответствующие docker-compose.yml:

```
DB_HOST=mysql 
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

## 3. Собираем и запускаем контейнеры
```
docker-compose build    
docker-compose up -d
``` 

## 4. Устанавливаем PHP-зависимости
```
docker-compose exec php composer install
```

## 5. Генерируем ключ приложения
```
docker-compose exec php php artisan key:generate
```

## 6. Накатываем миграции и (опционально) сиды
```
docker-compose exec php php artisan migrate
docker-compose exec php php artisan db:seed
```

## 7. Победа
Если всё супер то - приложение будет доступно по адресу
http://localhost:8080
