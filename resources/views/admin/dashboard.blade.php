@extends('layouts.admin')

@section('title', 'Панель управления')

@section('content')
<h1 style="font-size: 26px; font-weight: 700; margin-bottom: 24px;">Обзор системы</h1>

<!-- Metric stats grid -->
<div class="grid-3" style="margin-bottom: 30px;">
  <div class="card" style="display: flex; flex-direction: column; justify-content: space-between; min-height: 120px; margin-bottom: 0;">
    <div style="color: var(--admin-text-muted); font-size: 14px; font-weight: 600;">Блюд в меню</div>
    <div style="font-size: 32px; font-weight: 800; color: var(--admin-primary); margin-top: 8px;">{{ $menuCount }}</div>
  </div>
  <div class="card" style="display: flex; flex-direction: column; justify-content: space-between; min-height: 120px; margin-bottom: 0;">
    <div style="color: var(--admin-text-muted); font-size: 14px; font-weight: 600;">Всего отзывов</div>
    <div style="font-size: 32px; font-weight: 800; color: #c78d56; margin-top: 8px;">{{ $reviewCount }}</div>
  </div>
  <div class="card" style="display: flex; flex-direction: column; justify-content: space-between; min-height: 120px; margin-bottom: 0;">
    <div style="color: var(--admin-text-muted); font-size: 14px; font-weight: 600;">Опубликованных отзывов</div>
    <div style="font-size: 32px; font-weight: 800; color: #15803d; margin-top: 8px;">{{ $activeReviewCount }}</div>
  </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
  <!-- Latest reviews card -->
  <div class="card">
    <div class="card-title">Последние отзывы</div>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Имя</th>
            <th>Город</th>
            <th>Рейтинг</th>
            <th>Статус</th>
            <th>Действия</th>
          </tr>
        </thead>
        <tbody>
          @forelse($latestReviews as $review)
          <tr>
            <td style="font-weight: 600;">{{ $review->name }}</td>
            <td>{{ $review->city }}</td>
            <td style="color: #eab308; font-weight: 700;">{{ str_repeat('★', $review->rating) }}</td>
            <td>
              @if($review->is_active)
                <span class="badge badge-success">Активен</span>
              @else
                <span class="badge badge-secondary">Скрыт</span>
              @endif
            </td>
            <td>
              <form action="{{ route('admin.reviews.toggle', $review) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px;">
                  {{ $review->is_active ? 'Скрыть' : 'Показать' }}
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" style="text-align: center; color: var(--admin-text-muted);">Отзывов пока нет</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Quick Actions Card -->
  <div class="card" style="display: flex; flex-direction: column; gap: 14px;">
    <div class="card-title" style="margin-bottom: 10px;">Быстрые действия</div>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary" style="width: 100%;">Добавить блюдо</a>
    <a href="{{ route('admin.settings') }}" class="btn btn-secondary" style="width: 100%;">Редактировать контакты</a>
    <a href="/" target="_blank" class="btn btn-secondary" style="width: 100%; border: 1px solid var(--admin-border);">Открыть сайт</a>
  </div>
</div>
@endsection
