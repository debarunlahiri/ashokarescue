document.addEventListener("DOMContentLoaded", function () {
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const transition = document.createElement('div');
    transition.className = 'site-page-transition';
    transition.setAttribute('aria-hidden', 'true');
    transition.innerHTML = `
      <div class="site-page-transition__content">
        <span class="site-page-transition__icon"><i class="fa-solid fa-plane-departure"></i></span>
        <span class="site-page-transition__label">Ashoka Rescue</span>
        <span class="site-page-transition__line"><i></i></span>
      </div>
    `;
    document.body.appendChild(transition);

    if (!reduceMotion) {
      transition.classList.add('site-page-transition--entering');
      window.requestAnimationFrame(() => {
        window.requestAnimationFrame(() => transition.classList.remove('site-page-transition--entering'));
      });
    }

    document.addEventListener('click', function (event) {
      if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
        return;
      }

      const link = event.target.closest('a[href]');
      if (!link || link.target === '_blank' || link.hasAttribute('download')) return;

      const rawHref = link.getAttribute('href');
      if (!rawHref || rawHref.startsWith('#') || /^(tel:|mailto:|javascript:)/i.test(rawHref)) return;

      const destination = new URL(link.href, window.location.href);
      if (destination.origin !== window.location.origin) return;
      if (destination.pathname === window.location.pathname && destination.search === window.location.search && destination.hash) return;
      if (reduceMotion) return;

      event.preventDefault();
      transition.classList.add('site-page-transition--leaving');
      window.setTimeout(() => {
        window.location.href = destination.href;
      }, 240);
    });

    window.addEventListener('pageshow', function () {
      transition.classList.remove('site-page-transition--leaving');
    });

    window.addEventListener('scroll', function () {
      if (window.scrollY > 150) {
        document.getElementById('header').classList.add('fixed-top');
        // add padding top to show content behind navbar
        navbar_height = document.querySelector('.navbar').offsetHeight;
        document.body.style.paddingTop = navbar_height + 'px';
      } else {
        document.getElementById('header').classList.remove('fixed-top');
        // remove padding top from body
        document.body.style.paddingTop = '0';
      }
    });
  }); 
  
  var scrollToTopBtn = document.querySelector(".scroll-top");
  var rootElement = document.documentElement;
  
  function handleScroll() {
    // Do something on scroll
    var scrollTotal = rootElement.scrollHeight - rootElement.clientHeight;
    if (rootElement.scrollTop / scrollTotal > 0.03) {
      // Show button
      scrollToTopBtn.classList.add("scrolltopactive");
    } else {
      // Hide button
      scrollToTopBtn.classList.remove("scrolltopactive");
    }
  }
  
  function scrollToTop() {
    // Scroll to top logic
    rootElement.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }
  scrollToTopBtn.addEventListener("click", scrollToTop);
  document.addEventListener("scroll", handleScroll);
