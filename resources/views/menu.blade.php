<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Меню интернет-магазина</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background:rgba(248, 249, 250, 0.88);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            font-family: Arial, sans-serif;
            position: relative;
        }

        .main-menu {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }

        .menu-list {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        .menu-item {
            position: relative;
        }

        .menu-link {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
            display: block;
        }

        .menu-link:hover {
            color:rgb(101, 28, 134);
            background: #e9ecef;
            border-radius: 4px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            position: absolute;
            left: 2rem;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, rgb(183, 0, 255), rgb(98, 0, 179));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            box-shadow: 0 4px 15px rgba(162, 0, 255, 0.3);
        }

        .logo-text {
            color: #333;
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .logo-subtext {
            color: rgb(235, 185, 0);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .admin-link {
            position: absolute;
            right: 2rem;
            top: 50%;
            transform: translateY(-50%);
            background:rgb(123, 0, 172);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .admin-link:hover {
            background: rgb(98, 0, 179);
            color: white;
        }

        .submenu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            list-style: none;
            padding: 0.5rem 0;
            min-width: 200px;
            display: none;
            z-index: 1000;
            border-radius: 4px;
        }

        .menu-item:hover .submenu {
            display: block;
        }

        .submenu-item {
            padding: 0;
        }

        .submenu-link {
            display: block;
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: #333;
            transition: background 0.3s ease;
        }

        .submenu-link:hover {
            background: #f8f9fa;
        }

        @media (max-width: 968px) {
            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .logo {
                margin-right: 0;
                margin-bottom: 1rem;
                justify-content: center;
            }
            
            .menu-list {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .submenu {
                position: static;
                box-shadow: none;
                margin-left: 1rem;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }
            
            .logo-text {
                font-size: 1.3rem;
            }
            
            .logo-icon {
                width: 35px;
                height: 35px;
                font-size: 16px;
            }

            .admin-link {
                position: static;
                transform: none;
                margin-top: 1rem;
            }
        }

    </style>
</head>
<body>
    <header class="header">
        <a href="/menu" class="logo">
            <div class="logo-icon">IT</div>
            <div>
                <div class="logo-text">IT-11.23</div>
                <div class="logo-subtext">Menu made by Aniwylle</div>
            </div>
        </a>
        
        <nav class="main-menu">
            <ul class="menu-list">
                @foreach($menuItems as $item)
                    <li class="menu-item {{ $item->children->count() > 0 ? 'has-dropdown' : '' }}">
                        <a href="{{ $item->url }}" class="menu-link">
                            {{ $item->title }}
                        </a>
                        
                        @if($item->children->count() > 0)
                            <ul class="submenu">
                                @foreach($item->children as $child)
                                    <li class="submenu-item">
                                        <a href="{{ $child->url }}" class="submenu-link">
                                            {{ $child->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>

        <a href="{{ route('admin.menu.index') }}" class="admin-link">Админ-панель</a>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>