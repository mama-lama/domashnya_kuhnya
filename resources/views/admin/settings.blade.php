@extends('layouts.admin')

@section('title', 'Настройки сайта')

@php
  // Mapping keys to friendly Russian labels
  $friendlyLabels = [
      'site_title' => 'Название сайта / заголовок страницы',
      'phone' => 'Контактный телефон (для отображения)',
      'phone_raw' => 'Контактный телефон (только цифры, для ссылки tel:)',
      'address' => 'Адрес кафе',
      'working_hours' => 'Часы работы',
      'hero_tag' => 'Мини-заголовок (тэг) на главном баннере',
      'hero_title' => 'Главный заголовок на баннере',
      'hero_description' => 'Описание на главном баннере',
  ];

  $groupNames = [
      'general' => 'Основные контакты',
      'hero' => 'Главный экран (Hero)',
  ];
@endphp

@section('content')
<div style="max-width: 800px;">
  <h1 style="font-size: 26px; font-weight: 700; margin-bottom: 24px;">Настройки сайта</h1>

  <form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf

    @foreach($settings as $group => $items)
    <div class="card">
      <div class="card-title" style="border-bottom: 1px solid var(--admin-border); padding-bottom: 10px;">
        {{ $groupNames[$group] ?? ucfirst($group) }}
      </div>
      
      @foreach($items as $item)
      <div class="form-group">
        <label for="setting_{{ $item->key }}" class="form-label">
          {{ $friendlyLabels[$item->key] ?? str_replace('_', ' ', ucfirst($item->key)) }}
        </label>
        
        @if(strlen($item->value) > 100 || $item->key === 'hero_description')
          <textarea 
            name="settings[{{ $item->key }}]" 
            id="setting_{{ $item->key }}" 
            rows="4" 
            class="form-control"
            style="resize: vertical;"
          >{{ old('settings.'.$item->key, $item->value) }}</textarea>
        @else
          <input 
            type="text" 
            name="settings[{{ $item->key }}]" 
            id="setting_{{ $item->key }}" 
            value="{{ old('settings.'.$item->key, $item->value) }}" 
            class="form-control" 
          />
        @endif
      </div>
      @endforeach
    </div>
    @endforeach

    <div style="margin-top: 10px;">
      <button type="submit" class="btn btn-primary" style="padding: 12px 24px; font-size: 15px;">Сохранить настройки</button>
    </div>
  </form>
</div>
@endsection
