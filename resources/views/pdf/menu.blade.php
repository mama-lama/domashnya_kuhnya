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
      margin: 0 0 5px;
      border-collapse: separate;
      border-spacing: 4px 0;
      table-layout: fixed;
      page-break-inside: avoid;
    }

    .menu-cell {
      width: 50%;
      padding: 0;
      vertical-align: top;
    }

    .menu-card {
      height: 130px;
      overflow: hidden;
      border: 2px solid #cfd9bc;
      border-radius: 13px;
      background: #ffffff;
      page-break-inside: avoid;
    }

    .card-table {
      width: 100%;
      height: 126px;
      border-collapse: collapse;
      table-layout: fixed;
    }

    .card-img-cell {
      width: 126px;
      height: 126px;
      padding: 0;
      vertical-align: middle;
      text-align: center;
      border-right: 1px solid #dce4cc;
    }

    .card-content-cell {
      height: 126px;
      padding: 0;
      vertical-align: top;
    }

    .card-img {
      display: block;
      width: 126px;
      height: 126px;
      border-top-left-radius: 11px;
      border-bottom-left-radius: 11px;
      background: #eef1df;
    }

    .card-img-placeholder {
      display: block;
      width: 126px;
      height: 126px;
      padding-top: 55px;
      color: #52782a;
      background: #eef1df;
      border-top-left-radius: 11px;
      border-bottom-left-radius: 11px;
      font-size: 8px;
      font-weight: bold;
      letter-spacing: 1px;
      text-align: center;
      text-transform: uppercase;
    }

    .card-content {
      padding: 10px 12px;
      height: 126px;
      overflow: hidden;
    }

    .card-heading {
      width: 100%;
      margin-bottom: 4px;
      border-collapse: collapse;
    }

    .card-title {
      padding: 0 6px 0 0;
      color: #2e431b;
      font-family: DejaVu Serif, serif;
      font-size: 12px;
      font-weight: bold;
      line-height: 1.18;
      vertical-align: top;
    }

    .card-price-cell {
      width: 70px;
      padding: 0;
      text-align: right;
      vertical-align: top;
    }

    .card-price {
      display: inline-block;
      padding: 4px 6px;
      border-radius: 6px;
      background: #52782a;
      color: #ffffff;
      font-size: 11px;
      font-weight: bold;
      white-space: nowrap;
    }

    .card-description {
      margin: 0 0 4px;
      color: #3a4032;
      font-size: 9px;
      line-height: 1.3;
      display: none;
    }

    .card-ingredients {
      margin: 0 0 4px;
      color: #5e6154;
      font-size: 11px;
      font-style: italic;
      line-height: 1.25;
    }

    .card-tag {
      margin: 0 0 4px;
      color: #d96d3c;
      font-size: 11px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .card-portion {
      width: 100%;
      margin-top: 4px;
      padding-top: 4px;
      border-top: 1px dashed #cfd9bc;
      color: #4a4e40;
      font-size: 9px;
    }

    .card-portion-value {
      color: #3f5d22;
      font-weight: bold;
      text-align: right;
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

      @foreach($section['items']->chunk(2) as $row)
        <table class="menu-row">
          <tr>
            @foreach($row as $item)
              <td class="menu-cell">
                <div class="menu-card">
                  <table class="card-table">
                    <colgroup>
                      <col style="width: 126px;">
                      <col style="width: auto;">
                    </colgroup>
                    <tr>
                      <td class="card-img-cell">
                        @if($item->pdf_image_url)
                          <img class="card-img" width="126" height="126" src="{{ $item->pdf_image_url }}" alt="{{ $item->name }}">
                        @else
                          <div class="card-img-placeholder">Фото блюда</div>
                        @endif
                      </td>
                      <td class="card-content-cell">
                        <div class="card-content">
                          <table class="card-heading">
                            <tr>
                              <td class="card-title">{{ $item->name }}</td>
                              <td class="card-price-cell"><span class="card-price">{{ $item->price }} ₽</span></td>
                            </tr>
                          </table>

                          @if($item->ingredients)
                            <p class="card-ingredients">Состав: {{ $item->ingredients }}</p>
                          @endif

                          @if($item->tag)
                            <div class="card-tag">{{ $item->tag }}</div>
                          @endif

                          <table class="card-portion">
                            <tr>
                              <td>Порция</td>
                              <td class="card-portion-value">{{ $item->weight ?: 'не указана' }}</td>
                            </tr>
                          </table>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </td>
            @endforeach

            @for($column = $row->count(); $column < 2; $column++)
              <td class="menu-cell"></td>
            @endfor
          </tr>
        </table>
      @endforeach
    </section>
  @endforeach

  <div class="page-footer">
    {{ $settings['site_title'] ?? 'Домашняя кухня' }} - меню сформировано {{ date('d.m.Y') }}
  </div>
</body>
</html>
