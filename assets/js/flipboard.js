/* Airport split-flap text animation for page banner titles.
 * Each character cycles through random glyphs then locks in, left to right.
 * Auto-applies to .banner-title elements; inner markup (<br>, <span>) is preserved.
 * Plays once per page load and never loops; reduced-motion users and no-JS
 * see the plain final text. */
(function () {
    'use strict';

    var GLYPHS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var STAGGER_MS = 28; // delay between each character starting its flip
    var TICKS = 9;       // glyph changes per character before it settles
    var TICK_MS = 55;    // ms per glyph change

    function randomGlyph() {
        return GLYPHS[(Math.random() * GLYPHS.length) | 0];
    }

    // Wrap every character of each text node in its own span, keeping
    // element nodes (<br>, <span>, ...) exactly where they are.
    function collectChars(root) {
        var chars = [];
        var walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT);
        var textNodes = [];
        while (walker.nextNode()) {
            textNodes.push(walker.currentNode);
        }
        textNodes.forEach(function (node) {
            var frag = document.createDocumentFragment();
            var text = node.nodeValue;
            for (var i = 0; i < text.length; i++) {
                var ch = text[i];
                if (ch === ' ' || ch === '\n' || ch === '\t' || ch === '\r') {
                    frag.appendChild(document.createTextNode(' '));
                    continue;
                }
                var s = document.createElement('span');
                s.className = 'flip-ch';
                s.textContent = ch;
                s.setAttribute('data-final', ch);
                frag.appendChild(s);
                chars.push(s);
            }
            node.parentNode.replaceChild(frag, node);
        });
        return chars;
    }

    function play(chars) {
        chars.forEach(function (span, idx) {
            var finalCh = span.getAttribute('data-final');
            setTimeout(function () {
                var n = 0;
                var timer = setInterval(function () {
                    if (n >= TICKS) {
                        clearInterval(timer);
                        span.textContent = finalCh;
                        return;
                    }
                    span.textContent = randomGlyph();
                    n++;
                }, TICK_MS);
            }, idx * STAGGER_MS);
        });
    }

    function init() {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            return;
        }
        // Plays once per page load; never loops.
        var titles = document.querySelectorAll('.banner-title');
        titles.forEach(function (title) {
            var chars = collectChars(title);
            if (chars.length) {
                play(chars);
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
