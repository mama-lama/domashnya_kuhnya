@extends('layouts.admin')

@section('title', isset($menuItem) ? 'Редактировать блюдо' : 'Добавить блюдо')

@php
  $categories = [
      'first' => 'Первые блюда',
      'second' => 'Вторые блюда',
      'salad' => 'Салаты',
      'side' => 'Гарниры',
      'bakery' => 'Выпечка',
      'drinks' => 'Напитки',
  ];
@endphp

@section('content')
<div class="card" style="max-width: 700px;">
  <div class="card-title">
    {{ isset($menuItem) ? 'Редактирование: ' . $menuItem->name : 'Добавление нового блюда' }}
  </div>

  <form method="POST" action="{{ isset($menuItem) ? route('admin.menu.update', $menuItem) : route('admin.menu.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($menuItem))
      @method('PUT')
    @endif

    <div class="form-group">
      <label for="name" class="form-label">Название блюда *</label>
      <input type="text" name="name" id="name" value="{{ old('name', $menuItem->name ?? '') }}" class="form-control" required />
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
      <div class="form-group" style="margin-bottom: 0;">
        <label for="price" class="form-label">Цена в рублях *</label>
        <input type="number" name="price" id="price" value="{{ old('price', $menuItem->price ?? '') }}" class="form-control" min="0" required />
      </div>

      <div class="form-group" style="margin-bottom: 0;">
        <label for="weight" class="form-label">Вес / Объем (например, "300 г" или "250 мл")</label>
        <input type="text" name="weight" id="weight" value="{{ old('weight', $menuItem->weight ?? '') }}" class="form-control" placeholder="300 г" />
      </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
      <div class="form-group" style="margin-bottom: 0;">
        <label for="category" class="form-label">Категория *</label>
        <select name="category" id="category" class="form-control" required>
          <option value="">-- Выберите категорию --</option>
          @foreach($categories as $value => $label)
            <option value="{{ $value }}" {{ (old('category', $menuItem->category ?? '') === $value) ? 'selected' : '' }}>
              {{ $label }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group" style="margin-bottom: 0;">
        <label for="tag" class="form-label">Тэг (акцент на карточке, например, "Хит" или "Сытно")</label>
        <input type="text" name="tag" id="tag" value="{{ old('tag', $menuItem->tag ?? '') }}" class="form-control" placeholder="Популярное" />
      </div>
    </div>

    <div class="form-group">
      <label for="description" class="form-label">Описание блюда</label>
      <textarea name="description" id="description" rows="3" class="form-control" style="resize: vertical;">{{ old('description', $menuItem->description ?? '') }}</textarea>
    </div>

    <div class="form-group">
      <label for="ingredients" class="form-label">Состав блюда</label>
      <textarea name="ingredients" id="ingredients" rows="2" class="form-control" placeholder="ингредиенты через запятую..." style="resize: vertical;">{{ old('ingredients', $menuItem->ingredients ?? '') }}</textarea>
    </div>

    <div class="form-group">
      <label class="form-label">Изображение блюда</label>
      
      @if(isset($menuItem) && $menuItem->image_url)
        <div style="margin-bottom: 12px; display: flex; align-items: center; gap: 14px;">
          <img src="{{ $menuItem->image_url }}" alt="Текущее изображение" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid var(--admin-border);" />
          <span style="font-size: 13px; color: var(--admin-text-muted);">Текущее изображение</span>
        </div>
      @endif

      <div style="display: flex; flex-direction: column; gap: 10px;">
        <div>
          <label for="image" class="form-label" style="font-size: 12px; color: var(--admin-text-muted);">Загрузить файл с компьютера (Рекомендуется)</label>
          <input type="file" name="image" id="image" class="form-control" accept="image/*" />
        </div>
        <div style="text-align: center; font-size: 12px; font-weight: 600; color: var(--admin-text-muted);">ИЛИ</div>
        <div>
          <label for="image_url" class="form-label" style="font-size: 12px; color: var(--admin-text-muted);">Ссылка на внешнее изображение (URL)</label>
          <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $menuItem->image_url ?? '') }}" class="form-control" placeholder="https://example.com/image.jpg" />
        </div>
      </div>
    </div>

    <div style="display: flex; gap: 12px; margin-top: 24px;">
      <button type="submit" class="btn btn-primary">{{ isset($menuItem) ? 'Сохранить изменения' : 'Добавить блюдо' }}</button>
      <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Отмена</a>
    </div>
  </form>
</div>
@endsection
