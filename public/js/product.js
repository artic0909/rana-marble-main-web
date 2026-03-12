

/* ─── Filter Group Toggle ─── */
function toggleGroup(id) {
  document.getElementById(id).classList.toggle("collapsed");
}

/* ─── More Sizes ─── */
let sizesExpanded = false;
function toggleMoreSizes() {
  sizesExpanded = !sizesExpanded;
  document.getElementById("moresSizes").style.display = sizesExpanded
    ? "block"
    : "none";
  document.getElementById("sizeMoreBtn").innerHTML = sizesExpanded
    ? '<i class="fas fa-minus-circle"></i> View Less'
    : '<i class="fas fa-plus-circle"></i> View More (4)';
}

/* ─── Price Range Slider ─── */
function syncRange(which) {
  const min = parseInt(document.getElementById("rangeMin").value);
  const max = parseInt(document.getElementById("rangeMax").value);
  if (which === "min" && min > max) {
    document.getElementById("rangeMin").value = max;
    return;
  }
  if (which === "max" && max < min) {
    document.getElementById("rangeMax").value = min;
    return;
  }
  document.getElementById("priceMin").value = min;
  document.getElementById("priceMax").value = max;
  updateRangeFill();
}
function updateRange() {
  let min = parseInt(document.getElementById("priceMin").value) || 5000;
  let max = parseInt(document.getElementById("priceMax").value) || 500000;
  min = Math.max(5000, Math.min(min, 500000));
  max = Math.max(5000, Math.min(max, 500000));
  if (min > max) [min, max] = [max, min];
  document.getElementById("rangeMin").value = min;
  document.getElementById("rangeMax").value = max;
  document.getElementById("priceMin").value = min;
  document.getElementById("priceMax").value = max;
  updateRangeFill();
}
function updateRangeFill() {
  const min = parseInt(document.getElementById("rangeMin").value);
  const max = parseInt(document.getElementById("rangeMax").value);
  const pMin = ((min - 5000) / 495000) * 100;
  const pMax = ((max - 5000) / 495000) * 100;
  document.getElementById("rangeFill").style.left = pMin + "%";
  document.getElementById("rangeFill").style.right = 100 - pMax + "%";
}
updateRangeFill();

/* ─── Colour Swatches ─── */
function toggleSwatch(el) {
  el.classList.toggle("active");
  applyFilters();
}

/* ─── Wishlist ─── */
let wishCount = 0;
function toggleWishlist(btn) {
  btn.classList.toggle("wishlisted");
  wishCount += btn.classList.contains("wishlisted") ? 1 : -1;
  wishCount = Math.max(0, wishCount);
  document.getElementById("wishBadge").textContent = wishCount;
  btn.style.transform = "scale(1.3)";
  setTimeout(() => (btn.style.transform = ""), 250);
}

/* ─── View Toggle ─── */
function setView(view) {
  const grid = document.getElementById("productGrid");
  if (view === "list") {
    grid.classList.add("list-view");
    document.getElementById("listViewBtn").classList.add("active");
    document.getElementById("gridViewBtn").classList.remove("active");
  } else {
    grid.classList.remove("list-view");
    document.getElementById("gridViewBtn").classList.add("active");
    document.getElementById("listViewBtn").classList.remove("active");
  }
}

/* ─── Sort ─── */
function sortProducts(val) {
  const grid = document.getElementById("productGrid");
  const cards = [...grid.querySelectorAll(".product-card")];
  cards.sort((a, b) => {
    if (val === "price-asc")
      return parseInt(a.dataset.price) - parseInt(b.dataset.price);
    if (val === "price-desc")
      return parseInt(b.dataset.price) - parseInt(a.dataset.price);
    if (val === "name-asc")
      return a
        .querySelector(".product-name")
        .textContent.localeCompare(
          b.querySelector(".product-name").textContent,
        );
    return 0;
  });
  cards.forEach((c) => grid.appendChild(c));
}

