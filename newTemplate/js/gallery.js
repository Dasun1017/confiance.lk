/**
 * CONFIANCE - Gallery & Lightbox Controller
 * Category filtering, accessible modal lightbox with next/prev, swipe & keyboard support.
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', initGallery);

  function initGallery() {
    const filterButtons = Array.from(document.querySelectorAll('.gl-filter-btn'));
    const items = Array.from(document.querySelectorAll('.gl-item'));
    const emptyState = document.querySelector('.gl-empty-state');
    const statusCount = document.querySelector('.gl-status-count');

    const lightbox = document.getElementById('gallery-lightbox');
    if (!lightbox) return;

    const lbImg = lightbox.querySelector('.gl-lb-image');
    const lbCounter = lightbox.querySelector('.gl-lb-counter');
    const lbBadge = lightbox.querySelector('.gl-lb-badge');
    const lbTitle = lightbox.querySelector('.gl-lb-title');
    const lbCaption = lightbox.querySelector('.gl-lb-caption');
    const lbLocation = lightbox.querySelector('.gl-lb-location-text');
    const lbCloseBtn = lightbox.querySelector('.gl-lb-close-btn');
    const lbPrevBtn = lightbox.querySelector('.gl-lb-nav-btn.gl-prev');
    const lbNextBtn = lightbox.querySelector('.gl-lb-nav-btn.gl-next');
    const lbBackdrop = lightbox.querySelector('.gl-lightbox-backdrop');

    let currentFilter = 'all';
    let visibleItems = items.slice();
    let currentIndex = 0;
    let lastActiveTrigger = null;

    // 1. FILTERING
    filterButtons.forEach(btn => {
      btn.addEventListener('click', function () {
        const filter = this.getAttribute('data-filter') || 'all';
        if (filter === currentFilter) return;

        currentFilter = filter;
        filterButtons.forEach(b => {
          const isActive = b === btn;
          b.classList.toggle('active', isActive);
          b.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });

        let matched = 0;
        visibleItems = [];

        items.forEach(item => {
          const category = item.getAttribute('data-category') || '';
          const match = filter === 'all' || category === filter;
          if (match) {
            item.classList.remove('gl-hidden');
            visibleItems.push(item);
            matched++;
          } else {
            item.classList.add('gl-hidden');
          }
        });

        if (statusCount) {
          statusCount.textContent = `Showing ${matched} of ${items.length} photos`;
        }

        if (emptyState) {
          emptyState.classList.toggle('gl-visible', matched === 0);
        }
      });
    });

    // 2. OPEN LIGHTBOX
    items.forEach(item => {
      item.addEventListener('click', function (e) {
        lastActiveTrigger = this;
        const indexInVisible = visibleItems.indexOf(this);
        if (indexInVisible !== -1) {
          openLightbox(indexInVisible);
        }
      });

      item.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          this.click();
        }
      });
    });

    function openLightbox(index) {
      if (visibleItems.length === 0) return;
      currentIndex = (index + visibleItems.length) % visibleItems.length;
      updateLightboxContent();

      lightbox.classList.add('gl-open');
      lightbox.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';

      if (lbCloseBtn) lbCloseBtn.focus();
    }

    function closeLightbox() {
      lightbox.classList.remove('gl-open');
      lightbox.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';

      if (lastActiveTrigger) {
        lastActiveTrigger.focus();
      }
    }

    function showNext() {
      if (visibleItems.length <= 1) return;
      currentIndex = (currentIndex + 1) % visibleItems.length;
      updateLightboxContent();
    }

    function showPrev() {
      if (visibleItems.length <= 1) return;
      currentIndex = (currentIndex - 1 + visibleItems.length) % visibleItems.length;
      updateLightboxContent();
    }

    function updateLightboxContent() {
      const activeItem = visibleItems[currentIndex];
      if (!activeItem) return;

      const img = activeItem.querySelector('.gl-item-img');
      const title = activeItem.querySelector('.gl-item-title');
      const caption = activeItem.querySelector('.gl-item-caption');
      const badge = activeItem.querySelector('.gl-item-badge');
      const location = activeItem.querySelector('.gl-item-location');

      if (lbImg && img) {
        lbImg.src = img.src;
        lbImg.alt = img.alt || '';
      }
      if (lbTitle && title) lbTitle.textContent = title.textContent;
      if (lbCaption && caption) lbCaption.textContent = caption.textContent;
      if (lbBadge && badge) lbBadge.textContent = badge.textContent;
      if (lbLocation && location) lbLocation.textContent = location.textContent;
      if (lbCounter) lbCounter.textContent = `${currentIndex + 1} of ${visibleItems.length}`;
    }

    // Controls
    if (lbCloseBtn) lbCloseBtn.addEventListener('click', closeLightbox);
    if (lbBackdrop) lbBackdrop.addEventListener('click', closeLightbox);
    if (lbNextBtn) lbNextBtn.addEventListener('click', showNext);
    if (lbPrevBtn) lbPrevBtn.addEventListener('click', showPrev);

    // Keyboard navigation
    document.addEventListener('keydown', function (e) {
      if (!lightbox.classList.contains('gl-open')) return;

      if (e.key === 'Escape') {
        e.preventDefault();
        closeLightbox();
      } else if (e.key === 'ArrowRight') {
        e.preventDefault();
        showNext();
      } else if (e.key === 'ArrowLeft') {
        e.preventDefault();
        showPrev();
      } else if (e.key === 'Tab') {
        // Focus trap
        const focusable = lightbox.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (focusable.length === 0) return;
        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (e.shiftKey && document.activeElement === first) {
          e.preventDefault();
          last.focus();
        } else if (!e.shiftKey && document.activeElement === last) {
          e.preventDefault();
          first.focus();
        }
      }
    });

    // Touch swipe support on mobile
    let touchStartX = 0;
    let touchStartY = 0;
    const viewport = lightbox.querySelector('.gl-lb-viewport');

    if (viewport) {
      viewport.addEventListener('touchstart', function (e) {
        touchStartX = e.changedTouches[0].screenX;
        touchStartY = e.changedTouches[0].screenY;
      }, { passive: true });

      viewport.addEventListener('touchend', function (e) {
        const touchEndX = e.changedTouches[0].screenX;
        const touchEndY = e.changedTouches[0].screenY;
        const diffX = touchEndX - touchStartX;
        const diffY = touchEndY - touchStartY;

        // Horizontal swipe if diffX > 40px and dominant over vertical diff
        if (Math.abs(diffX) > 40 && Math.abs(diffX) > Math.abs(diffY)) {
          if (diffX < 0) {
            showNext();
          } else {
            showPrev();
          }
        }
      }, { passive: true });
    }
  }
})();

