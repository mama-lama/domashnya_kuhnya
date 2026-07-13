@extends('layouts.admin')

@section('title', isset($review) ? 'Редактировать отзыв' : 'Добавить отзыв')

@section('content')
<div class="card" style="max-width: 600px;">
  <div class="card-title">
    {{ isset($review) ? 'Редактирование отзыва' : 'Добавление нового отзыва' }}
  </div>

  <form method="POST" action="{{ isset($review) ? route('admin.reviews.update', $review) : route('admin.reviews.store') }}">
    @csrf
    @if(isset($review))
      @method('PUT')
    @endif

    <div class="form-group">
      <label for="name" class="form-label">Имя гостя *</label>
      <input type="text" name="name" id="name" value="{{ old('name', $review->name ?? '') }}" class="form-control" required />
    </div>

    <div class="form-group">
      <label for="city" class="form-label">Город гостя (например, "Москва")</label>
      <input type="text" name="city" id="city" value="{{ old('city', $review->city ?? '') }}" class="form-control" placeholder="Ростов-на-Дону" />
    </div>

    <div class="form-group">
      <label for="rating" class="form-label">Оценка (от 1 до 5 звезд) *</label>
      <select name="rating" id="rating" class="form-control" required>
        @for($i = 5; $i >= 1; $i--)
          <option value="{{ $i }}" {{ (old('rating', $review->rating ?? 5) == $i) ? 'selected' : '' }}>
            {{ str_repeat('★', $i) }} ({{ $i }} звезд)
          </option>
        @endfor
      </select>
    </div>

    <div class="form-group">
      <label for="text" class="form-label">Текст отзыва *</label>
      <textarea name="text" id="text" rows="5" class="form-control" style="resize: vertical;" required>{{ old('text', $review->text ?? '') }}</textarea>
    </div>

    <div class="form-group" style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
      <input 
        type="checkbox" 
        name="is_active" 
        id="is_active" 
        value="1" 
        {{ old('is_active', $review->is_active ?? true) ? 'checked' : '' }} 
        style="width: 18px; height: 18px; cursor: pointer;"
      />
      <label for="is_active" class="form-label" style="margin-bottom: 0; cursor: pointer; font-weight: 500;">
        Опубликовать на сайте (сделать активным)
      </label>
    </div>

    <div style="display: flex; gap: 12px; margin-top: 24px;">
      <button type="submit" class="btn btn-primary">{{ isset($review) ? 'Сохранить изменения' : 'Добавить отзыв' }}</button>
      <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Отмена</a>
    </div>
  </form>
</div>
@endsection
