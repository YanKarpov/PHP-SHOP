\
@php $title = $location->name; @endphp
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <style>
        :root{ --bg:#0f1117; --panel:#151924; --muted:#a7b3c0; --text:#e6edf3; --border:#252b36; --accent:#6ea8fe;}
        body{margin:0;background:var(--bg);color:var(--text);font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Ubuntu,"Helvetica Neue",Arial}
        .container{max-width:900px;margin:32px auto;padding:0 16px;}
        a{color:var(--accent);text-decoration:none}
        .card{background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0));border:1px solid var(--border);border-radius:14px;padding:16px}
        .back{display:inline-block;margin-bottom:14px}
        .title{font-size:24px;font-weight:700;margin:0 0 10px}
        .city{color:var(--muted);font-size:13px;margin-bottom:10px}
        .row{margin:6px 0;font-size:15px}
        iframe{width:100%;height:360px;border:1px solid var(--border);border-radius:12px}
    </style>
</head>
<body>
<div class="container">
    <a href="{{ route('contacts.index') }}" class="back">← Назад к списку</a>
    <div class="card">
        <div class="title">{{ $location->name }}</div>
        @if($location->city)<div class="city">{{ $location->city }}</div>@endif
        <div class="row">📍 {{ $location->address }}</div>
        @if($location->phone)<div class="row">📞 <a href="tel:{{ preg_replace('/\s+/', '', $location->phone) }}">{{ $location->phone }}</a></div>@endif
        @if($location->email)<div class="row">✉️ <a href="mailto:{{ $location->email }}">{{ $location->email }}</a></div>@endif

        @if(!empty($location->hours))
            <div class="row">⏰
                @php $days = ['mon'=>'Пн','tue'=>'Вт','wed'=>'Ср','thu'=>'Чт','fri'=>'Пт','sat'=>'Сб','sun'=>'Вс']; @endphp
                <ul>
                    @foreach($days as $k=>$v)
                        @if(isset($location->hours[$k]))
                            <li>{{ $v }}: {{ $location->hours[$k] }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

        @if($location->lat && $location->lng)
            <div class="row">
                <iframe loading="lazy"
                    src="https://maps.google.com/maps?q={{ $location->lat }},{{ $location->lng }}&z=14&output=embed"></iframe>
            </div>
            <div class="row">🗺 <a target="_blank" rel="noopener" href="https://www.google.com/maps?q={{ $location->lat }},{{ $location->lng }}">Открыть в Google Картах</a></div>
        @endif
    </div>
</div>
</body>
</html>
