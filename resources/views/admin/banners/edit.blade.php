@extends('admin.layout')

@section('title', 'Редактировать баннер')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Редактировать баннер</h1>
    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Назад
    </a>
</div>

<form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    @include('admin.banners.form')

    <div class="text-end">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Обновить
        </button>
    </div>
</form>
@endsection