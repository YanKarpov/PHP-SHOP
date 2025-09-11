<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <style>
        .banner-container {
            margin: 20px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        
        .banner-slider {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding: 10px;
        }
        
        .banner-item {
            flex: 0 0 auto;
            width: 300px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .banner-item:hover {
            transform: translateY(-5px);
        }
        
        .banner-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        
        .banner-content {
            padding: 15px;
        }
        
        .banner-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        
        .banner-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
        
        .banner-link {
            display: inline-block;
            padding: 8px 16px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s ease;
        }
        
        .banner-link:hover {
            background: #0056b3;
        }
        
        .no-banners {
            text-align: center;
            color: #999;
            font-style: italic;
            padding: 40px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Добро пожаловать на наш сайт</h1>
    </header>

    <main>
        <!-- Блок с рекламными баннерами -->
        <section class="banner-container">
            <h2>Специальные предложения Только для вас!</h2>
            
            @if($banners->count() > 0)
                <div class="banner-slider">
                    @foreach($banners as $banner)
                        <div class="banner-item">
                            <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" class="banner-image">
                            <div class="banner-content">
                                <h3 class="banner-title">{{ $banner->title }}</h3>
                                @if($banner->description)
                                    <p class="banner-description">{{ $banner->description }}</p>
                                @endif
                                @if($banner->link_url)
                                    <a href="{{ $banner->link_url }}" class="banner-link" target="_blank">
                                        Подробнее
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-banners">
                    <p>На данный момент предложений для вас нет</p>
                </div>
            @endif
        </section>

        <!-- Остальной контент главной страницы -->
        <section>
            <h2>Основной контент</h2>
            <p>основной контент главной страницы...</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2031 Ваш сайт. Все права  НЕ защищены.</p>
    </footer>
</body>
</html>