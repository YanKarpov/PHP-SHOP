@extends('admin.layout')

@section('title', 'Просмотр баннера')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Просмотр баннера</h1>
    <div>
        <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Редактировать
        </a>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Назад
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Основная информация</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>ID:</th>
                        <td>{{ $banner->id }}</td>
                    </tr>
                    <tr>
                        <th>Заголовок:</th>
                        <td>{{ $banner->title }}</td>
                    </tr>
                    <tr>
                        <th>Описание:</th>
                        <td>{{ $banner->description ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>URL ссылки:</th>
                        <td>{{ $banner->link_url ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Цель:</th>
                        <td>{{ $banner->target }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Изображение</h5>
                <img src="{{ $banner->image_url }}" alt="{{ $banner->alt_text }}" 
                     class="img-fluid rounded mb-3">
                <p><strong>Alt текст:</strong> {{ $banner->alt_text ?? '—' }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Настройки</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Тип:</th>
                        <td>{{ $banner->type }}</td>
                    </tr>
                    <tr>
                        <th>Позиция:</th>
                        <td>{{ $banner->position }}</td>
                    </tr>
                    <tr>
                        <th>Статус:</th>
                        <td>
                            <span class="badge bg-{{ $banner->is_active ? 'success' : 'danger' }}">
                                {{ $banner->is_active ? 'Активен' : 'Неактивен' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Дата начала:</th>
                        <td>{{ $banner->start_date ? $banner->start_date->format('d.m.Y H:i') : '—' }}</td>
                    </tr>
                    <tr>
                        <th>Дата окончания:</th>
                        <td>{{ $banner->end_date ? $banner->end_date->format('d.m.Y H:i') : '—' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection