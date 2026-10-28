const coverageDescriptions = {
    domestic:
        "Explore air ambulance, road and train ambulance transfers within India. The coordination team will discuss the route and medical arrangements with you.",
    international:
        "Discuss international air ambulance, commercial stretcher and medical escort arrangements. Each journey depends on medical clearance, airline approval and destination requirements.",
};

document.querySelectorAll("[data-coverage]").forEach((button) => {
    button.addEventListener("click", () => {
        document.querySelectorAll("[data-coverage]").forEach((option) => {
            const selected = option === button;
            option.classList.toggle("active", selected);
            option.setAttribute("aria-pressed", String(selected));
        });
        document.querySelector(".coverage-map").dataset.route =
            button.dataset.coverage;
        document.querySelector("#coverage-description").textContent =
            coverageDescriptions[button.dataset.coverage];
    });
});

document.querySelectorAll("[data-inquiry]").forEach((form) => {
    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        if (!form.reportValidity()) return;
        const button = form.querySelector('button[type="submit"]');
        const feedback = form.querySelector(".inquiry-feedback");
        button.disabled = true;
        feedback.dataset.error = "false";
        feedback.textContent = "Sending your request…";
        try {
            const response = await fetch(form.action, {
                method: "POST",
                body: new FormData(form),
                headers: { Accept: "application/json" },
            });
            const result = await response.json();
            feedback.textContent = result.message;
            feedback.dataset.error = String(!result.status);
            if (result.status) form.reset();
        } catch {
            feedback.dataset.error = "true";
            feedback.textContent =
                "We could not send your request. Please try again or call the medical coordination desk.";
        } finally {
            button.disabled = false;
        }
    });
});

// Give inherited carousels accessible controls without starting automatic motion.
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".swiper").forEach((element) => {
        element.swiper?.autoplay?.stop();
    });
});

const faqSearch = document.querySelector("#faq-search");
faqSearch?.addEventListener("input", () => {
    const query = faqSearch.value.trim().toLocaleLowerCase();
    const questions = [
        ...document.querySelectorAll(".faq-page-section .accordion-item"),
    ];
    let visible = 0;
    questions.forEach((question) => {
        const matches = question.textContent
            .toLocaleLowerCase()
            .includes(query);
        question.hidden = !matches;
        if (matches) visible += 1;
    });
    document.querySelector("#faq-search-feedback").textContent = query
        ? `${visible} matching question${visible === 1 ? "" : "s"}`
        : "";
});

const servicesMenu = document.querySelector(".services-menu-item");
const servicesToggle = servicesMenu?.querySelector(".services-menu-toggle");
if (servicesMenu && servicesToggle) {
    const desktopServices = matchMedia("(min-width: 992px) and (hover: hover)");
    const dropdown = () =>
        window.bootstrap?.Dropdown.getOrCreateInstance(servicesToggle);
    servicesMenu
        .querySelector(":scope > .nav-link")
        .addEventListener("pointerenter", () => {
            if (desktopServices.matches) dropdown()?.show();
        });
    servicesMenu.addEventListener("pointerleave", () => {
        if (
            desktopServices.matches &&
            !servicesMenu.contains(document.activeElement)
        ) {
            dropdown()?.hide();
        }
    });
    servicesMenu.addEventListener("focusout", (event) => {
        if (!servicesMenu.contains(event.relatedTarget)) dropdown()?.hide();
    });
    servicesMenu.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            dropdown()?.hide();
            servicesToggle.focus();
        }
    });
}

// Keep the services introduction below the sticky navigation as its height changes.
const stickySections = [
    ...document.querySelectorAll("#medical-services, .faq-page-section"),
];
const siteHeader = document.querySelector("#header");
if (stickySections.length && siteHeader) {
    const updateServicesOffset = () => {
        stickySections.forEach((section) => {
            section.style.setProperty(
                "--services-header-height",
                `${siteHeader.getBoundingClientRect().height}px`,
            );
        });
    };
    updateServicesOffset();
    if ("ResizeObserver" in window) {
        new ResizeObserver(updateServicesOffset).observe(siteHeader);
    } else {
        window.addEventListener("resize", updateServicesOffset, {
            passive: true,
        });
    }
}

