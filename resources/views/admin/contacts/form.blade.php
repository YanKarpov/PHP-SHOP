\
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Админ — {{ $location->exists ? 'Редактировать' : 'Создать' }} точку</title>
<style>
:root{--bg:#0f1117;--panel:#151924;--muted:#a7b3c0;--text:#e6edf3;--accent:#6ea8fe;--ok:#3fb950;--warn:#f0883e;--border:#252b36;}
*{box-sizing:border-box}
body{margin:0;background:var(--bg);color:var(--text);font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Ubuntu,"Helvetica Neue",Arial}
.container{max-width:1100px;margin:32px auto;padding:0 16px;}
h1{font-size:26px;margin:0 0 16px}
input[type=text], input[type=email], input[type=number], textarea{width:100%;padding:10px;background:#0f1420;border:1px solid var(--border);border-radius:10px;color:var(--text);outline:none}
select{padding:10px;background:#0f1420;border:1px solid var(--border);border-radius:10px;color:var(--text)}
.btn{padding:10px 12px;border:1px solid var(--border);border-radius:10px;background:#1a2030;color:#e6edf3;text-decoration:none;display:inline-block}
.btn-primary{background:#182338}
.flash{padding:12px;border:1px solid var(--border);border-radius:10px;background:#152032;margin-bottom:12px}
</style>
</head>
<body>
<div class="container">
    <h1>{{ $location->exists ? 'Редактировать' : 'Создать' }} точку</h1>

    <form method="post" action="{{ $location->exists ? route('admin.contacts.update', $location->id) : route('admin.contacts.store') }}">
        @csrf
        @if($location->exists) @method('PUT') @endif

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
            <div>
                <label>Название</label>
                <input type="text" name="name" value="{{ old('name', $location->name) }}" required>
            </div>
            <div>
                <label>Город</label>
                <input type="text" name="city" value="{{ old('city', $location->city) }}">
            </div>
            <div>
                <label>Адрес</label>
                <input type="text" name="address" value="{{ old('address', $location->address) }}" required>
            </div>
            <div>
                <label>Телефон</label>
                <input type="text" name="phone" value="{{ old('phone', $location->phone) }}">
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $location->email) }}">
            </div>
            <div>
                <label>Широта (lat)</label>
                <input type="number" step="0.0000001" name="lat" value="{{ old('lat', $location->lat) }}">
            </div>
            <div>
                <label>Долгота (lng)</label>
                <input type="number" step="0.0000001" name="lng" value="{{ old('lng', $location->lng) }}">
            </div>
            <div>
                <label>Активно</label>
                <select name="is_active">
                    <option value="1" {{ old('is_active', $location->is_active ? 1 : 0)==1 ? 'selected' : '' }}>Да</option>
                    <option value="0" {{ old('is_active', $location->is_active ? 1 : 0)==0 ? 'selected' : '' }}>Нет</option>
                </select>
            </div>
            <div style="grid-column:1/-1">
                <label>Часы работы (JSON: {"{"}"mon":"10:00-22:00","tue":"10:00-22:00"{"}"})</label>
                <textarea name="hours_json" rows="5" placeholder='{{ "{\"mon\":\"10:00-22:00\",\"tue\":\"10:00-22:00\"}" }}'>{{ old('hours_json', $location->hours ? json_encode($location->hours, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) : '') }}</textarea>
            </div>
        </div>

        @if ($errors->any())
            <div class="flash" style="border-color:#5b2a2a;background:#24161a;margin-top:12px">
                <b>Ошибки:</b>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="margin-top:14px;display:flex;gap:10px">
            <button class="btn btn-primary" type="submit">{{ $location->exists ? 'Сохранить' : 'Создать' }}</button>
            <a class="btn" href="{{ route('admin.contacts.index') }}">Отмена</a>
        </div>
    </form>
</div>
</body>
</html>
