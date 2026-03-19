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
    applyFilters();
}

function updateRange() {
    const absMin = parseInt(document.getElementById("rangeMin").min);
    const absMax = parseInt(document.getElementById("rangeMax").max);
    let min = parseInt(document.getElementById("priceMin").value) || absMin;
    let max = parseInt(document.getElementById("priceMax").value) || absMax;
    min = Math.max(absMin, Math.min(min, absMax));
    max = Math.max(absMin, Math.min(max, absMax));
    if (min > max) [min, max] = [max, min];
    document.getElementById("rangeMin").value = min;
    document.getElementById("rangeMax").value = max;
    document.getElementById("priceMin").value = min;
    document.getElementById("priceMax").value = max;
    updateRangeFill();
    applyFilters();
}

function updateRangeFill() {
    const rangeMin = document.getElementById("rangeMin");
    const absMin = parseInt(rangeMin.min);
    const absMax = parseInt(rangeMin.max);
    const min = parseInt(rangeMin.value);
    const max = parseInt(document.getElementById("rangeMax").value);
    const range = absMax - absMin;
    if (range === 0) return;
    const pMin = ((min - absMin) / range) * 100;
    const pMax = ((max - absMin) / range) * 100;
    document.getElementById("rangeFill").style.left = pMin + "%";
    document.getElementById("rangeFill").style.right = 100 - pMax + "%";
}

/* ─── Colour Swatches ─── */
// context = "desktop" | "mobile"
// Desktop swatches toggle directly and filter immediately
// Mobile swatches only toggle visually — written to desktop on Apply
function toggleSwatch(el, context) {
    el.classList.toggle("active");
    if (context !== "mobile") {
        // Desktop: immediately apply
        applyFilters();
    }
    // Mobile: just visual — applyMobileFilters() will sync on Apply tap
}

