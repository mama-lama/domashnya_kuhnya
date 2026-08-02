<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $settings['site_title'] ?? 'Домашняя кухня у дороги' }}</title>
  <link rel="stylesheet" href="{{ asset('css/main.css') }}?v={{ filemtime(public_path('css/main.css')) }}" />
</head>
<body>
  <header class="header">
    <div class="container header__inner">
      <a href="#home" class="brand" aria-label="Домашняя кухня у дороги">
        <span class="brand__icon" aria-hidden="true">
          <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 3c-2 2.6-3 4.6-3 6.2A3.9 3.9 0 0 0 12.9 13 4.2 4.2 0 0 0 17 8.8C17 6.7 15.5 4.8 12 3Z"/>
            <path d="M6 13.5c1.7 3.8 4.1 5.5 6 7 1.9-1.5 4.3-3.2 6-7"/>
            <path d="M4 20h16"/>
          </svg>
        </span>
        <span>
          <h2 class="brand__title">Домашняя кухня</h2>
          <p class="brand__subtitle">Уютное кафе у дороги</p>
        </span>
      </a>

      <button class="burger" id="burger" aria-label="Открыть меню" aria-expanded="false" aria-controls="navMenu">
        <span></span>
      </button>

      <nav class="nav" id="navMenu">
        <ul class="nav__list">
          <li><a class="nav__link" href="#home">Главная</a></li>
          <li><a class="nav__link" href="#menu">Меню</a></li>
          <li><a class="nav__link" href="#reviews">Отзывы</a></li>
          <li><a class="nav__link" href="#contacts">Карта</a></li>
        </ul>
        <a class="btn btn--primary header__call" href="tel:{{ $settings['phone_raw'] ?? '+79991234567' }}">
          <span class="icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.1 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.6a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6.2 6.2l1.4-1.3a2 2 0 0 1 2.1-.5c.8.3 1.7.6 2.6.7A2 2 0 0 1 22 16.9Z"/>
            </svg>
          </span>
          Позвонить
        </a>
      </nav>
    </div>
  </header>

  <main>
    <section class="hero" id="home">
      <div class="container">
        <div class="hero__wrap">
          <div class="hero__content">
            <div class="hero__tag">
              <span class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 12h18"/>
                  <path d="M7 8l-4 4 4 4"/>
                  <path d="M17 8l4 4-4 4"/>
                </svg>
              </span>
              {{ $settings['hero_tag'] ?? 'Уютная остановка для всей семьи' }}
            </div>
            <h1>{{ $settings['hero_title'] ?? 'Домашняя кухня, сад и спокойный отдых у дороги' }}</h1>
            <p>
              {{ $settings['hero_description'] ?? 'Уютное придорожное кафе с тёплой домашней атмосферой, зелёным садом, фонтаном, верандой, комнатами под съём и возможностью провести семейное торжество. Заезжайте отдохнуть, вкусно поесть и перевести дух в дороге.' }}
            </p>
            <div class="hero__actions">
              <a class="btn btn--primary" href="#menu">
                <span class="icon" aria-hidden="true">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 6h13"/>
                    <path d="M8 12h13"/>
                    <path d="M8 18h13"/>
                    <path d="M3 6h.01"/>
                    <path d="M3 12h.01"/>
                    <path d="M3 18h.01"/>
                  </svg>
                </span>
                Посмотреть меню
              </a>
              <a class="btn btn--light" href="https://yandex.ru/maps/?text={{ urlencode($settings['address'] ?? 'ул. Сенновские Выселки, 12, д. Князево') }}" target="_blank" rel="noopener noreferrer">
                <span class="icon" aria-hidden="true">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 2 11 13"/>
                    <path d="M22 2 15 22l-4-9-9-4 20-7Z"/>
                  </svg>
                </span>
                Построить маршрут
              </a>
            </div>
          </div>

          <div class="hero__advantages">
            <article class="feature-card">
              <div class="feature-card__icon" aria-hidden="true">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/>
                  <path d="M7 2v20"/>
                  <path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
                </svg>
              </div>
              <h3>Домашняя кухня</h3>
              <p>Супы, горячие блюда, выпечка и напитки с привычным тёплым вкусом.</p>
            </article>
            <article class="feature-card">
              <div class="feature-card__icon" aria-hidden="true">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="6" cy="19" r="3"/>
                  <path d="M9 19h8.5a3.5 3.5 0 0 0 0-7h-11a3.5 3.5 0 0 1 0-7H15"/>
                  <circle cx="18" cy="5" r="3"/>
                </svg>
              </div>
              <h3>Удобно по пути</h3>
              <p>Кафе удобно расположено рядом с дорогой М4, чтобы сделать комфортную остановку.</p>
            </article>
            <article class="feature-card">
              <div class="feature-card__icon" aria-hidden="true">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M10 10v.2A3 3 0 0 1 8.9 16H5a3 3 0 0 1-1-5.8V10a3 3 0 0 1 6 0Z"/>
                  <path d="M7 16v6"/>
                  <path d="M13 19v3"/>
                  <path d="M12 19h8.3a1 1 0 0 0 .7-1.7L18 14h.3a1 1 0 0 0 .7-1.7L16 9h.2a1 1 0 0 0 .8-1.7L13 3l-1.4 1.5"/>
                </svg>
              </div>
              <h3>Сад с фонтаном</h3>
              <p>Зелёная территория, цветы, спокойные уголки для отдыха и веранда на свежем воздухе.</p>
            </article>
            <article class="feature-card">
              <div class="feature-card__icon" aria-hidden="true">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="9"/>
                  <path d="M12 7v6l4 2"/>
                </svg>
              </div>
              <h3>Круглосуточный уют</h3>
              <p>Тёплая атмосфера и место, где можно сделать паузу в любое время суток.</p>
            </article>
          </div>
        </div>
      </div>
    </section>

    <section class="section" id="menu">
      <div class="container">
        <div class="eyebrow">Меню кафе</div>
        <h2 class="section-title">Домашние блюда, выпечка и горячие напитки</h2>
        <p class="section-subtitle">
          Меню составлено так, чтобы в дороге можно было хорошо пообедать, перекусить всей семьёй или спокойно выпить чай на веранде.
        </p>

        <div class="menu-tabs" id="menuTabs">
          <button class="menu-tab is-active" type="button" data-filter="all">Все блюда</button>
          @foreach($categories as $category)
          <button class="menu-tab" type="button" data-filter="{{ $category->slug }}">{{ $category->name }}</button>
          @endforeach
        </div>

        <div class="menu-grid">
          @foreach($menuItems as $item)
          <article class="dish-card" data-category="{{ implode(' ', $item->categorySlugs()) }}">
            <div class="dish-card__image">
              @if($item->tag)
              <span class="tag tag--badge">{{ $item->tag }}</span>
              @endif
              <img src="{{ $item->image_url }}" alt="{{ $item->name }}" loading="lazy" />
            </div>
            <div class="dish-card__body">
              <div class="dish-card__top">
                <h3 class="dish-card__title">{{ $item->name }}</h3>
                <span class="dish-card__price">{{ $item->price }} ₽</span>
              </div>
              <p class="dish-card__desc">{{ $item->description }}</p>
              @if($item->ingredients)
                <p class="dish-card__ingredients" style="font-size: 13px; color: var(--muted); margin-top: 6px; line-height: 1.4;">
                  <strong>Состав:</strong> {{ $item->ingredients }}
                </p>
              @endif
              <div class="dish-card__meta">
                <span>{{ $item->weight }}</span>
              </div>
            </div>
          </article>
          @endforeach
        </div>
      </div>
    </section>

    <section class="section" id="garden">
      <div class="container">
        <div class="eyebrow">Сад и веранда</div>
        <h2 class="section-title">Место, где приятно остановиться и просто отдохнуть</h2>
        <p class="section-subtitle">
          У кафе есть зелёный сад, фонтан, цветущая территория и уютная веранда. Здесь приятно посидеть с ещё одной семьёй, спокойно пообедать на свежем воздухе или выпить чай после долгой дороги.
        </p>

        <div class="scenic-grid">
          <article class="scenic-card">
            <div class="scenic-card__image">
              <img src="https://images.unsplash.com/photo-1465146344425-f00d5f5c8f07?auto=format&fit=crop&w=1000&q=80" alt="Цветущий сад у кафе" loading="lazy" />
            </div>
            <div class="scenic-card__body">
              <h3>Цветущий сад</h3>
              <p>Зелёные дорожки, ухоженные клумбы и спокойная атмосфера, которая помогает перевести дух в пути.</p>
            </div>
          </article>

          <article class="scenic-card">
            <div class="scenic-card__image">
              <img src="https://images.unsplash.com/photo-1501854140801-50d01698950b?auto=format&fit=crop&w=1000&q=80" alt="Уютная веранда кафе" loading="lazy" />
            </div>
            <div class="scenic-card__body">
              <h3>Уютная веранда</h3>
              <p>Мягкий свет, спокойная обстановка и удобные места, где можно с комфортом поесть или выпить чай.</p>
            </div>
          </article>

          <article class="scenic-card">
            <div class="scenic-card__image">
              <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1000&q=80" alt="Фонтан и зелёная территория" loading="lazy" />
            </div>
            <div class="scenic-card__body">
              <h3>Фонтан и отдых</h3>
              <p>Тихий уголок на территории кафе, где приятно сделать паузу, отдохнуть с детьми или провести время с близкими.</p>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section class="section" id="rooms-events">
      <div class="container">
        <div class="eyebrow">Комнаты и торжества</div>
        <h2 class="section-title">Не только кафе, но и удобное место для отдыха и встреч</h2>
        <p class="section-subtitle">
          У нас можно не только пообедать по пути, но и остановиться на отдых, а также провести тёплое семейное событие в уютной атмосфере.
        </p>

        <div class="info-layout">
          <article class="info-card">
            <div class="info-image">
              <div class="rooms-slider" id="roomsSlider">
                <div class="rooms-slider__track" id="roomsTrack">
                  @forelse($roomImages as $roomImage)
                  <div class="rooms-slider__slide">
                    <img src="{{ $roomImage }}" alt="Комната под съём, фото {{ $loop->iteration }}" loading="lazy" />
                  </div>
                  @empty
                  <div class="rooms-slider__slide">
                    <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1200&q=80" alt="Комнаты под съём" loading="lazy" />
                  </div>
                  @endforelse
                </div>
                @if($roomImages->count() > 1)
                <button class="rooms-slider__btn rooms-slider__btn--prev" id="roomsPrev" type="button" aria-label="Предыдущее фото">
                  <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"/>
                  </svg>
                </button>
                <button class="rooms-slider__btn rooms-slider__btn--next" id="roomsNext" type="button" aria-label="Следующее фото">
                  <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"/>
                  </svg>
                </button>
                <div class="rooms-slider__dots" id="roomsDots"></div>
                @endif
              </div>
            </div>
            <div class="info-body">
              <h3>Комнаты под съём</h3>
              <p>
                Комфортные комнаты под съём подойдут тем, кто хочет отдохнуть после долгой дороги, переночевать в спокойной обстановке и продолжить путь без спешки.
              </p>
              <div class="badge-list">
                <span class="badge">Тихая обстановка</span>
                <span class="badge">Удобно в дороге</span>
                <span class="badge">Семейный формат</span>
              </div>
              <div class="action-row">
                <a class="btn btn--primary" href="#contacts">Узнать подробнее</a>
                <a class="btn btn--outline" href="tel:{{ $settings['phone_raw'] ?? '+79991234567' }}">Позвонить</a>
              </div>
            </div>
          </article>

          <article class="info-card">
            <div class="info-image">
              <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=1200&q=80" alt="Проведение торжеств" loading="lazy" />
            </div>
            <div class="info-body">
              <h3>Проведение торжеств</h3>
              <p>
                День рождения, семейный праздник, банкет или тёплая встреча — поможем организовать событие в красивой и спокойной обстановке с домашней кухней.
              </p>
              <div class="badge-list">
                <span class="badge">Семейные праздники</span>
                <span class="badge">Небольшие банкеты</span>
                <span class="badge">Уютный зал</span>
              </div>
              <div class="action-row">
                <a class="btn btn--primary" href="#contacts">Узнать подробнее</a>
                <a class="btn btn--outline" href="tel:{{ $settings['phone_raw'] ?? '+79991234567' }}">Позвонить</a>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section class="section" id="reviews">
      <div class="container">
        <div class="eyebrow">Отзывы гостей</div>
        <h2 class="section-title">Тёплые впечатления от остановки у нас</h2>
        <p class="section-subtitle">
          Гости ценят спокойную атмосферу, домашние блюда, чистоту и возможность отдохнуть в красивом месте по пути.
        </p>

        <div class="reviews">
          <div class="reviews__viewport" id="reviewsViewport">
            <div class="reviews__track" id="reviewsTrack">
              @foreach($reviews->chunk(3) as $chunk)
              <div class="reviews__slide">
                @foreach($chunk as $review)
                <article class="review-card">
                  <div class="review-card__meta">
                    <div class="review-card__avatar" aria-hidden="true">{{ mb_substr($review->name, 0, 1) }}</div>
                    <div>
                      <p class="review-card__name">{{ $review->name }}</p>
                      <p class="review-card__city">{{ $review->city }}</p>
                    </div>
                  </div>
                  <p class="review-card__text">{{ $review->text }}</p>
                </article>
                @endforeach
              </div>
              @endforeach
            </div>
          </div>

          <div class="reviews__controls">
            <button class="slider-btn" id="prevReview" aria-label="Предыдущие отзывы">
              <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"/>
              </svg>
            </button>
            <div class="slider-dots" id="reviewDots"></div>
            <button class="slider-btn" id="nextReview" aria-label="Следующие отзывы">
              <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"/>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </section>

    <section class="section" id="contacts">
      <div class="container">
        <div class="eyebrow">Карта и контакты</div>
        <h2 class="section-title">Заезжайте на вкусный обед и спокойный отдых</h2>
        <p class="section-subtitle">
          Нас легко найти по адресу: {{ $settings['address'] ?? 'ул. Сенновские Выселки, 12, д. Князево' }}. Можно заранее позвонить, уточнить детали по комнатам и торжествам или сразу построить маршрут.
        </p>

        <div class="contacts-grid">
          <article class="contact-card">
            <h3>Контакты</h3>
            <p>Всегда рады гостям, которые хотят вкусно поесть, отдохнуть в дороге или организовать уютную встречу.</p>

            <div class="contact-list">
              <div class="contact-item">
                <div class="contact-item__icon" aria-hidden="true">
                  <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22c4-4 7-6.7 7-11a7 7 0 1 0-14 0c0 4.3 3 7 7 11Z"/>
                    <path d="M12 11a2.5 2.5 0 1 0 0-.01Z"/>
                  </svg>
                </div>
                <div>
                  <strong>Адрес</strong>
                  <span>{{ $settings['address'] ?? 'ул. Сенновские Выселки, 12, д. Князево' }}</span>
                </div>
              </div>

              <div class="contact-item">
                <div class="contact-item__icon" aria-hidden="true">
                  <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.1 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.6a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6.2 6.2l1.4-1.3a2 2 0 0 1 2.1-.5c.8.3 1.7.6 2.6.7A2 2 0 0 1 22 16.9Z"/>
                  </svg>
                </div>
                <div>
                  <strong>Телефон</strong>
                  <a href="tel:{{ $settings['phone_raw'] ?? '+79991234567' }}">{{ $settings['phone'] ?? '+7 (999) 123-45-67' }}</a>
                </div>
              </div>

              <div class="contact-item">
                <div class="contact-item__icon" aria-hidden="true">
                  <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 7v6l4 2"/>
                  </svg>
                </div>
                <div>
                  <strong>Часы работы</strong>
                  <span>{{ $settings['working_hours'] ?? 'Ежедневно с 08:00 до 22:00' }}</span>
                </div>
              </div>
            </div>

            <div class="action-row">
              <a class="btn btn--primary" href="https://yandex.ru/maps/?text={{ urlencode($settings['address'] ?? 'ул. Сенновские Выселки, 12, д. Князево') }}" target="_blank" rel="noopener noreferrer">Построить маршрут</a>
              <a class="btn btn--outline" href="tel:{{ $settings['phone_raw'] ?? '+79991234567' }}">Позвонить</a>
            </div>
          </article>

          <div class="map-card">
            <iframe
              title="Карта кафе"
              src="https://www.google.com/maps?q={{ urlencode($settings['address'] ?? 'ул. Сенновские Выселки, 12, д. Князево') }}&output=embed"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="map-card__footer">
              <a class="btn btn--primary" href="https://yandex.ru/maps/?text={{ urlencode($settings['address'] ?? 'ул. Сенновские Выселки, 12, д. Князево') }}" target="_blank" rel="noopener noreferrer">Построить маршрут</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer">
    <div class="container footer__inner">
      <div>
        <h2 class="footer__brand">Домашняя кухня</h2>
        <p class="footer__text">Уютное придорожное кафе с домашней атмосферой, садом и тёплым отдыхом у дороги.</p>
      </div>
      <div class="footer__meta">
        <span>{{ $settings['address'] ?? 'ул. Сенновские Выселки, 12, д. Князево' }}</span>
        <a href="tel:{{ $settings['phone_raw'] ?? '+79991234567' }}">{{ $settings['phone'] ?? '+7 (999) 123-45-67' }}</a>
        <span>© 2026 Домашняя кухня</span>
      </div>
    </div>
  </footer>

  <div class="lightbox" id="roomsLightbox" aria-hidden="true" role="dialog" aria-label="Фотографии комнат">
    <button class="lightbox__close" id="lightboxClose" type="button" aria-label="Закрыть">
      <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 6 6 18"/>
        <path d="m6 6 12 12"/>
      </svg>
    </button>
    <button class="lightbox__btn lightbox__btn--prev" id="lightboxPrev" type="button" aria-label="Предыдущее фото">
      <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="m15 18-6-6 6-6"/>
      </svg>
    </button>
    <div class="lightbox__stage">
      <img class="lightbox__image" id="lightboxImage" src="" alt="Комната под съём" />
      <div class="lightbox__counter" id="lightboxCounter"></div>
    </div>
    <button class="lightbox__btn lightbox__btn--next" id="lightboxNext" type="button" aria-label="Следующее фото">
      <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="m9 18 6-6-6-6"/>
      </svg>
    </button>
  </div>

  <script src="{{ asset('js/main.js') }}?v={{ filemtime(public_path('js/main.js')) }}"></script>
</body>
</html>
