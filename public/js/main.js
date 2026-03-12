function toggleMobileNav() {
  const nav = document.getElementById("mobileNav");
  nav.classList.toggle("open");
}

// Scroll to Top Button
const scrollTopBtn = document.getElementById("scrollTop");
window.addEventListener("scroll", () => {
  if (window.scrollY > 400) {
    scrollTopBtn.classList.add("visible");
  } else {
    scrollTopBtn.classList.remove("visible");
  }
});
scrollTopBtn.addEventListener("click", (e) => {
  e.preventDefault();
  window.scrollTo({ top: 0, behavior: "smooth" });
});

// Wishlist Toggle
let wishlistCount = 0;
const badge = document.querySelector(".nav-icon-btn .badge");

function toggleWishlist(btn) {
  const icon = btn.querySelector("i");
  if (btn.classList.contains("wishlisted")) {
    btn.classList.remove("wishlisted");
    icon.style.color = "";
    wishlistCount = Math.max(0, wishlistCount - 1);
  } else {
    btn.classList.add("wishlisted");
    icon.style.color = "#6B1A1A";
    icon.style.fill = "#6B1A1A";
    wishlistCount++;
    // Quick heart animation
    btn.style.transform = "scale(1.3)";
    setTimeout(() => (btn.style.transform = ""), 250);
  }
  badge.textContent = wishlistCount;
}

// Intersection Observer for fade-in
const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((el) => {
      if (el.isIntersecting) {
        el.target.style.opacity = "1";
        el.target.style.transform = "translateY(0)";
      }
    });
  },
  { threshold: 0.1 },
);

document
  .querySelectorAll(".product-card, .why-card, .cat-card, .testi-card")
  .forEach((el) => {
    el.style.opacity = "0";
    el.style.transform = "translateY(24px)";
    el.style.transition =
      "opacity 0.6s ease, transform 0.6s ease, box-shadow 0.3s, border-color 0.3s";
    observer.observe(el);
  });