/* ─── Wishlist ─── */
let wishCount = 0;
function toggleWishlist(btn) {
    btn.classList.toggle("wishlisted");
    wishCount += btn.classList.contains("wishlisted") ? 1 : -1;
    wishCount = Math.max(0, wishCount);
    const badge = document.getElementById("wishBadge");
    if (badge) badge.textContent = wishCount;
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

/* ═══════════════════════════════════════════════════════
   SINGLE SOURCE OF TRUTH — #desktopSidebar
   All filter reads always come from #desktopSidebar only.
   Mobile clones state IN on open, writes state OUT on Apply.
   ═══════════════════════════════════════════════════════ */

function applyFilters() {
    const sidebar = document.getElementById("desktopSidebar");
    const cards = document.querySelectorAll(".product-card");

    const catChecks = [
        ...sidebar.querySelectorAll('input[name="cat"]:checked'),
    ].map((i) => i.value);
    const subChecks = [
        ...sidebar.querySelectorAll('input[name="sub"]:checked'),
    ].map((i) => i.value);
    const sizeChecks = [
        ...sidebar.querySelectorAll('input[name="size"]:checked'),
    ].map((i) => i.value);

    const priceMin = parseInt(document.getElementById("priceMin").value) || 0;
    const priceMax =
        parseInt(document.getElementById("priceMax").value) || 999999999;

    // Read active swatches ONLY from desktop sidebar
    const activeSwatches = [
        ...sidebar.querySelectorAll(".swatch-item.active"),
    ].map((s) => s.title.toLowerCase().trim());

    let visible = 0;

    cards.forEach((card) => {
        const cat = card.dataset.cat || "";
        const sub = card.dataset.sub || "";
        const size = card.dataset.size || "";
        const price = parseInt(card.dataset.price) || 0;
        const finish = card.dataset.finish || "";

        // Category
        const catOk =
            catChecks.includes("all") ||
            catChecks.length === 0 ||
            catChecks.includes(cat);

        // Sub-category
        const subOk = subChecks.length === 0 || subChecks.includes(sub);

        // Size — space-separated slugs
        const cardSizes = size ? size.split(" ").filter(Boolean) : [];
        const sizeOk =
            sizeChecks.length === 0 ||
            sizeChecks.some((s) => cardSizes.includes(s));

        // Price
        const priceOk = price >= priceMin && price <= priceMax;

        // Finish — space-separated lowercase color names
        // e.g. data-finish="white gold" matched against swatch title="white"
        const cardFinishes = finish ? finish.split(" ").filter(Boolean) : [];
        const finishOk =
            activeSwatches.length === 0 ||
            activeSwatches.some((swatch) =>
                cardFinishes.some(
                    (f) => f.includes(swatch) || swatch.includes(f),
                ),
            );

        const show = catOk && subOk && sizeOk && priceOk && finishOk;
        card.style.display = show ? "" : "none";
        if (show) visible++;
    });

    // Update showing count
    const showingEl = document.getElementById("showingCount");
    if (showingEl) showingEl.textContent = visible;

    // Active filter tags — only from desktop, no duplicates
    const tagsContainer = document.getElementById("activeTags");
    if (tagsContainer) {
        tagsContainer.innerHTML = "";
        if (!catChecks.includes("all") && catChecks.length)
            catChecks.forEach((c) => addTag(tagsContainer, c, "cat"));
        if (subChecks.length)
            subChecks.forEach((s) => addTag(tagsContainer, s, "sub"));
        if (sizeChecks.length)
            sizeChecks.forEach((s) =>
                addTag(tagsContainer, s.replace("x", "×") + " in", "size"),
            );
    }

    // Mobile badge
    const total =
        catChecks.filter((c) => c !== "all").length +
        subChecks.length +
        sizeChecks.length;
    const mob = document.getElementById("filterBadgeMob");
    if (mob) mob.textContent = total > 0 ? total : "";
}

/* ─── Add Filter Tag ─── */
function addTag(container, label, type) {
    const tag = document.createElement("span");
    tag.className = "filter-tag";
    tag.innerHTML = label + ' <i class="fas fa-times"></i>';
    tag.onclick = () => {
        document
            .getElementById("desktopSidebar")
            .querySelectorAll(
                `input[name="${type}"][value*="${label.split("×")[0].trim()}"]`,
            )
            .forEach((i) => (i.checked = false));
        applyFilters();
    };
    container.appendChild(tag);
}

/* ─── Clear All Filters ─── */
function clearAllFilters() {
    const sidebar = document.getElementById("desktopSidebar");
    const absMin = parseInt(document.getElementById("rangeMin").min);
    const absMax = parseInt(document.getElementById("rangeMax").max);

    sidebar.querySelectorAll('input[type="checkbox"]').forEach((i) => {
        i.checked = i.name === "cat" && i.value === "all";
    });

    sidebar
        .querySelectorAll('input[name="rating"]')
        .forEach((r) => (r.checked = r.value === "any"));

    document.getElementById("priceMin").value = absMin;
    document.getElementById("priceMax").value = absMax;
    document.getElementById("rangeMin").value = absMin;
    document.getElementById("rangeMax").value = absMax;
    updateRangeFill();

    sidebar
        .querySelectorAll(".swatch-item")
        .forEach((s) => s.classList.remove("active"));

    applyFilters();
}

/* ─── Mobile Filter Sidebar ─── */
function openMobileFilter() {
    const desktop = document.getElementById("desktopSidebar");

    // Clone desktop HTML into mobile panel
    document.getElementById("mobileSidebarContent").innerHTML =
        desktop.innerHTML;

    // Remove cloned header/apply — mobile has its own
    const mobileHeader = document.querySelector(
        "#mobileSidebarContent .sidebar-header",
    );
    const mobileApply = document.querySelector(
        "#mobileSidebarContent .sidebar-apply",
    );
    if (mobileHeader) mobileHeader.remove();
    if (mobileApply) mobileApply.remove();

    // ── Sync checkbox state desktop → mobile clone ──
    desktop
        .querySelectorAll('input[type="checkbox"]')
        .forEach((desktopInput) => {
            const mobileInput = document.querySelector(
                `#mobileSidebarContent input[type="checkbox"][name="${desktopInput.name}"][value="${desktopInput.value}"]`,
            );
            if (mobileInput) mobileInput.checked = desktopInput.checked;
        });

    // ── Sync price range desktop → mobile clone ──
    const mobileMin = document.querySelector("#mobileSidebarContent #priceMin");
    const mobileMax = document.querySelector("#mobileSidebarContent #priceMax");
    const mobileRangeMin = document.querySelector(
        "#mobileSidebarContent #rangeMin",
    );
    const mobileRangeMax = document.querySelector(
        "#mobileSidebarContent #rangeMax",
    );
    if (mobileMin) mobileMin.value = document.getElementById("priceMin").value;
    if (mobileMax) mobileMax.value = document.getElementById("priceMax").value;
    if (mobileRangeMin)
        mobileRangeMin.value = document.getElementById("rangeMin").value;
    if (mobileRangeMax)
        mobileRangeMax.value = document.getElementById("rangeMax").value;

    // ── Sync swatch active state desktop → mobile clone ──
    desktop.querySelectorAll(".swatch-item").forEach((desktopSwatch, i) => {
        const mobileSwatch = document.querySelectorAll(
            "#mobileSidebarContent .swatch-item",
        )[i];
        if (!mobileSwatch) return;
        desktopSwatch.classList.contains("active")
            ? mobileSwatch.classList.add("active")
            : mobileSwatch.classList.remove("active");
    });

    // ── Fix mobile swatch onclick to use mobile context ──
    // Prevents mobile swatches from calling applyFilters() on the desktop
    document
        .querySelectorAll("#mobileSidebarContent .swatch-item")
        .forEach((swatch) => {
            swatch.setAttribute("onclick", "toggleSwatch(this, 'mobile')");
        });

    // ── Fix mobile checkboxes — remove onchange so they don't trigger desktop applyFilters ──
    document
        .querySelectorAll("#mobileSidebarContent input[type='checkbox']")
        .forEach((input) => {
            input.removeAttribute("onchange");
        });

    // ── Fix mobile price inputs — remove onchange so they don't trigger desktop applyFilters ──
    document
        .querySelectorAll("#mobileSidebarContent input[type='number']")
        .forEach((input) => {
            input.removeAttribute("onchange");
        });
    document
        .querySelectorAll("#mobileSidebarContent input[type='range']")
        .forEach((input) => {
            input.removeAttribute("oninput");
        });

    document.getElementById("filterOverlay").classList.add("open");
    document.getElementById("mobileSidebar").classList.add("open");
    document.body.style.overflow = "hidden";
}

/* ─── Apply Mobile Filters — writes clone → desktop, then filters ─── */
function applyMobileFilters() {
    const desktop = document.getElementById("desktopSidebar");

    // ── Write checkbox state mobile clone → desktop ──
    document
        .querySelectorAll('#mobileSidebarContent input[type="checkbox"]')
        .forEach((mobileInput) => {
            const desktopInput = desktop.querySelector(
                `input[type="checkbox"][name="${mobileInput.name}"][value="${mobileInput.value}"]`,
            );
            if (desktopInput) desktopInput.checked = mobileInput.checked;
        });

    // ── Write price range mobile clone → desktop ──
    const mobileMin = document.querySelector("#mobileSidebarContent #priceMin");
    const mobileMax = document.querySelector("#mobileSidebarContent #priceMax");
    const mobileRangeMin = document.querySelector(
        "#mobileSidebarContent #rangeMin",
    );
    const mobileRangeMax = document.querySelector(
        "#mobileSidebarContent #rangeMax",
    );
    if (mobileMin) document.getElementById("priceMin").value = mobileMin.value;
    if (mobileMax) document.getElementById("priceMax").value = mobileMax.value;
    if (mobileRangeMin)
        document.getElementById("rangeMin").value = mobileRangeMin.value;
    if (mobileRangeMax)
        document.getElementById("rangeMax").value = mobileRangeMax.value;
    updateRangeFill();

    // ── Write swatch active state mobile clone → desktop ──
    document
        .querySelectorAll("#mobileSidebarContent .swatch-item")
        .forEach((mobileSwatch, i) => {
            const desktopSwatch = desktop.querySelectorAll(".swatch-item")[i];
            if (!desktopSwatch) return;
            mobileSwatch.classList.contains("active")
                ? desktopSwatch.classList.add("active")
                : desktopSwatch.classList.remove("active");
        });

    // Run filter — always reads from desktop (single source of truth)
    applyFilters();
    closeMobileFilter();
}

function closeMobileFilter() {
    document.getElementById("filterOverlay").classList.remove("open");
    document.getElementById("mobileSidebar").classList.remove("open");
    document.body.style.overflow = "";
}

/* ─── Card Entrance Animation ─── */
const prodObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
                prodObserver.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.1 },
);

document.querySelectorAll(".product-card").forEach((el, i) => {
    el.style.opacity = "0";
    el.style.transform = "translateY(20px)";
    el.style.transition = `opacity 0.5s ${i * 0.06}s ease, transform 0.5s ${i * 0.06}s ease, box-shadow 0.3s, border-color 0.3s`;
    prodObserver.observe(el);
});

/* ─── Init on load ─── */
document.addEventListener("DOMContentLoaded", () => {
    updateRangeFill();
    applyFilters();
});
