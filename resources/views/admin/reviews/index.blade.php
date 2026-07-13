@extends('layouts.admin')

@section('title', 'Отзывы гостей')

@section('content')
<div class="card">
  <div class="card-title">
    <span>Управление отзывами</span>
    <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary">Добавить отзыв</a>
  </div>

  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Имя гостя</th>
          <th>Город</th>
          <th style="width: 40%;">Текст отзыва</th>
          <th>Оценка</th>
          <th>Статус публикации</th>
          <th style="width: 240px; text-align: right;">Действия</th>
        </tr>
      </thead>
      <tbody>
        @forelse($reviews as $review)
        <tr>
          <td style="font-weight: 600;">{{ $review->name }}</td>
          <td>{{ $review->city ?? '—' }}</td>
          <td>
            <div style="font-size: 14px; max-height: 80px; overflow-y: auto; color: var(--admin-text-main);">
              {{ $review->text }}
            </div>
          </td>
          <td style="color: #eab308; font-size: 16px; font-weight: 700; white-space: nowrap;">
            {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
          </td>
          <td>
            @if($review->is_active)
              <span class="badge badge-success">Опубликован</span>
            @else
              <span class="badge badge-secondary">Скрыт</span>
            @endif
          </td>
          <td style="text-align: right;">
            <div style="display: inline-flex; gap: 8px; justify-content: flex-end; align-items: center; flex-wrap: wrap;">
              <form action="{{ route('admin.reviews.toggle', $review) }}" method="POST" style="margin: 0;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-secondary" style="padding: 6px 12px; font-size: 13px;">
                  {{ $review->is_active ? 'Скрыть' : 'Опубликовать' }}
                </button>
              </form>
              <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-secondary" style="padding: 6px 12px; font-size: 13px;">Изменить</a>
              <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот отзыв?');" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 13px;">Удалить</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" style="text-align: center; padding: 40px 0; color: var(--admin-text-muted);">Отзывов пока нет. Добавьте первый отзыв!</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
