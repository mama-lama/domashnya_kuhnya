(function () {
  const burger = document.getElementById('burger');
  const nav = document.getElementById('navMenu');
  const navLinks = nav.querySelectorAll('a');

  function closeMenu() {
    nav.classList.remove('is-open');
    burger.classList.remove('is-active');
    burger.setAttribute('aria-expanded', 'false');
  }

  function openMenu() {
    nav.classList.add('is-open');
    burger.classList.add('is-active');
    burger.setAttribute('aria-expanded', 'true');
  }

  burger.addEventListener('click', function () {
    const isOpen = nav.classList.contains('is-open');
    isOpen ? closeMenu() : openMenu();
  });

  navLinks.forEach(function (link) {
    link.addEventListener('click', function () {
      if (window.innerWidth <= 860) {
        closeMenu();
      }
    });
  });

  document.addEventListener('click', function (event) {
    if (window.innerWidth > 860) return;
    if (!nav.contains(event.target) && !burger.contains(event.target)) {
      closeMenu();
    }
  });

  window.addEventListener('resize', function () {
    if (window.innerWidth > 860) {
      nav.classList.remove('is-open');
      burger.classList.remove('is-active');
      burger.setAttribute('aria-expanded', 'false');
    }
  });

  const track = document.getElementById('reviewsTrack');
  const slides = Array.from(track.children);
  const prevBtn = document.getElementById('prevReview');
  const nextBtn = document.getElementById('nextReview');
  const dotsWrap = document.getElementById('reviewDots');
  let currentIndex = 0;

  function renderDots() {
    dotsWrap.innerHTML = '';
    slides.forEach(function (_, index) {
      const dot = document.createElement('button');
      dot.className = 'slider-dot' + (index === currentIndex ? ' is-active' : '');
      dot.type = 'button';
      dot.setAttribute('aria-label', 'Перейти к отзыву ' + (index + 1));
      dot.addEventListener('click', function () {
        goToSlide(index);
      });
      dotsWrap.appendChild(dot);
    });
  }

  function goToSlide(index) {
    currentIndex = (index + slides.length) % slides.length;
    track.style.transform = 'translateX(' + (-currentIndex * 100) + '%)';
    renderDots();
  }

  prevBtn.addEventListener('click', function () {
    goToSlide(currentIndex - 1);
  });

  nextBtn.addEventListener('click', function () {
    goToSlide(currentIndex + 1);
  });

  let autoPlay = setInterval(function () {
    goToSlide(currentIndex + 1);
  }, 6000);

  function resetAutoplay() {
    clearInterval(autoPlay);
    autoPlay = setInterval(function () {
      goToSlide(currentIndex + 1);
    }, 6000);
  }

  [prevBtn, nextBtn, dotsWrap].forEach(function (element) {
    element.addEventListener('click', resetAutoplay);
  });

  const menuTabs = document.getElementById('menuTabs');
  const menuButtons = menuTabs ? Array.from(menuTabs.querySelectorAll('.menu-tab')) : [];
  const menuCards = Array.from(document.querySelectorAll('#menu .dish-card[data-category]'));

  function filterMenu(category) {
    menuCards.forEach(function (card) {
      const cardCategories = (card.dataset.category || '').split(/\s+/);
      const shouldShow = category === 'all' || cardCategories.indexOf(category) !== -1;
      card.classList.toggle('is-hidden', !shouldShow);
    });

    menuButtons.forEach(function (button) {
      button.classList.toggle('is-active', button.dataset.filter === category);
    });
  }

  if (menuTabs) {
    menuTabs.addEventListener('click', function (event) {
      const button = event.target.closest('.menu-tab');
      if (!button) return;
      filterMenu(button.dataset.filter);
    });
  }

  filterMenu('all');
  goToSlide(0);

  // Rooms slider + fullscreen lightbox carousel
  const roomsSlider = document.getElementById('roomsSlider');
  if (roomsSlider) {
    const roomsTrack = document.getElementById('roomsTrack');
    const roomSlides = Array.from(roomsTrack.children);
    const roomImages = roomSlides.map(function (slide) {
      const img = slide.querySelector('img');
      return img ? img.getAttribute('src') : '';
    });
    const roomsPrev = document.getElementById('roomsPrev');
    const roomsNext = document.getElementById('roomsNext');
    const roomsDots = document.getElementById('roomsDots');
    let roomIndex = 0;

    function renderRoomDots() {
      if (!roomsDots) return;
      roomsDots.innerHTML = '';
      roomSlides.forEach(function (_, index) {
        const dot = document.createElement('button');
        dot.className = 'slider-dot' + (index === roomIndex ? ' is-active' : '');
        dot.type = 'button';
        dot.setAttribute('aria-label', 'Фото комнаты ' + (index + 1));
        dot.addEventListener('click', function (event) {
          event.stopPropagation();
          goToRoom(index);
          resetRoomsAutoplay();
        });
        roomsDots.appendChild(dot);
      });
    }

    function goToRoom(index) {
      roomIndex = (index + roomSlides.length) % roomSlides.length;
      roomsTrack.style.transform = 'translateX(' + (-roomIndex * 100) + '%)';
      renderRoomDots();
    }

    let roomsAutoPlay = setInterval(function () {
      goToRoom(roomIndex + 1);
    }, 4000);

    function resetRoomsAutoplay() {
      clearInterval(roomsAutoPlay);
      roomsAutoPlay = setInterval(function () {
        goToRoom(roomIndex + 1);
      }, 4000);
    }

    if (roomsPrev) {
      roomsPrev.addEventListener('click', function (event) {
        event.stopPropagation();
        goToRoom(roomIndex - 1);
        resetRoomsAutoplay();
      });
    }

    if (roomsNext) {
      roomsNext.addEventListener('click', function (event) {
        event.stopPropagation();
        goToRoom(roomIndex + 1);
        resetRoomsAutoplay();
      });
    }

    goToRoom(0);

    // Lightbox
    const lightbox = document.getElementById('roomsLightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxCounter = document.getElementById('lightboxCounter');
    const lightboxClose = document.getElementById('lightboxClose');
    const lightboxPrev = document.getElementById('lightboxPrev');
    const lightboxNext = document.getElementById('lightboxNext');
    let lightboxIndex = 0;

    function renderLightbox() {
      lightboxImage.src = roomImages[lightboxIndex];
      lightboxImage.alt = 'Комната под съём, фото ' + (lightboxIndex + 1);
      lightboxCounter.textContent = (lightboxIndex + 1) + ' / ' + roomImages.length;
    }

    function openLightbox(index) {
      lightboxIndex = (index + roomImages.length) % roomImages.length;
      renderLightbox();
      lightbox.classList.add('is-open');
      lightbox.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      lightbox.classList.remove('is-open');
      lightbox.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    roomsSlider.addEventListener('click', function (event) {
      if (event.target.closest('.rooms-slider__btn')) return;
      openLightbox(roomIndex);
    });

    lightboxClose.addEventListener('click', closeLightbox);

    lightboxPrev.addEventListener('click', function () {
      lightboxIndex = (lightboxIndex - 1 + roomImages.length) % roomImages.length;
      renderLightbox();
    });

    lightboxNext.addEventListener('click', function () {
      lightboxIndex = (lightboxIndex + 1) % roomImages.length;
      renderLightbox();
    });

    lightbox.addEventListener('click', function (event) {
      if (event.target === lightbox || event.target.classList.contains('lightbox__stage')) {
        closeLightbox();
      }
    });

    document.addEventListener('keydown', function (event) {
      if (!lightbox.classList.contains('is-open')) return;
      if (event.key === 'Escape') closeLightbox();
      if (event.key === 'ArrowLeft') lightboxPrev.click();
      if (event.key === 'ArrowRight') lightboxNext.click();
    });
  }
})();