const heroCarousel = document.querySelector("[data-hero-carousel]");
if (heroCarousel) {
    const slides = [...heroCarousel.querySelectorAll(".flight-slide")];
    const indicators = [...heroCarousel.querySelectorAll("[data-hero-slide]")];
    let activeSlide = 0;
    let touchStart;

    const showSlide = (index, manual = false) => {
        activeSlide = (index + slides.length) % slides.length;
        slides.forEach((slide, slideIndex) => {
            const active = slideIndex === activeSlide;
            slide.classList.toggle("is-active", active);
            slide.setAttribute("aria-hidden", String(!active));
            slide.inert = !active;
        });
        indicators.forEach((indicator, slideIndex) => {
            const active = slideIndex === activeSlide;
            indicator.classList.toggle("is-active", active);
            indicator.setAttribute("aria-current", String(active));
        });
        heroCarousel.querySelector(".flight-slide-count").textContent =
            `${String(activeSlide + 1).padStart(2, "0")} / ${String(slides.length).padStart(2, "0")}`;
        if (manual) {
            heroCarousel.querySelector("[data-hero-status]").textContent =
                `Slide ${activeSlide + 1} of ${slides.length}: ${slides[activeSlide].querySelector(".flight-slide-title").textContent}`;
        }
    };
    indicators.forEach((indicator, index) =>
        indicator.addEventListener("click", () => showSlide(index, true)),
    );
    heroCarousel
        .querySelector("[data-hero-previous]")
        .addEventListener("click", () => showSlide(activeSlide - 1, true));
    heroCarousel
        .querySelector("[data-hero-next]")
        .addEventListener("click", () => showSlide(activeSlide + 1, true));
    heroCarousel.addEventListener("keydown", (event) => {
        if (event.key === "ArrowLeft" || event.key === "ArrowRight") {
            event.preventDefault();
            showSlide(
                activeSlide + (event.key === "ArrowRight" ? 1 : -1),
                true,
            );
        }
    });
    heroCarousel.addEventListener("pointerdown", (event) => {
        if (event.pointerType === "touch")
            touchStart = { x: event.clientX, y: event.clientY };
    });
    heroCarousel.addEventListener("pointerup", (event) => {
        if (!touchStart || event.pointerType !== "touch") return;
        const horizontal = event.clientX - touchStart.x;
        const vertical = event.clientY - touchStart.y;
        if (
            Math.abs(horizontal) > 60 &&
            Math.abs(horizontal) > Math.abs(vertical)
        ) {
            showSlide(activeSlide + (horizontal < 0 ? 1 : -1), true);
        }
        touchStart = undefined;
    });
    heroCarousel.addEventListener("pointercancel", () => {
        touchStart = undefined;
    });
    heroCarousel.querySelectorAll("img[data-fallback]").forEach((image) => {
        const showFallback = () => {
            if (!image.dataset.fallback) return;
            const fallback = image.dataset.fallback;
            delete image.dataset.fallback;
            image.src = fallback;
            image.alt = "Ashoka Rescue patient transfer beside an aircraft";
            image
                .closest(".flight-slide")
                .querySelector(".flight-image-credit").hidden = true;
        };
        image.addEventListener("error", showFallback);
        if (image.complete && !image.naturalWidth) showFallback();
    });
}

