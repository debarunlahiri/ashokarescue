(() => {
  const carousel = document.querySelector("[data-home-carousel]");
  if (!carousel) return;
  const slides = [...carousel.querySelectorAll("[data-home-slide]")];
  const dots = [...carousel.querySelectorAll("[data-home-goto]")];
  const status = carousel.querySelector("[data-home-status]");
  const motion = window.matchMedia("(prefers-reduced-motion: reduce)");
  let current = 0;
  let timer;
  let focusInside = false;
  let inView = true;

  function schedule() {
    window.clearTimeout(timer);
    if (
      slides.length < 2 ||
      motion.matches ||
      focusInside ||
      document.hidden ||
      !inView
    )
      return;
    timer = window.setTimeout(() => show(current + 1), 4500);
  }

  function show(index, announce = false) {
    current = (index + slides.length) % slides.length;
    slides.forEach((slide, position) => {
      const active = position === current;
      slide.classList.toggle("is-active", active);
      slide.setAttribute("aria-hidden", String(!active));
      slide.inert = !active;
      dots[position].setAttribute("aria-current", String(active));
    });
    if (announce)
      status.textContent = `Slide ${current + 1} of ${slides.length}: ${slides[current].querySelector(".nh-hero-title").textContent}`;
    schedule();
  }

  dots.forEach((dot, index) =>
    dot.addEventListener("click", () => show(index, true)),
  );
  carousel
    .querySelector(".nh-carousel-controls")
    .addEventListener("keydown", (event) => {
      if (event.key !== "ArrowLeft" && event.key !== "ArrowRight") return;
      event.preventDefault();
      show(current + (event.key === "ArrowRight" ? 1 : -1), true);
    });
  carousel.addEventListener("focusin", () => {
    focusInside = true;
    schedule();
  });
  carousel.addEventListener("focusout", (event) => {
    focusInside = carousel.contains(event.relatedTarget);
    schedule();
  });
  document.addEventListener("visibilitychange", schedule);
  motion.addEventListener("change", schedule);
  if ("IntersectionObserver" in window) {
    new IntersectionObserver(([entry]) => {
      inView = entry.isIntersecting;
      schedule();
    }).observe(carousel);
  }
  carousel.classList.add("is-ready");
  schedule();
})();
