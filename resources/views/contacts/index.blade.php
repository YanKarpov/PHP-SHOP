\
@php $title = 'Контакты и адреса магазинов'; @endphp
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <style>
        :root{--bg:#0f1117;--panel:#151924;--muted:#a7b3c0;--text:#e6edf3;--accent:#6ea8fe;--ok:#3fb950;--border:#252b36;}
        *{box-sizing:border-box}
        body{margin:0;background:var(--bg);color:var(--text);font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Ubuntu,"Helvetica Neue",Arial}
        .container{max-width:1100px;margin:32px auto;padding:0 16px;}
        h1{font-size:28px;margin:0 0 18px}
        .top{display:flex;gap:12px;align-items:center;justify-content:space-between;margin-bottom:16px}
        .search{flex:1;display:flex;gap:8px}
        .search input{flex:1;padding:12px;border-radius:10px;border:1px solid var(--border);background:var(--panel);color:var(--text);outline:none}
        .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:14px}
        .card{background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0));border:1px solid var(--border);border-radius:14px;padding:16px}
        .name{font-weight:600;font-size:18px;margin:0 0 8px;color:#fff}
        .city{color:var(--muted);font-size:13px;margin-bottom:8px}
        .row{margin:6px 0;font-size:14px}
        a{color:var(--accent);text-decoration:none}
        .badge{display:inline-block;margin-left:6px;padding:2px 6px;border-radius:6px;background:#11251a;border:1px solid #1f3b29;color:var(--ok);font-size:11px;vertical-align:middle}
        .muted{color:var(--muted)}
        .btn{padding:10px 12px;border:1px solid var(--border);border-radius:10px;background:#1a2030;color:#e6edf3}
    </style>
</head>
<body>
<div class="container">
    <div class="top">
        <h1>{{ $title }}</h1>
        <a class="btn" href="{{ route('contacts.json') }}" target="_blank" rel="noopener">JSON</a>
    </div>

    <form class="search" method="get" action="{{ route('contacts.index') }}">
        <input name="q" value="{{ $q ?? '' }}" placeholder="Поиск: город, улица, телефон…">
    </form>

    @if($locations->isEmpty())
        <p class="muted">Адреса пока не добавлены.</p>
    @else
    <div class="grid">
        @foreach($locations as $loc)
            <div class="card">
                <div class="name">
                    <a href="{{ route('contacts.show', $loc->id) }}">{{ $loc->name }}</a>
                    @if($loc->is_active)<span class="badge">работает</span>@endif
                </div>
                @if($loc->city)<div class="city">{{ $loc->city }}</div>@endif
                <div class="row">📍 {{ $loc->address }}</div>
                @if($loc->phone)<div class="row">📞 <a href="tel:{{ preg_replace('/\s+/', '', $loc->phone) }}">{{ $loc->phone }}</a></div>@endif
                @if($loc->email)<div class="row">✉️ <a href="mailto:{{ $loc->email }}">{{ $loc->email }}</a></div>@endif
                @if($loc->lat && $loc->lng)
                    <div class="row">🗺 <a target="_blank" rel="noopener" href="https://www.google.com/maps?q={{ $loc->lat }},{{ $loc->lng }}">Открыть в картах</a></div>
                @endif
            </div>
        @endforeach
    </div>
    @endif
</div>
</body>
</html>
