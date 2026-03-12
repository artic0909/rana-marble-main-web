/* ─── Nav ─── */
function toggleMobileNav() {
  document.getElementById("mobileNav").classList.toggle("open");
}

/* ─── Scroll Top ─── */
const scrollTopBtn = document.getElementById("scrollTop");
window.addEventListener("scroll", () => {
  scrollTopBtn.classList.toggle("visible", window.scrollY > 400);
});
scrollTopBtn.addEventListener("click", (e) => {
  e.preventDefault();
  window.scrollTo({ top: 0, behavior: "smooth" });
});

/* ─── Image Gallery ─── */
/* ─── Image Gallery ─── */
let currentImg = "./img/hero.png";
let currentMediaType = 'image';

function switchMedia(thumb, type, src) {
  document.querySelectorAll(".thumb").forEach((t) => t.classList.remove("active"));
  thumb.classList.add("active");
  
  const img = document.getElementById("mainImg");
  const video = document.getElementById("mainVideo");
  const zoomHint = document.getElementById("zoomHint");

  currentImg = src;
  currentMediaType = type;

  // Simple fade out transition for current media
  img.style.opacity = "0";
  video.style.opacity = "0";
  
  setTimeout(() => {
    if (type === 'video') {
      img.style.display = "none";
      zoomHint.style.display = "none";
      video.style.display = "block";
      video.src = src;
      video.play().catch(e => console.log("Auto-play prevented", e));
      video.style.opacity = "1";
    } else {
      video.style.display = "none";
      video.pause();
      img.style.display = "block";
      zoomHint.style.display = "block";
      img.src = src;
      img.style.opacity = "1";
    }
  }, 180);
}

// Wrapper for existing onclick calls in main image wrap
function openLightbox(src) {
  if (currentMediaType === 'video') {
    openReviewMediaLightbox(null, 'video', currentImg);
  } else {
    openReviewMediaLightbox(null, 'image', currentImg);
  }
}

/* ─── Lightbox ─── */
function openReviewMediaLightbox(element, type = 'image', srcOverride = null) {
  const lb = document.getElementById("lightbox");
  const lbImg = document.getElementById("lightboxImg");
  const lbVideo = document.getElementById("lightboxVideo");
  
  lbImg.style.display = "none";
  lbVideo.style.display = "none";
  lbVideo.pause();

  const src = srcOverride || element.src;
  
  if (type === 'video') {
    lbVideo.src = src;
    lbVideo.style.display = "block";
    lbVideo.play().catch(e => console.log(e));
  } else {
    lbImg.src = src;
    lbImg.style.display = "block";
  }

  lb.style.display = "flex";
  document.body.style.overflow = "hidden";
}

function closeLightbox() {
  document.getElementById("lightbox").style.display = "none";
  document.getElementById("lightboxVideo").pause();
  document.body.style.overflow = "";
}

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") closeLightbox();
});

/* ─── Wishlist ─── */
let wished = false;
let wishCount = 0;
function toggleWish() {
  wished = !wished;
  ["wishMainBtn", "wishCta", "stickyWishBtn"].forEach((id) => {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.toggle("active", wished);
    const icon = el.querySelector("i");
    if (icon) {
      icon.style.color = wished ? "#6B1A1A" : "";
    }
  });
  wishCount = wished ? 1 : 0;
  document.getElementById("wishBadge").textContent = wishCount;
}
function toggleMainWish() {
  toggleWish();
}

function toggleWishlist(btn) {
  btn.classList.toggle("wishlisted");
  const icon = btn.querySelector("i");
  if (icon)
    icon.style.color = btn.classList.contains("wishlisted") ? "#6B1A1A" : "";
}

/* ─── Size Selector ─── */
function selectSize(el, label) {
  document
    .querySelectorAll(".size-opt")
    .forEach((o) => o.classList.remove("active"));
  el.classList.add("active");
  document.getElementById("selectedSize").textContent = "(" + label + ")";
}

/* ─── Finish Selector ─── */
function selectFinish(el, label) {
  document
    .querySelectorAll(".finish-opt")
    .forEach((o) => o.classList.remove("active"));
  el.classList.add("active");
  document.getElementById("selectedFinish").textContent = "(" + label + ")";
}

/* ─── Tabs ─── */
function switchTab(btn, panelId) {
  document
    .querySelectorAll(".tab-btn")
    .forEach((b) => b.classList.remove("active"));
  document
    .querySelectorAll(".tab-panel")
    .forEach((p) => p.classList.remove("active"));
  btn.classList.add("active");
  document.getElementById(panelId).classList.add("active");
  // Scroll to tabs on mobile
  if (window.innerWidth < 900) {
    document
      .querySelector(".tabs-section")
      .scrollIntoView({ behavior: "smooth", block: "start" });
  }
}

/* ─── Copy Link ─── */
function copyLink() {
  navigator.clipboard.writeText(window.location.href).then(() => {
    const btn = event.target.closest(".share-btn");
    btn.innerHTML = '<i class="fas fa-check"></i>';
    setTimeout(() => {
      btn.innerHTML = '<i class="fas fa-link"></i>';
    }, 2000);
  });
}

