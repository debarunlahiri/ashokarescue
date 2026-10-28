/* Ashoka Rescue - Redesign interactions (2026-10-12) */
(function () {
    'use strict';
    document.documentElement.classList.add('rx-js');
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var finePointer = window.matchMedia('(pointer: fine)').matches;

    /* Scroll progress hairline + header lift */
    var prog = document.createElement('div');
    prog.className = 'rx-progress';
    prog.setAttribute('aria-hidden', 'true');
    prog.innerHTML = '<span></span>';
    document.body.appendChild(prog);
    var progBar = prog.firstChild;
    var headerEl = document.getElementById('header');
    var ticking = false;
    function onScroll() {
        var h = document.documentElement;
        var max = h.scrollHeight - h.clientHeight;
        progBar.style.width = (max > 0 ? (h.scrollTop / max) * 100 : 0) + '%';
        if (headerEl) headerEl.classList.toggle('rx-scrolled', h.scrollTop > 40);
        ticking = false;
    }
    window.addEventListener('scroll', function () {
        if (!ticking) { ticking = true; requestAnimationFrame(onScroll); }
    }, { passive: true });
    onScroll();

    /* Scroll reveal engine */
    var revealEls = document.querySelectorAll('[data-rx]');
    if ('IntersectionObserver' in window && !reduceMotion) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) { e.target.classList.add('rx-in'); io.unobserve(e.target); }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
        revealEls.forEach(function (el) { io.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('rx-in'); });
    }

    /* Seamless marquee: duplicate the ticker track once */
    document.querySelectorAll('[data-ticker] .rx-ticker-track').forEach(function (track) {
        if (!track.dataset.duped) { track.innerHTML += track.innerHTML; track.dataset.duped = '1'; }
    });

    /* Testimonial marquee: force uniform card heights per row */
    function rxEqualizeTstCards() {
        document.querySelectorAll('.rx-tst-marquee .rx-ticker-track').forEach(function (track) {
            var cards = track.querySelectorAll('.rx-tst-card');
            if (!cards.length) return;
            var max = 0;
            cards.forEach(function (card) {
                card.style.height = 'auto';
                if (card.offsetHeight > max) max = card.offsetHeight;
            });
            if (max > 0) {
                cards.forEach(function (card) { card.style.height = max + 'px'; });
            }
        });
    }
    rxEqualizeTstCards();
    window.addEventListener('load', rxEqualizeTstCards);
    var rxTstRz;
    window.addEventListener('resize', function () {
        clearTimeout(rxTstRz);
        rxTstRz = setTimeout(rxEqualizeTstCards, 200);
    });
    /* Hero headline: split into animated words (keeps <br> and inner <span>) */
    document.querySelectorAll('[data-rx-words]').forEach(function (el) {
        var i = 0, out = '';
        el.innerHTML.split(/<br\s*\/?>/i).forEach(function (seg, si, arr) {
            var m = seg.match(/^\s*<span>([\s\S]*)<\/span>\s*$/i);
            var wrapOpen = '', wrapClose = '';
            var text = seg;
            if (m) { text = m[1]; wrapOpen = '<span class="rx-w-accent">'; wrapClose = '</span>'; }
            out += wrapOpen;
            text.split(/\s+/).forEach(function (w) {
                if (w) { out += '<span class="rx-w" style="--i:' + (i++) + '">' + w + '</span> '; }
            });
            out += wrapClose;
            if (si < arr.length - 1) out += '<br>';
        });
        el.innerHTML = out;
    });

    if (!reduceMotion && finePointer) {
        /* 3D tilt cards */
        document.querySelectorAll('[data-tilt]').forEach(function (card) {
            var strength = parseFloat(card.getAttribute('data-tilt')) || 8;
            card.addEventListener('mousemove', function (ev) {
                var r = card.getBoundingClientRect();
                var x = (ev.clientX - r.left) / r.width - 0.5;
                var y = (ev.clientY - r.top) / r.height - 0.5;
                card.style.transform = 'perspective(900px) rotateY(' + (x * strength) + 'deg) rotateX(' + (-y * strength) + 'deg) translateY(-4px)';
            });
            card.addEventListener('mouseleave', function () { card.style.transform = ''; });
        });

        /* Magnetic buttons */
        document.querySelectorAll('[data-magnetic]').forEach(function (btn) {
            btn.addEventListener('mousemove', function (ev) {
                var r = btn.getBoundingClientRect();
                var x = ev.clientX - r.left - r.width / 2;
                var y = ev.clientY - r.top - r.height / 2;
                btn.style.transform = 'translate(' + x * 0.12 + 'px,' + y * 0.18 + 'px)';
            });
            btn.addEventListener('mouseleave', function () { btn.style.transform = ''; });
        });

        /* Gentle parallax */
        var pxEls = Array.prototype.slice.call(document.querySelectorAll('[data-parallax]'));
        if (pxEls.length) {
            var pxTick = false;
            var doParallax = function () {
                var vh = window.innerHeight;
                pxEls.forEach(function (el) {
                    var r = el.getBoundingClientRect();
                    if (r.bottom < 0 || r.top > vh) return;
                    var speed = parseFloat(el.getAttribute('data-parallax')) || 0.08;
                    var offset = (r.top + r.height / 2 - vh / 2) * speed;
                    el.style.transform = 'translateY(' + (-offset).toFixed(1) + 'px)';
                });
                pxTick = false;
            };
            window.addEventListener('scroll', function () {
                if (!pxTick) { pxTick = true; requestAnimationFrame(doParallax); }
            }, { passive: true });
            doParallax();
        }
    }
})();

