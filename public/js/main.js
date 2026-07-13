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
      const cardCategory = card.dataset.category;
      const shouldShow = category === 'all' || cardCategory === category;
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
})();