document.addEventListener("DOMContentLoaded", () => {
  const carousel = document.getElementById("heroCarousel");
  let isDown = false,
    startX,
    scrollLeft;
  setInterval(() => {
    if (!carousel || isDown) return;
    let maxScrollLeft = carousel.scrollWidth - carousel.clientWidth;
    let scrollAmount = carousel.scrollLeft + carousel.clientWidth;
    if (carousel.scrollLeft >= maxScrollLeft - 10) scrollAmount = 0;
    carousel.scrollTo({ left: scrollAmount, behavior: "smooth" });
  }, 4000);

  carousel.addEventListener("mousedown", (e) => {
    isDown = true;
    startX = e.pageX - carousel.offsetLeft;
    scrollLeft = carousel.scrollLeft;
  });
  carousel.addEventListener("mouseleave", () => {
    isDown = false;
  });
  carousel.addEventListener("mouseup", () => {
    isDown = false;
  });
  carousel.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const walk = (e.pageX - carousel.offsetLeft - startX) * 2;
    carousel.scrollLeft = scrollLeft - walk;
  });
  carousel.addEventListener(
    "touchstart",
    () => {
      isDown = true;
    },
    { passive: true },
  );
  carousel.addEventListener("touchend", () => {
    isDown = false;
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const testiCarousel = document.getElementById("testiCarousel");
  if (testiCarousel) {
    let isTDown = false,
      startX_T,
      scrollLeft_T;
    setInterval(() => {
      if (!testiCarousel || isTDown) return;
      let maxScrollLeft = testiCarousel.scrollWidth - testiCarousel.clientWidth;
      let scrollAmount = testiCarousel.scrollLeft + testiCarousel.clientWidth;
      if (testiCarousel.scrollLeft >= maxScrollLeft - 10) scrollAmount = 0;
      testiCarousel.scrollTo({ left: scrollAmount, behavior: "smooth" });
    }, 5000);

    testiCarousel.addEventListener("mousedown", (e) => {
      isTDown = true;
      startX_T = e.pageX - testiCarousel.offsetLeft;
      scrollLeft_T = testiCarousel.scrollLeft;
    });
    testiCarousel.addEventListener("mouseleave", () => {
      isTDown = false;
    });
    testiCarousel.addEventListener("mouseup", () => {
      isTDown = false;
    });
    testiCarousel.addEventListener("mousemove", (e) => {
      if (!isTDown) return;
      e.preventDefault();
      const walk = (e.pageX - testiCarousel.offsetLeft - startX_T) * 2;
      testiCarousel.scrollLeft = scrollLeft_T - walk;
    });
    testiCarousel.addEventListener(
      "touchstart",
      () => {
        isTDown = true;
      },
      { passive: true },
    );
    testiCarousel.addEventListener("touchend", () => {
      isTDown = false;
    });
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const relatedCarousel = document.getElementById("relatedCarousel");
  if (relatedCarousel) {
    let isRDown = false,
      startX_R,
      scrollLeft_R;
    setInterval(() => {
      if (!relatedCarousel || isRDown) return;
      let maxScrollLeft = relatedCarousel.scrollWidth - relatedCarousel.clientWidth;
      let scrollAmount = relatedCarousel.scrollLeft + relatedCarousel.clientWidth;
      if (relatedCarousel.scrollLeft >= maxScrollLeft - 10) scrollAmount = 0;
      relatedCarousel.scrollTo({ left: scrollAmount, behavior: "smooth" });
    }, 3000);

    relatedCarousel.addEventListener("mousedown", (e) => {
      isRDown = true;
      startX_R = e.pageX - relatedCarousel.offsetLeft;
      scrollLeft_R = relatedCarousel.scrollLeft;
    });
    relatedCarousel.addEventListener("mouseleave", () => {
      isRDown = false;
    });
    relatedCarousel.addEventListener("mouseup", () => {
      isRDown = false;
    });
    relatedCarousel.addEventListener("mousemove", (e) => {
      if (!isRDown) return;
      e.preventDefault();
      const walk = (e.pageX - relatedCarousel.offsetLeft - startX_R) * 2;
      relatedCarousel.scrollLeft = scrollLeft_R - walk;
    });
    relatedCarousel.addEventListener(
      "touchstart",
      () => {
        isRDown = true;
      },
      { passive: true },
    );
    relatedCarousel.addEventListener("touchend", () => {
      isRDown = false;
    });
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const bannerCarousel = document.getElementById("bannerCarousel");
  if (bannerCarousel) {
    let isBDown = false,
      startX_B,
      scrollLeft_B;
    setInterval(() => {
      if (!bannerCarousel || isBDown) return;
      let maxScrollLeft = bannerCarousel.scrollWidth - bannerCarousel.clientWidth;
      let scrollAmount = bannerCarousel.scrollLeft + bannerCarousel.clientWidth;
      if (bannerCarousel.scrollLeft >= maxScrollLeft - 10) scrollAmount = 0;
      bannerCarousel.scrollTo({ left: scrollAmount, behavior: "smooth" });
    }, 4000);

    bannerCarousel.addEventListener("mousedown", (e) => {
      isBDown = true;
      startX_B = e.pageX - bannerCarousel.offsetLeft;
      scrollLeft_B = bannerCarousel.scrollLeft;
    });
    bannerCarousel.addEventListener("mouseleave", () => {
      isBDown = false;
    });
    bannerCarousel.addEventListener("mouseup", () => {
      isBDown = false;
    });
    bannerCarousel.addEventListener("mousemove", (e) => {
      if (!isBDown) return;
      e.preventDefault();
      const walk = (e.pageX - bannerCarousel.offsetLeft - startX_B) * 2;
      bannerCarousel.scrollLeft = scrollLeft_B - walk;
    });
    bannerCarousel.addEventListener(
      "touchstart",
      () => {
        isBDown = true;
      },
      { passive: true },
    );
    bannerCarousel.addEventListener("touchend", () => {
      isBDown = false;
    });
  }
});
