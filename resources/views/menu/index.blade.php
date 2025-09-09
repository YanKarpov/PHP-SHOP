<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Меню</title>
    <style>
        ul { list-style-type: none; padding-left: 0; }
        li { margin: 4px 0; }
        .submenu { margin-left: 20px; }
    </style>
</head>
<body>
    <h1>Меню</h1>

    <ul>
        @foreach($menuItems as $item)
            <li>
                <a href="{{ $item->url ?? '#' }}">{{ $item->name }}</a>

                @if ($item->children->isNotEmpty())
                    <ul class="submenu">
                        @foreach ($item->children as $child)
                            <li><a href="{{ $child->url ?? '#' }}">{{ $child->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>