/* Animate native service disclosures without hiding content behind scroll reveals. */
(function () {
    'use strict';

    var entries = Array.from(document.querySelectorAll('.transport-entry'));
    var motionPreference = window.matchMedia('(prefers-reduced-motion: reduce)');
    var states = new WeakMap();

    if (!entries.length || !Element.prototype.animate) return;

    function setExpanded(entry, expanded) {
        var state = states.get(entry);
        var summary = entry.querySelector('summary');
        var startHeight = entry.getBoundingClientRect().height;

        if (state.animation) state.animation.cancel();
        state.expanded = expanded;
        entry.classList.toggle('transport-opening', expanded);

        if (motionPreference.matches) {
            entry.open = expanded;
            entry.style.height = '';
            entry.style.overflow = '';
            return;
        }

        // Keep the disclosure open during closing so its contents can slide away.
        entry.open = true;
        entry.style.height = '';
        var endHeight = expanded
            ? entry.getBoundingClientRect().height
            : summary.getBoundingClientRect().height +
                parseFloat(getComputedStyle(entry).borderTopWidth || 0) +
                parseFloat(getComputedStyle(entry).borderBottomWidth || 0);

        entry.style.overflow = 'hidden';
        entry.style.height = startHeight + 'px';
        var animation = entry.animate([
            { height: startHeight + 'px' },
            { height: endHeight + 'px' }
        ], {
            duration: 360,
            easing: 'cubic-bezier(0.22, 1, 0.36, 1)'
        });

        state.animation = animation;
        animation.onfinish = function () {
            if (state.animation !== animation) return;
            entry.open = expanded;
            entry.style.height = '';
            entry.style.overflow = '';
            state.animation = null;
        };
    }

    entries.forEach(function (entry) {
        states.set(entry, { expanded: entry.open, animation: null });
        // Manage exclusivity here so the previous row can finish its closing animation.
        entry.removeAttribute('name');
        entry.classList.add('transport-animated');
        entry.classList.toggle('transport-opening', entry.open);
        entry.querySelector('summary').addEventListener('click', function (event) {
            event.preventDefault();
            var expanded = !states.get(entry).expanded;

            if (expanded) {
                entries.forEach(function (other) {
                    if (other !== entry && states.get(other).expanded) {
                        setExpanded(other, false);
                    }
                });
            }

            setExpanded(entry, expanded);
        });
    });
})();
