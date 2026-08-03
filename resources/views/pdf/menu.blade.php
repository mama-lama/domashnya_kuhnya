<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <style>
    @page {
      size: A4 portrait;
      margin: 15px;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      color: #26301f;
      background: #fffdf4;
      font-family: "DejaVu Sans", sans-serif;
      font-size: 10px;
      line-height: 1.35;
    }

    .cover {
      height: 1060px;
      overflow: hidden;
      page-break-after: always;
      border: 1px solid #dce4cc;
      border-radius: 30px;
      background: #fbf7e8;
      position: relative;
    }

    .cover-accent-top {
      position: absolute;
      top: -54px;
      left: -46px;
      width: 220px;
      height: 220px;
      border-radius: 110px;
      background: #e8ddbd;
    }

    .cover-accent-bottom {
      position: absolute;
      right: -68px;
      bottom: -72px;
      width: 230px;
      height: 230px;
      border: 20px solid #d9e2c4;
      border-radius: 115px;
    }

    .cover-content {
      padding: 180px 48px 0;
    }

    .eyebrow {
      margin-bottom: 20px;
      color: #52782a;
      font-size: 16px;
      font-weight: bold;
      letter-spacing: 2px;
      text-transform: uppercase;
    }

    .eyebrow-line {
      display: inline-block;
      width: 34px;
      margin-right: 10px;
      border-top: 1px solid #52782a;
      vertical-align: middle;
    }

    .cover-title {
      max-width: 560px;
      margin: 0;
      color: #2e431b;
      font-family: DejaVu Serif, serif;
      font-size: 52px;
      line-height: 1.15;
    }

    .cover-address {
      max-width: 585px;
      margin: 40px 0 0;
      color: #3f5d22;
      font-size: 22px;
      font-weight: bold;
      line-height: 1.4;
    }

    .cover-meta {
      margin-top: 15px;
      color: #6c705e;
      font-size: 16px;
    }

    .cover-welcome {
      max-width: 590px;
      margin: 40px 0 0;
      font-size: 18px;
      line-height: 1.6;
    }

    .cover-notice {
      max-width: 570px;
      margin-top: 45px;
      padding: 16px 20px;
      border-left: 4px solid #d96d3c;
      background: #f8ebe1;
      color: #6a4937;
      font-size: 13px;
      line-height: 1.45;
    }

    .category-section {
      page-break-before: always;
    }

    .category-section.first {
      page-break-before: auto;
    }

    .category-title-table {
      width: 100%;
      margin: 0 0 10px;
      border-collapse: collapse;
    }

    .category-title-line {
      width: 29%;
      border-bottom: 1px solid #7c9c4a;
    }

    .category-title {
      padding: 0 14px 8px;
      color: #2e431b;
      font-family: DejaVu Serif, serif;
      font-size: 30px;
      font-weight: bold;
      line-height: 1.08;
      text-align: center;
      white-space: nowrap;
    }

    .menu-row {
      width: 100%;
      margin: 0 0 8px;
      page-break-inside: avoid;
    }

    .menu-cell {
      width: 100%;
      padding: 0;
    }

    .menu-card {
      position: relative;
      width: 100%;
      height: 150px;
      overflow: hidden;
      border: 2px solid #cfd9bc;
      border-radius: 10px;
      background: #ffffff;
      page-break-inside: avoid;
      box-sizing: border-box;
    }

    .card-img-wrapper {
      position: absolute;
      top: 0;
      left: 0;
      width: 146px;
      height: 146px;
      border-right: 1px solid #dce4cc;
    }

    .card-img {
      display: block;
      width: 146px;
      height: 146px;
      border-top-left-radius: 8px;
      border-bottom-left-radius: 8px;
      background: #eef1df;
    }

    .card-img-placeholder {
      display: block;
      width: 146px;
      height: 146px;
      padding-top: 65px;
      color: #52782a;
      background: #eef1df;
      border-top-left-radius: 8px;
      border-bottom-left-radius: 8px;
      font-size: 9px;
      font-weight: bold;
      letter-spacing: 1px;
      text-align: center;
      text-transform: uppercase;
    }

    .card-main-info {
      position: absolute;
      top: 10px;
      left: 160px;
      right: 14px;
    }

    .card-heading {
      width: 100%;
      margin-bottom: 6px;
      border-collapse: collapse;
    }

    .card-title {
      padding: 0 10px 0 0;
      color: #2e431b;
      font-family: DejaVu Serif, serif;
      font-size: 17px;
      font-weight: bold;
      line-height: 1.15;
      vertical-align: top;
    }

    .card-price-cell {
      width: 80px;
      padding: 0;
      text-align: right;
      vertical-align: top;
    }

    .card-price {
      display: inline-block;
      padding: 4px 8px;
      border-radius: 6px;
      background: #52782a;
      color: #ffffff;
      font-size: 13px;
      font-weight: bold;
      white-space: nowrap;
    }

    .card-description {
      margin: 0 0 4px;
      color: #3a4032;
      font-size: 11px;
      line-height: 1.25;
    }

    .card-ingredients {
      margin: 0 0 4px;
      color: #5e6154;
      font-size: 10px;
      font-style: italic;
      line-height: 1.2;
    }

    .card-tag {
      margin: 0 0 3px;
      color: #d96d3c;
      font-size: 10px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .card-bottom-info {
      position: absolute;
      bottom: 8px;
      left: 160px;
      right: 14px;
    }

    .card-portion {
      width: 100%;
      margin: 0;
      padding-top: 4px;
      padding-bottom: 0;
      border-top: 1px dashed #cfd9bc;
      color: #4a4e40;
      font-size: 10px;
      line-height: 1.15;
    }

    .card-portion-value {
      color: #26301f;
      font-weight: bold;
      text-align: right;
      line-height: 1.15;
    }

    .card-portions-block {
      width: 100%;
      margin: 0;
      padding-top: 4px;
      padding-bottom: 0;
      border-top: 1px dashed #cfd9bc;
    }

    .card-portions-title {
      margin-bottom: 2px;
      color: #3a4032;
      font-size: 10px;
      font-weight: bold;
    }

    .card-portions-table {
      width: 100%;
      border-collapse: collapse;
    }

    .portion-weight {
      color: #4a4e40;
      font-size: 10px;
      padding: 0;
    }

    .portion-price {
      color: #26301f;
      font-size: 10px;
      font-weight: bold;
      text-align: right;
      padding: 0;
    }

    .page-footer {
      position: fixed;
      right: 0;
      bottom: -15px;
      left: 0;
      color: #8a8d7d;
      font-size: 7px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="cover">
    <div class="cover-accent-top"></div>
    <div class="cover-accent-bottom"></div>
    <div class="cover-content">
      <div class="eyebrow"><span class="eyebrow-line"></span>Меню кафе</div>
      <h1 class="cover-title">{{ $settings['site_title'] ?? 'Кафе «Домашняя кухня»' }}</h1>
      <div class="cover-address">{{ $settings['address'] ?? 'ул. Сенновские Выселки, 12, д. Князево' }}</div>
      <div class="cover-meta">
        @if(!empty($settings['phone'])){{ $settings['phone'] }}@endif
        @if(!empty($settings['phone']) && !empty($settings['working_hours'])) - @endif
        @if(!empty($settings['working_hours'])){{ $settings['working_hours'] }}@endif
      </div>
      <p class="cover-welcome">
        {{ $settings['hero_description'] ?? 'Мы рады видеть наших посетителей! Здесь можно вкусно поесть, отдохнуть с дороги и провести время в приятной, по-домашнему уютной обстановке.' }}
      </p>
      <div class="cover-notice">
        Блюда на фотографиях могут отличаться от фактического вида. Все изображения носят иллюстративный характер.
      </div>
    </div>
  </div>

  @foreach($menuSections as $section)
    <section class="category-section{{ $loop->first ? ' first' : '' }}">
      <table class="category-title-table">
        <tr>
          <td class="category-title-line"></td>
          <td class="category-title">{{ $section['title'] }}</td>
          <td class="category-title-line"></td>
        </tr>
      </table>

      @foreach($section['items']->chunk(1) as $row)
        <div class="menu-row">
          @foreach($row as $item)
            <div class="menu-card">
              <div class="card-img-wrapper">
                @if($item->pdf_image_url)
                  <img class="card-img" width="146" height="146" src="{{ $item->pdf_image_url }}" alt="{{ $item->name }}">
                @else
                  <div class="card-img-placeholder">Фото блюда</div>
                @endif
              </div>

              <div class="card-main-info">
                <table class="card-heading">
                  <tr>
                    <td class="card-title">{{ $item->name }}</td>
                    <td class="card-price-cell">
                      @if(!empty($item->has_multiple_portions))
                        <span class="card-price">от {{ $item->min_price }} ₽</span>
                      @else
                        <span class="card-price">{{ $item->price }} ₽</span>
                      @endif
                    </td>
                  </tr>
                </table>

                @if($item->description)
                  <p class="card-description">{{ $item->description }}</p>
                @endif

                @if($item->ingredients)
                  <p class="card-ingredients">Состав: {{ $item->ingredients }}</p>
                @endif

                @if($item->tag)
                  <div class="card-tag">{{ $item->tag }}</div>
                @endif
              </div>

              <div class="card-bottom-info">
                @if(!empty($item->has_multiple_portions))
                  <div class="card-portions-block">
                    <div class="card-portions-title">Порции и цены:</div>
                    <table class="card-portions-table">
                      @foreach($item->portions as $portion)
                        <tr>
                          <td class="portion-weight">{{ $portion['weight'] }}</td>
                          <td class="portion-price">{{ $portion['price'] }} ₽</td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
                @else
                  <div class="card-portion">
                    <div class="card-portion-value">Порция: {{ $item->weight ?: 'не указана' }}</div>
                  </div>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      @endforeach
    </section>
  @endforeach

  <div class="page-footer">
    {{ $settings['site_title'] ?? 'Домашняя кухня' }} - меню сформировано {{ date('d.m.Y') }}
  </div>
</body>
</html>
