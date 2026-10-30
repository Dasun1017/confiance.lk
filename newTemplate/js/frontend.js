
(function () {
    'use strict';
    document.documentElement.classList.replace('no-js', 'js');

    var nav = document.getElementById('site-mobile-nav');
    var trigger = document.querySelector('.mobile-menu-trigger');
    var header = document.querySelector('.header-area');
    var main = document.getElementById('main-content');
    var footer = document.querySelector('footer');
    var breakpoint = window.matchMedia('(max-width: 991px)');
    var navigationBreakpoint = window.matchMedia('(max-width: 1279px)');
    if (nav && trigger) {
        var overlay = document.createElement('div');
        overlay.className = 'mobile-nav-overlay';
        overlay.hidden = true;
        overlay.setAttribute('aria-hidden', 'true');
        document.body.appendChild(overlay);
        var close = nav.querySelector('.mobile-nav-close');
        function setOpen(open, restoreFocus) {
            nav.hidden = !open;
            overlay.hidden = !open;
            nav.classList.toggle('active', open);
            document.body.classList.toggle('menu-open', open);
            trigger.setAttribute('aria-expanded', String(open));
            // Keep keyboard and assistive technology focus inside the open drawer.
            if (main) main.inert = open;
            if (footer) footer.inert = open;
            if (header) Array.prototype.forEach.call(header.children, function (child) {
                if (child !== nav) child.inert = open;
            });
            if (open) close.focus();
            else if (restoreFocus) trigger.focus();
        }
        trigger.addEventListener('click', function () { setOpen(nav.hidden, true); });
        close.addEventListener('click', function () { setOpen(false, true); });
        overlay.addEventListener('click', function () { setOpen(false, true); });
        nav.addEventListener('click', function (event) {
            if (event.target.closest('a[href]')) setOpen(false, true);
        });
        document.addEventListener('keydown', function (event) {
            if (nav.hidden) return;
            if (event.key === 'Escape') { event.preventDefault(); setOpen(false, true); }
            if (event.key !== 'Tab') return;
            var items = nav.querySelectorAll('button, a[href]');
            var first = items[0], last = items[items.length - 1];
            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault(); last.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault(); first.focus();
            }
        });
        navigationBreakpoint.addEventListener('change', function (event) {
            if (!event.matches) setOpen(false, false);
        });
    }

    var page = location.pathname.split('/').pop() || 'index.html';
    if (page === 'index2.html') page = 'index.html';
    document.querySelectorAll('header nav a[href], footer nav a[href]').forEach(function (link) {
        if (link.getAttribute('href') === page) link.setAttribute('aria-current', 'page');
    });
    document.querySelectorAll('[data-current-year]').forEach(function (element) {
        element.textContent = new Date().getFullYear();
    });

    var stage = document.getElementById('heroStage');
    var heroTrigger = document.getElementById('heroTrigger');
    var panel = document.getElementById('heroPanel');
    var heroOverlay = document.getElementById('heroOverlay');
    if (stage && heroTrigger && panel && heroOverlay) {
        var timer;
        function showHero(open) {
            clearTimeout(timer);
            panel.style.transform = open ? 'translateX(0)' : 'translateX(-120%)';
            panel.style.opacity = open ? '1' : '0';
            heroOverlay.style.opacity = open ? '1' : '0';
            heroTrigger.setAttribute('aria-expanded', String(open));
            stage.classList.toggle('hero-open', open);
            heroTrigger.querySelector('span:last-child').textContent = open ? 'CLOSE INTRODUCTION \u00d7' : 'WELCOME TO CONFIANCE';
            panel.inert = !open && !breakpoint.matches;
        }
        heroTrigger.addEventListener('click', function () {
            showHero(heroTrigger.getAttribute('aria-expanded') !== 'true');
        });
        stage.addEventListener('mouseleave', function () {
            timer = setTimeout(function () {
                if (!stage.contains(document.activeElement)) showHero(false);
            }, 150);
        });
        stage.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') { showHero(false); heroTrigger.focus(); }
        });
        breakpoint.addEventListener('change', function () { showHero(breakpoint.matches); });
        showHero(breakpoint.matches);
    }
})();
