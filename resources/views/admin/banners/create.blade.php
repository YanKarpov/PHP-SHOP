@extends('admin.layout')

@section('title', 'Добавить баннер')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Добавить баннер</h1>
    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Назад
    </a>
</div>

<form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    @include('admin.banners.form')

    <div class="text-end">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Сохранить
        </button>
    </div>
</form>
@endsection