\
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Админ — Контакты</title>
<style>
:root{--bg:#0f1117;--panel:#151924;--muted:#a7b3c0;--text:#e6edf3;--accent:#6ea8fe;--ok:#3fb950;--warn:#f0883e;--border:#252b36;}
*{box-sizing:border-box}
body{margin:0;background:var(--bg);color:var(--text);font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Ubuntu,"Helvetica Neue",Arial}
.container{max-width:1100px;margin:32px auto;padding:0 16px;}
h1{font-size:26px;margin:0 0 16px}
.table{width:100%;border-collapse:collapse;border:1px solid var(--border);border-radius:12px;overflow:hidden}
.table th,.table td{border-bottom:1px solid var(--border);padding:10px 12px;text-align:left;font-size:14px}
.table tr:hover{background:#141a27}
.controls{display:flex;gap:10px;align-items:center;margin-bottom:12px}
input[type=text]{width:100%;padding:10px;background:#0f1420;border:1px solid var(--border);border-radius:10px;color:var(--text);outline:none}
.btn{padding:10px 12px;border:1px solid var(--border);border-radius:10px;background:#1a2030;color:#e6edf3;text-decoration:none;display:inline-block}
.btn-primary{background:#182338}
.btn-danger{background:#2a1414;border-color:#3a1e1e;color:#ffb4b4}
.badge{display:inline-block;padding:2px 6px;border-radius:6px;border:1px solid #1f3b29;background:#11251a;color:var(--ok);font-size:11px}
.flash{padding:12px;border:1px solid var(--border);border-radius:10px;background:#152032;margin-bottom:12px}
</style>
</head>
<body>
<div class="container">
    <h1>Админ — Контакты</h1>

    @if(session('ok'))
        <div class="flash">{{ session('ok') }}</div>
    @endif

    <div class="controls">
        <a class="btn btn-primary" href="{{ route('admin.contacts.create') }}">+ Новая точка</a>
        <form method="get" action="{{ route('admin.contacts.index') }}" style="flex:1;display:flex;gap:8px">
            <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Поиск по названию/городу/адресу/телефону/email">
            <button class="btn" type="submit">Искать</button>
        </form>
        <a class="btn" href="{{ route('contacts.index') }}" target="_blank">Публичный список</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Город</th>
                <th>Адрес</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Активна</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse($locations as $loc)
            <tr>
                <td>{{ $loc->id }}</td>
                <td>{{ $loc->name }}</td>
                <td>{{ $loc->city }}</td>
                <td>{{ $loc->address }}</td>
                <td>{{ $loc->phone }}</td>
                <td>{{ $loc->email }}</td>
                <td>@if($loc->is_active)<span class="badge">да</span>@else нет @endif</td>
                <td style="white-space:nowrap">
                    <a class="btn" href="{{ route('admin.contacts.edit', $loc->id) }}">Изменить</a>
                    <form method="post" action="{{ route('admin.contacts.destroy', $loc->id) }}" style="display:inline" onsubmit="return confirm('Удалить точку?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="8">Пока нет точек.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top:10px">
        {{ $locations->links() }}
    </div>
</div>
</body>
</html>
