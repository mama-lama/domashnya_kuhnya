@extends('layouts.admin')

@section('title', 'Меню блюд')

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
<div class="card">
  <div class="card-title">
    <span>Управление меню</span>
    <div style="display: flex; gap: 10px; align-items: center;">
      <a href="{{ route('admin.menu.preview') }}" target="_blank" class="btn btn-secondary" style="border: 1px solid var(--admin-border); font-size: 13px; text-decoration: none;">
        👁️ Предпросмотр шаблона
      </a>
      <a href="/menu.pdf" target="_blank" class="btn btn-secondary" style="border: 1px solid var(--admin-border); font-size: 13px; text-decoration: none;">
        📥 Скачать PDF
      </a>
      <form action="{{ route('admin.menu.pdf') }}" method="POST" style="margin: 0;">
        @csrf
        <button type="submit" class="btn btn-secondary" style="border: 1px solid var(--admin-border); font-size: 13px; cursor: pointer;">
          ⚙️ Перегенерировать в фоне
        </button>
      </form>
      <a href="{{ route('admin.menu.create') }}" class="btn btn-primary" style="font-size: 13px;">Добавить блюдо</a>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th style="width: 80px;">Фото</th>
          <th>Название</th>
          <th>Категория</th>
          <th>Цена</th>
          <th>Вес/Объем</th>
          <th>Тег</th>
          <th style="width: 160px; text-align: right;">Действия</th>
        </tr>
      </thead>
      <tbody>
        @forelse($menuItems as $item)
        <tr>
          <td>
            @if($item->image_url)
              <img src="{{ $item->image_url }}" alt="{{ $item->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid var(--admin-border);" />
            @else
              <div style="width: 50px; height: 50px; background-color: #f1f5f9; border-radius: 8px; display: grid; place-items: center; font-size: 20px; color: var(--admin-text-muted);">🍽️</div>
            @endif
          </td>
          <td>
            <div style="font-weight: 600; font-size: 15px;">{{ $item->name }}</div>
            <div style="font-size: 13px; color: var(--admin-text-muted); max-width: 320px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">{{ $item->description }}</div>
          </td>
          <td>
            <span class="badge badge-secondary" style="background-color: #e2e8f0; color: #334155;">
              {{ $categories[$item->category] ?? $item->category }}
            </span>
          </td>
          <td style="font-weight: 700; color: var(--admin-primary);">{{ $item->price }} ₽</td>
          <td>{{ $item->weight }}</td>
          <td>
            @if($item->tag)
              <span class="badge badge-success" style="background-color: #eef4e2; color: var(--admin-primary-hover);">{{ $item->tag }}</span>
            @else
              <span style="color: var(--admin-text-muted); font-size: 13px;">—</span>
            @endif
          </td>
          <td style="text-align: right;">
            <div style="display: inline-flex; gap: 8px; justify-content: flex-end; align-items: center;">
              <a href="{{ route('admin.menu.edit', $item) }}" class="btn btn-secondary" style="padding: 6px 12px; font-size: 13px;">Изменить</a>
              <form action="{{ route('admin.menu.destroy', $item) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить это блюдо?');" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 13px;">Удалить</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" style="text-align: center; padding: 40px 0; color: var(--admin-text-muted);">В меню пока нет блюд. Добавьте первое блюдо!</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