const googleReviewsSection = document.querySelector("[data-google-reviews]");
if (googleReviewsSection) {
    const status = googleReviewsSection.querySelector(".google-reviews-status");
    const track = googleReviewsSection.querySelector(".review-track");
    const safeUrl = (value) => {
        try {
            const url = new URL(value);
            return url.protocol === "https:" ? url.href : "";
        } catch {
            return "";
        }
    };
    const externalLink = (text, url) => {
        const link = document.createElement("a");
        link.textContent = text;
        link.href = safeUrl(url);
        link.target = "_blank";
        link.rel = "noopener";
        return link;
    };
    const moveReview = (direction) => {
        const firstCard = track.querySelector("blockquote");
        if (!firstCard) return;
        const step =
            firstCard.getBoundingClientRect().width +
            (parseFloat(getComputedStyle(track).columnGap) || 0);
        const maximum = track.scrollWidth - track.clientWidth;
        if (maximum <= 1) return;
        const nextPosition =
            direction > 0
                ? track.scrollLeft >= maximum - 2
                    ? 0
                    : Math.min(maximum, track.scrollLeft + step)
                : track.scrollLeft <= 2
                  ? maximum
                  : Math.max(0, track.scrollLeft - step);
        track.scrollTo({
            left: nextPosition,
            behavior: matchMedia("(prefers-reduced-motion: reduce)").matches
                ? "instant"
                : "smooth",
        });
    };
    googleReviewsSection
        .querySelectorAll("[data-review-direction]")
        .forEach((button) => {
            button.addEventListener("click", () =>
                moveReview(Number(button.dataset.reviewDirection)),
            );
        });
    const startReviewRotation = () => {
        window.setInterval(() => {
            if (
                document.hidden ||
                googleReviewsSection.matches(":hover") ||
                googleReviewsSection.contains(document.activeElement)
            )
                return;
            const bounds = track.getBoundingClientRect();
            if (bounds.bottom <= 0 || bounds.top >= window.innerHeight) return;
            moveReview(1);
        }, 6000);
    };
    const loadGoogleReviews = async () => {
        try {
            const response = await fetch(
                googleReviewsSection.dataset.reviewsEndpoint,
                { headers: { Accept: "application/json" }, cache: "no-store" },
            );
            const result = await response.json();
            if (!response.ok || !result.status)
                throw new Error("Reviews unavailable");
            if (safeUrl(result.url))
                googleReviewsSection.querySelector(
                    "[data-google-reviews-link]",
                ).href = result.url;
            for (const review of result.reviews) {
                const card = document.createElement("blockquote");
                const stars = document.createElement("div");
                stars.className = "google-review-rating";
                const rating = Math.min(
                    5,
                    Math.max(0, Number(review.rating) || 0),
                );
                stars.setAttribute("aria-label", `${rating} out of 5 stars`);
                for (let index = 1; index <= 5; index += 1) {
                    const icon = document.createElement("i");
                    icon.className =
                        index <= rating
                            ? "fa-solid fa-star"
                            : "fa-regular fa-star";
                    icon.setAttribute("aria-hidden", "true");
                    stars.append(icon);
                }
                const text = document.createElement("p");
                text.textContent = review.text;
                const readMore = externalLink(
                    "Read more",
                    review.url || result.url,
                );
                readMore.className = "google-review-read-more";
                readMore.hidden = true;
                const footer = document.createElement("footer");
                footer.className = "google-review-author";
                if (safeUrl(review.avatar)) {
                    const image = document.createElement("img");
                    image.src = review.avatar;
                    image.alt = review.author;
                    image.width = 40;
                    image.height = 40;
                    image.loading = "lazy";
                    image.referrerPolicy = "no-referrer";
                    footer.append(image);
                }
                const authorDetails = document.createElement("div");
                const author = safeUrl(review.authorUrl)
                    ? externalLink(review.author, review.authorUrl)
                    : document.createElement("span");
                author.textContent = review.author;
                const date = document.createElement("small");
                date.textContent = review.date;
                authorDetails.append(author, date);
                footer.append(authorDetails);
                card.append(stars, text, readMore, footer);
                if (safeUrl(review.url)) {
                    const source = externalLink(
                        "View review on Google",
                        review.url,
                    );
                    source.className = "google-review-source";
                    card.append(source);
                }
                track.append(card);
            }
            for (const attribution of result.attributions || []) {
                if (attribution.name && safeUrl(attribution.url)) {
                    googleReviewsSection
                        .querySelector(".google-reviews-attributions")
                        .append(
                            externalLink(attribution.name, attribution.url),
                        );
                }
            }
            track.hidden = !result.reviews.length;
            googleReviewsSection.querySelector(".review-controls").hidden =
                result.reviews.length < 2;
            const updateReadMore = () => {
                track.querySelectorAll("blockquote").forEach((card) => {
                    const text = card.querySelector("p");
                    const link = card.querySelector(".google-review-read-more");
                    link.hidden =
                        !link.getAttribute("href") ||
                        text.scrollHeight <= text.clientHeight + 1;
                });
            };
            requestAnimationFrame(updateReadMore);
            if ("ResizeObserver" in window) {
                const reviewResizeObserver = new ResizeObserver(updateReadMore);
                reviewResizeObserver.observe(track);
            } else {
                window.addEventListener("resize", updateReadMore);
            }
            document.fonts?.ready.then(updateReadMore);
            if (result.reviews.length > 1) startReviewRotation();
            googleReviewsSection.querySelector(".google-reviews-order").hidden =
                !result.reviews.length;
            status.hidden = result.reviews.length > 0;
            status.textContent = result.reviews.length
                ? ""
                : "Read patient and family feedback on Google.";
        } catch {
            status.textContent =
                "Google reviews are currently unavailable. You can read them directly on Google.";
        }
    };
    if ("IntersectionObserver" in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                if (entries.some((entry) => entry.isIntersecting)) {
                    observer.disconnect();
                    loadGoogleReviews();
                }
            },
            { rootMargin: "300px" },
        );
        observer.observe(googleReviewsSection);
    } else loadGoogleReviews();
}

// Apply the source site's entrance transitions to the newly designed sections.
if (
    "IntersectionObserver" in window &&
    !matchMedia("(prefers-reduced-motion: reduce)").matches
) {
    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    revealObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.08, rootMargin: "0px 0px -20px 0px" },
    );
    document
        .querySelectorAll(
            ".care-perspective-heading, .care-perspective-story, .care-capabilities li, .coverage-copy, .coverage-map, .review-heading, .assistance-copy, .assistance-form, .home-faq .faq-layout > div, .journal-grid article",
        )
        .forEach((element) => {
            // Already visible content should not disappear when enhancement initializes.
            if (element.getBoundingClientRect().top < innerHeight) return;
            element.classList.add("experience-reveal");
            revealObserver.observe(element);
        });
}
