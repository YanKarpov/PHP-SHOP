<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Заголовок *</label>
                    <input type="text" name="title" class="form-control" 
                           value="{{ old('title', $banner->title ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Описание</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $banner->description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">URL ссылки</label>
                    <input type="url" name="link_url" class="form-control" 
                           value="{{ old('link_url', $banner->link_url ?? '') }}">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Тип баннера *</label>
                            <select name="type" class="form-select" required>
                                @foreach($types as $value => $label)
                                <option value="{{ $value }}" 
                                    {{ old('type', $banner->type ?? '') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Позиция</label>
                            <input type="number" name="position" class="form-control" 
                                   value="{{ old('position', $banner->position ?? 0) }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Цель ссылки</label>
                            <select name="target" class="form-select">
                                <option value="_self" 
                                    {{ old('target', $banner->target ?? '') == '_self' ? 'selected' : '' }}>
                                    Текущее окно
                                </option>
                                <option value="_blank" 
                                    {{ old('target', $banner->target ?? '') == '_blank' ? 'selected' : '' }}>
                                    Новое окно
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Alt текст</label>
                            <input type="text" name="alt_text" class="form-control" 
                                   value="{{ old('alt_text', $banner->alt_text ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Изображение *</label>
                    <input type="file" name="image" class="form-control" 
                           {{ isset($banner) ? '' : 'required' }} accept="image/*">
                    
                    @if(isset($banner) && $banner->image_url)
                    <div class="mt-2">
                        <img src="{{ $banner->image_url }}" alt="Current image" 
                             class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                    @endif
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" 
                               {{ old('is_active', $banner->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label">Активный</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Дата начала</label>
                    <input type="datetime-local" name="start_date" class="form-control" 
                           value="{{ old('start_date', isset($banner->start_date) ? $banner->start_date->format('Y-m-d\TH:i') : '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Дата окончания</label>
                    <input type="datetime-local" name="end_date" class="form-control" 
                           value="{{ old('end_date', isset($banner->end_date) ? $banner->end_date->format('Y-m-d\TH:i') : '') }}">
                </div>
            </div>
        </div>
    </div>
</div>