/* ─── Thumbnail keyboard nav ─── */
document.querySelectorAll(".thumb").forEach((thumb, i, all) => {
  thumb.setAttribute("tabindex", "0");
  thumb.addEventListener("keydown", (e) => {
    if (e.key === "Enter") thumb.click();
    if (e.key === "ArrowRight" && all[i + 1]) all[i + 1].focus();
    if (e.key === "ArrowLeft" && all[i - 1]) all[i - 1].focus();
  });
});

/* ─── Scroll-triggered animations ─── */
const obs = new IntersectionObserver(
  (entries) => {
    entries.forEach((el) => {
      if (el.isIntersecting) {
        el.target.style.opacity = "1";
        el.target.style.transform = "translateY(0)";
      }
    });
  },
  { threshold: 0.08 },
);
document
  .querySelectorAll(
    ".product-card, .ship-card, .spec-card, .trust-item, .review-card",
  )
  .forEach((el, i) => {
    el.style.opacity = "0";
    el.style.transform = "translateY(18px)";
    el.style.transition = `opacity 0.5s ${i * 0.07}s ease, transform 0.5s ${i * 0.07}s ease, box-shadow 0.3s, border-color 0.3s`;
    obs.observe(el);
  });

function validatePincode() {
  const input = document.getElementById("pincodeInput");
  const val = input.value.replace(/\D/g, "");
  input.value = val;
  input.className =
    val.length === 6 ? "valid" : val.length > 0 ? "invalid" : "";
}

function checkDelivery() {
  const val = document.getElementById("pincodeInput").value;
  const result = document.getElementById("deliveryResult");
  if (val.length !== 6) {
    result.className = "error";
    result.innerHTML =
      '<i class="fas fa-times-circle"></i> Please enter a valid 6-digit pincode.';
    return;
  }
  // Static delivery info
  result.className = "success";
  result.innerHTML =
    '<i class="fas fa-check-circle"></i> Delivery available! Estimated charge: ₹1,500 – ₹3,000 depending on weight. Free above ₹25,000.';
}

/* ─── Star Rating Picker ─── */
let selectedRatingValue = 0;
function setRating(val) {
  selectedRatingValue = val;
  document.getElementById("selectedRating").value = val;
  document.querySelectorAll(".stars-input i").forEach((star, i) => {
    star.className = i < val ? "fas fa-star" : "far fa-star";
    star.style.color = i < val ? "#c9a84c" : "";
  });
}

// Hover effect
document.addEventListener("DOMContentLoaded", () => {
  const stars = document.querySelectorAll(".stars-input i");
  stars.forEach((star, i) => {
    star.addEventListener("mouseenter", () => {
      stars.forEach((s, j) => {
        s.className = j <= i ? "fas fa-star" : "far fa-star";
        s.style.color = j <= i ? "#c9a84c" : "";
      });
    });
    star.addEventListener("mouseleave", () => {
      stars.forEach((s, j) => {
        s.className = j < selectedRatingValue ? "fas fa-star" : "far fa-star";
        s.style.color = j < selectedRatingValue ? "#c9a84c" : "";
      });
    });
  });
});

/* ─── Review Submit ─── */
function submitReview(e) {
  e.preventDefault();
  const rating = document.getElementById("selectedRating").value;
  if (!rating || rating === "0") {
    alert("Please select a star rating before submitting.");
    return;
  }
  const form = e.target;
  form.style.opacity = "0.5";
  form.style.pointerEvents = "none";
  setTimeout(() => {
    form.style.opacity = "1";
    form.style.pointerEvents = "";
    form.reset();
    setRating(0);
    selectedRatingValue = 0;
    
    // Clear media previews
    const previewContainer = document.getElementById("reviewMediaPreview");
    if (previewContainer) previewContainer.innerHTML = "";

    document.getElementById("reviewSuccess").style.display = "flex";
    setTimeout(() => {
      document.getElementById("reviewSuccess").style.display = "none";
    }, 5000);
  }, 800);
}

/* ─── Review Media Upload Handler ─── */
function handleReviewMedia(input) {
  const previewContainer = document.getElementById('reviewMediaPreview');
  previewContainer.innerHTML = '';
  
  if (input.files && input.files.length > 0) {
    Array.from(input.files).forEach(file => {
      const reader = new FileReader();
      const isVideo = file.type.startsWith('video/');
      
      reader.onload = function(e) {
        if (isVideo) {
          const videoElement = document.createElement('video');
          videoElement.src = e.target.result;
          videoElement.className = 'preview-thumb';
          videoElement.muted = true;
          // Play a snippet to grab a frame, then pause
          videoElement.onloadeddata = () => {
             videoElement.currentTime = 1;
          };
          previewContainer.appendChild(videoElement);
        } else {
          const img = document.createElement('img');
          img.src = e.target.result;
          img.className = 'preview-thumb';
          previewContainer.appendChild(img);
        }
      }
      reader.readAsDataURL(file);
    });
  }
}