/* ─── Filter ─── */
function applyFilters() {
  const cards = document.querySelectorAll(".product-card");
  const catChecks = [
    ...document.querySelectorAll('input[name="cat"]:checked'),
  ].map((i) => i.value);
  const subChecks = [
    ...document.querySelectorAll('input[name="sub"]:checked'),
  ].map((i) => i.value);
  const sizeChecks = [
    ...document.querySelectorAll('input[name="size"]:checked'),
  ].map((i) => i.value);
  const priceMin = parseInt(document.getElementById("priceMin").value) || 0;
  const priceMax =
    parseInt(document.getElementById("priceMax").value) || 999999;
  const activeSwatches = [
    ...document.querySelectorAll(".swatch-item.active"),
  ].map((s) => s.title.toLowerCase());

  let visible = 0;
  const tags = [];

  cards.forEach((card) => {
    const cat = card.dataset.cat;
    const sub = card.dataset.sub;
    const size = card.dataset.size;
    const price = parseInt(card.dataset.price);
    const finish = card.dataset.finish;

    const catOk =
      catChecks.includes("all") ||
      catChecks.length === 0 ||
      catChecks.includes(cat);
    const subOk = subChecks.length === 0 || subChecks.includes(sub);
    const sizeOk = sizeChecks.length === 0 || sizeChecks.includes(size);
    const priceOk = price >= priceMin && price <= priceMax;
    const finishOk =
      activeSwatches.length === 0 ||
      activeSwatches.some(
        (s) =>
          s.includes(finish) || finish.includes(s.split(" ")[0].toLowerCase()),
      );

    const show = catOk && subOk && sizeOk && priceOk && finishOk;
    card.style.display = show ? "" : "none";
    if (show) visible++;
  });

  document.getElementById("showingCount").textContent = visible;

  // Active filter tags
  const tagsContainer = document.getElementById("activeTags");
  tagsContainer.innerHTML = "";
  if (!catChecks.includes("all") && catChecks.length)
    catChecks.forEach((c) => addTag(tagsContainer, c, "cat"));
  if (subChecks.length)
    subChecks.forEach((s) => addTag(tagsContainer, s, "sub"));
  if (sizeChecks.length)
    sizeChecks.forEach((s) =>
      addTag(tagsContainer, s.replace("x", "×") + " in", "size"),
    );

  // Mobile badge
  const total =
    catChecks.filter((c) => c !== "all").length +
    subChecks.length +
    sizeChecks.length;
  document.getElementById("filterBadgeMob").textContent =
    total > 0 ? total : "";
}

function addTag(container, label, type) {
  const tag = document.createElement("span");
  tag.className = "filter-tag";
  tag.innerHTML = label + ' <i class="fas fa-times"></i>';
  tag.onclick = () => {
    document
      .querySelectorAll(
        `input[name="${type}"][value*="${label.split("×")[0].trim()}"]`,
      )
      .forEach((i) => (i.checked = false));
    applyFilters();
  };
  container.appendChild(tag);
}

function clearAllFilters() {
  document
    .querySelectorAll(
      '.sidebar input[type="checkbox"], .sidebar-mobile input[type="checkbox"]',
    )
    .forEach((i) => {
      i.checked = i.name === "cat" && i.value === "all";
    });
  document
    .querySelectorAll('input[name="rating"]')
    .forEach((r) => (r.checked = r.value === "any"));
  document.getElementById("priceMin").value = 5000;
  document.getElementById("priceMax").value = 500000;
  document.getElementById("rangeMin").value = 5000;
  document.getElementById("rangeMax").value = 500000;
  updateRangeFill();
  document.querySelectorAll(".swatch-item").forEach((s, i) => {
    if (i !== 0) s.classList.remove("active");
    else s.classList.add("active");
  });
  applyFilters();
}

/* ─── Mobile Filter Sidebar ─── */
function openMobileFilter() {
  // Clone desktop sidebar content into mobile
  const content = document.getElementById("desktopSidebar").innerHTML;
  document.getElementById("mobileSidebarContent").innerHTML = content;
  // Remove the sidebar-header and sidebar-apply (already handled separately)
  const mobileHeader = document.querySelector(
    "#mobileSidebarContent .sidebar-header",
  );
  const mobileApply = document.querySelector(
    "#mobileSidebarContent .sidebar-apply",
  );
  if (mobileHeader) mobileHeader.remove();
  if (mobileApply) mobileApply.remove();

  document.getElementById("filterOverlay").classList.add("open");
  document.getElementById("mobileSidebar").classList.add("open");
  document.body.style.overflow = "hidden";
}
function closeMobileFilter() {
  document.getElementById("filterOverlay").classList.remove("open");
  document.getElementById("mobileSidebar").classList.remove("open");
  document.body.style.overflow = "";
}


document.querySelectorAll(".product-card").forEach((el, i) => {
  el.style.opacity = "0";
  el.style.transform = "translateY(20px)";
  el.style.transition = `opacity 0.5s ${i * 0.06}s ease, transform 0.5s ${i * 0.06}s ease, box-shadow 0.3s, border-color 0.3s`;
  prodObserver.observe(el);
});
