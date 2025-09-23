@extends('admin.layout')

@section('title', 'Управление баннерами')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Управление баннерами</h1>
    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Добавить баннер
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Изображение</th>
                        <th>Заголовок</th>
                        <th>Тип</th>
                        <th>Позиция</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td>
                            <img src="{{ $banner->image_url }}" alt="{{ $banner->alt_text }}" 
                                 style="width: 80px; height: 50px; object-fit: cover;">
                        </td>
                        <td>{{ $banner->title }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $banner->type }}</span>
                        </td>
                        <td>{{ $banner->position }}</td>
                        <td>
                            <span class="badge bg-{{ $banner->is_active ? 'success' : 'danger' }}">
                                {{ $banner->is_active ? 'Активен' : 'Неактивен' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.banners.show', $banner) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.banners.edit', $banner) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.banners.destroy', $banner) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Удалить баннер?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Баннеры не найдены</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $banners->links() }}
    </div>
</div>

@endsection 
