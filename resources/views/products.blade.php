@extends('frontend.layout.app')

@section('title', 'All Products – Rana Marble | Divine Marble Mandirs & Idols')

@section('content')

<head>
    <link rel="stylesheet" href="{{asset('./css/product.css')}}">
    <style>
        .btn-add-list {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-family: "Cinzel", serif;
            font-size: 0.72rem;
            letter-spacing: 0.06em;
            background: var(--maroon);
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid var(--maroon);
            cursor: pointer;
            font-weight: 600;
        }

        .btn-add-list:hover {
            color: var(--maroon);
            background-color: white;
            box-shadow: 0 4px 14px rgba(107, 26, 26, 0.2);
        }
    </style>
</head>

<!-- Page Banner Carousel -->
<section class="hero" id="heroSection"
    style="position: relative; min-height: 46vh; overflow-y: hidden; overflow-x: hidden; display: flex; align-items: center; justify-content: center; background: #1a0a00;">
    <div id="heroCarousel" class="hero-bg-carousel"
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; overflow-x: auto; overflow-y: hidden; scroll-snap-type: x mandatory; scrollbar-width: none; -ms-overflow-style: none; scroll-behavior: smooth;">
        <style>
            .hero-bg-carousel::-webkit-scrollbar {
                display: none;
            }
        </style>
        <!-- Slides -->
        <div class="hero-slide" style="flex: 0 0 100%; height: 100%; scroll-snap-align: start; position: relative;">
            <img src="./img/hero.png" alt="Slide 1"
                style="width: 100%; height: 100%; object-fit: cover; filter: brightness(0.6);" />
        </div>
        <div class="hero-slide" style="flex: 0 0 100%; height: 100%; scroll-snap-align: start; position: relative;">
            <img src="./img/hero.png" alt="Slide 2"
                style="width: 100%; height: 100%; object-fit: cover; filter: brightness(0.6);" />
        </div>
        <div class="hero-slide" style="flex: 0 0 100%; height: 100%; scroll-snap-align: start; position: relative;">
            <img src="./img/hero.png" alt="Slide 3"
                style="width: 100%; height: 100%; object-fit: cover; filter: brightness(0.6);" />
        </div>
    </div>

    <div class="hero-mandala" style="pointer-events: none;"></div>
    <div class="hero-glow" style="pointer-events: none;"></div>
    <div class="hero-particles" style="pointer-events: none;"></div>

    <div class="hero-content"
        style="position: relative; z-index: 10; pointer-events: none; margin: 0 auto; text-align: center; justify-content: center; width: 100%; display: flex; flex-direction: column;">
        <div class="hero-text" style="pointer-events: auto; padding: 20px;">

            <h1 class="hero-title">
                Sacred <span class="accent">Marble Mandirs</span><br />Crafted with Devotion
            </h1>
        </div>
    </div>
</section>

<!-- Mobile Filter Overlay -->
<div class="filter-overlay" id="filterOverlay" onclick="closeMobileFilter()"></div>
<div class="sidebar-mobile" id="mobileSidebar">
    <div class="sidebar-mobile-close">
        <h3><i class="fas fa-sliders-h"></i> &nbsp; Filter Products</h3>
        <button onclick="closeMobileFilter()"><i class="fas fa-times"></i></button>
    </div>
    <div id="mobileSidebarContent"></div>
    <div class="sidebar-apply">
        <button class="btn-apply-filter" onclick="applyFilters(); closeMobileFilter();">
            <i class="fas fa-check-circle"></i> Apply Filters
        </button>
    </div>
</div>

<!-- ═══ SHOP WRAPPER ═══ -->
<div class="shop-wrapper">

    <!-- ─── SIDEBAR ─── -->
    <aside class="sidebar" id="desktopSidebar">

        <div class="sidebar-header">
            <h3><i class="fas fa-sliders-h"></i> Filter Products</h3>
            <button class="btn-clear-all" onclick="clearAllFilters()">Clear All</button>
        </div>

        <!-- Category -->
        <div class="filter-group" id="fg-category">
            <div class="filter-group-header" onclick="toggleGroup('fg-category')">
                <h4><i class="fas fa-th-large"></i> Category</h4>
                <div class="filter-toggle"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="filter-body">
                <label class="filter-item"><input type="checkbox" name="cat" value="all" checked
                        onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">All Products</span><span
                        class="filter-count">48</span>
                </label>
                <label class="filter-item"><input type="checkbox" name="cat" value="mandir"
                        onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Home Mandirs</span><span
                        class="filter-count">18</span>
                </label>
                <label class="filter-item"><input type="checkbox" name="cat" value="idol" onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Marble Idols</span><span
                        class="filter-count">12</span>
                </label>
                <label class="filter-item"><input type="checkbox" name="cat" value="painted"
                        onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Gold Painted Mandirs</span><span
                        class="filter-count">9</span>
                </label>
                <label class="filter-item"><input type="checkbox" name="cat" value="jaali"
                        onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Jaali Panels</span><span
                        class="filter-count">6</span>
                </label>
                <label class="filter-item"><input type="checkbox" name="cat" value="fountain"
                        onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Marble Fountains</span><span
                        class="filter-count">3</span>
                </label>
            </div>
        </div>

        <!-- Sub Category -->
        <div class="filter-group" id="fg-sub">
            <div class="filter-group-header" onclick="toggleGroup('fg-sub')">
                <h4><i class="fas fa-layer-group"></i> Sub Categories</h4>
                <div class="filter-toggle"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="filter-body">
                <label class="filter-item"><input type="checkbox" name="sub" value="flagship"
                        onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Flagship</span><span
                        class="filter-count">10</span>
                </label>
                <label class="filter-item"><input type="checkbox" name="sub" value="signature"
                        onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Signature</span><span
                        class="filter-count">15</span>
                </label>
                <label class="filter-item"><input type="checkbox" name="sub" value="eco" onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Eco Series</span><span
                        class="filter-count">8</span>
                </label>
                <label class="filter-item"><input type="checkbox" name="sub" value="custom"
                        onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Custom Made</span><span
                        class="filter-count">5</span>
                </label>
            </div>
        </div>

        <!-- Sizes -->
        <div class="filter-group" id="fg-size">
            <div class="filter-group-header" onclick="toggleGroup('fg-size')">
                <h4><i class="fas fa-ruler-combined"></i> Sizes</h4>
                <div class="filter-toggle"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="filter-body">
                <label class="filter-item"><input type="checkbox" name="size" value="24x24"
                        onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Width: 24 in, Depth: 24 in</span>
                </label>
                <label class="filter-item"><input type="checkbox" name="size" value="30x24"
                        onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Width: 30 in, Depth: 24 in</span>
                </label>
                <label class="filter-item"><input type="checkbox" name="size" value="36x24"
                        onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Width: 36 in, Depth: 24 in</span>
                </label>
                <label class="filter-item"><input type="checkbox" name="size" value="36x32"
                        onchange="applyFilters()">
                    <div class="custom-check"></div><span class="filter-label">Width: 36 in, Depth: 32 in</span>
                </label>
                <div id="moresSizes" style="display:none;">
                    <label class="filter-item"><input type="checkbox" name="size" value="42x24"
                            onchange="applyFilters()">
                        <div class="custom-check"></div><span class="filter-label">Width: 42 in, Depth: 24 in</span>
                    </label>
                    <label class="filter-item"><input type="checkbox" name="size" value="48x24"
                            onchange="applyFilters()">
                        <div class="custom-check"></div><span class="filter-label">Width: 48 in, Depth: 24 in</span>
                    </label>
                    <label class="filter-item"><input type="checkbox" name="size" value="54x24"
                            onchange="applyFilters()">
                        <div class="custom-check"></div><span class="filter-label">Width: 54 in, Depth: 24 in</span>
                    </label>
                    <label class="filter-item"><input type="checkbox" name="size" value="60x24"
                            onchange="applyFilters()">
                        <div class="custom-check"></div><span class="filter-label">Width: 60 in, Depth: 24 in</span>
                    </label>
                </div>
                <button class="view-more-btn" id="sizeMoreBtn" onclick="toggleMoreSizes()">
                    <i class="fas fa-plus-circle"></i> View More (4)
                </button>
            </div>
        </div>

        <!-- Finish / Color -->
        <div class="filter-group" id="fg-finish">
            <div class="filter-group-header" onclick="toggleGroup('fg-finish')">
                <h4><i class="fas fa-palette"></i> Finish & Colour</h4>
                <div class="filter-toggle"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="swatch-grid">
                <div class="swatch-item active" onclick="toggleSwatch(this)" title="Pure White">
                    <div class="swatch" style="background:#F8F5EE; border:1.5px solid #ddd;"></div>
                    <span class="swatch-label">White</span>
                </div>
                <div class="swatch-item" onclick="toggleSwatch(this)" title="Gold Painted">
                    <div class="swatch" style="background:linear-gradient(135deg,#C9A84C,#F0D080);"></div>
                    <span class="swatch-label">Gold</span>
                </div>
                <div class="swatch-item" onclick="toggleSwatch(this)" title="Multicolour">
                    <div class="swatch" style="background:conic-gradient(#D4722A,#C9A84C,#6B1A1A,#2D1B4E,#D4722A);">
                    </div>
                    <span class="swatch-label">Multi</span>
                </div>
                <div class="swatch-item" onclick="toggleSwatch(this)" title="Natural Polish">
                    <div class="swatch" style="background:linear-gradient(135deg,#E8E0D0,#C0B89A);"></div>
                    <span class="swatch-label">Natural</span>
                </div>
                <div class="swatch-item" onclick="toggleSwatch(this)" title="Sandstone Beige">
                    <div class="swatch" style="background:linear-gradient(135deg,#D4B896,#B89070);"></div>
                    <span class="swatch-label">Beige</span>
                </div>
            </div>
        </div>

        <!-- Price Range -->
        <div class="filter-group" id="fg-price">
            <div class="filter-group-header" onclick="toggleGroup('fg-price')">
                <h4><i class="fas fa-rupee-sign"></i> Price Range</h4>
                <div class="filter-toggle"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="price-range-wrap">
                <div class="price-inputs">
                    <div class="price-input-group">
                        <span>₹</span>
                        <input type="number" id="priceMin" value="5000" min="5000" max="500000" placeholder="Min"
                            onchange="updateRange()" />
                    </div>
                    <span class="price-dash">–</span>
                    <div class="price-input-group">
                        <span>₹</span>
                        <input type="number" id="priceMax" value="500000" min="5000" max="500000" placeholder="Max"
                            onchange="updateRange()" />
                    </div>
                </div>
                <div class="range-slider-wrap">
                    <div class="range-track"></div>
                    <div class="range-fill" id="rangeFill"></div>
                    <input type="range" class="dual-range" id="rangeMin" min="5000" max="500000" value="5000"
                        step="1000" oninput="syncRange('min')" />
                    <input type="range" class="dual-range" id="rangeMax" min="5000" max="500000" value="500000"
                        step="1000" oninput="syncRange('max')" />
                </div>
                <div class="range-labels"><span>₹5,000</span><span>₹5,00,000+</span></div>
            </div>
        </div>

        <!-- Rating -->
        <div class="filter-group" id="fg-rating">
            <div class="filter-group-header" onclick="toggleGroup('fg-rating')">
                <h4><i class="fas fa-star"></i> Customer Rating</h4>
                <div class="filter-toggle"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="filter-body">
                <label class="filter-item"><input type="radio" name="rating" value="4" onchange="applyFilters()">
                    <div class="custom-check" style="border-radius:50%;"></div><span class="filter-label"
                        style="color:#C9A84C;">★★★★☆ &nbsp;4+ Stars</span>
                </label>
                <label class="filter-item"><input type="radio" name="rating" value="3" onchange="applyFilters()">
                    <div class="custom-check" style="border-radius:50%;"></div><span class="filter-label"
                        style="color:#C9A84C;">★★★☆☆ &nbsp;3+ Stars</span>
                </label>
                <label class="filter-item"><input type="radio" name="rating" value="any" checked
                        onchange="applyFilters()">
                    <div class="custom-check" style="border-radius:50%;"></div><span class="filter-label">Any
                        Rating</span>
                </label>
            </div>
        </div>

        <div class="sidebar-apply">
            <button class="btn-apply-filter" onclick="applyFilters()">
                <i class="fas fa-check-circle"></i> Apply Filters
            </button>
        </div>
    </aside>

    <!-- ─── PRODUCTS AREA ─── -->
    <section class="products-area">

        <!-- Toolbar -->
        <div class="toolbar">
            <div class="toolbar-left">
                <!-- Mobile filter button -->
                <button class="btn-mobile-filter" onclick="openMobileFilter()">
                    <i class="fas fa-sliders-h"></i> Filters <span id="filterBadgeMob"
                        style="background:rgba(255,255,255,0.25);padding:1px 7px;border-radius:10px;font-size:0.65rem;"></span>
                </button>
                <div class="result-count">Showing <strong id="showingCount">12</strong> of <strong>48</strong>
                    products</div>
                <div class="active-filters" id="activeTags"></div>
            </div>
            <div class="toolbar-right">
                <select class="sort-select" onchange="sortProducts(this.value)">
                    <option value="featured">✦ Featured</option>
                    <option value="newest">Newest First</option>
                    <option value="price-asc">Price: Low to High</option>
                    <option value="price-desc">Price: High to Low</option>
                    <option value="rating">Top Rated</option>
                    <option value="name-asc">Name: A–Z</option>
                </select>
                <div class="view-toggle">
                    <button class="view-btn active" id="gridViewBtn" onclick="setView('grid')" title="Grid View"><i
                            class="fas fa-th"></i></button>
                    <button class="view-btn" id="listViewBtn" onclick="setView('list')" title="List View"><i
                            class="fas fa-list"></i></button>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="product-grid" id="productGrid">

            <!-- Card 1 -->
            <div class="product-card" data-cat="mandir" data-sub="flagship" data-size="36x24" data-finish="white"
                data-price="85000">
                <div class="product-img-wrap">
                    <img src="./img/hero.png" alt="Royal Tri-Shikhara Mandir" loading="lazy" />
                    <div class="product-badge">Bestseller</div>
                    <div class="product-actions">
                        <button class="action-btn" onclick="toggleWishlist(this)" title="Wishlist"><i
                                class="fas fa-heart"></i></button>
                        <a href="product-detail.html" class="action-btn" title="View Details"><i
                                class="fas fa-eye"></i></a>
                        <a href="https://wa.me/916292237207?text=I am interested in Royal Tri-Shikhara Mandir"
                            class="action-btn" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Home Mandirs · Flagship</div>
                    <h3 class="product-name">Royal Tri-Shikhara Mandir</h3>
                    <h3 class="product-name">Price: ₹ 1,50,000</h3>
                    <div class="product-meta">
                        <div class="product-size"><i class="fas fa-ruler-combined"></i> 36 × 24 in</div>

                        <!-- <a href="https://wa.me/916292237207?text=Enquiry: Royal Tri-Shikhara Mandir"
                                class="btn-enquire" target="_blank"><i class="fab fa-whatsapp"></i> Enquire</a> -->
                    </div>
                    <div class="product-meta" style="margin-top: 10px;">
                        <a href="product-detail.html" class="btn-add-list" style="width: 100%;">ADD TO LIST</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="product-card" data-cat="painted" data-sub="flagship" data-size="30x24" data-finish="gold"
                data-price="72000">
                <div class="product-img-wrap">
                    <img src="./img/hero.png" alt="Om Suraj Gold Mandir" loading="lazy" />
                    <div class="product-badge new">New Arrival</div>
                    <div class="product-actions">
                        <button class="action-btn" onclick="toggleWishlist(this)" title="Wishlist"><i
                                class="fas fa-heart"></i></button>
                        <a href="product-detail.html" class="action-btn" title="View Details"><i
                                class="fas fa-eye"></i></a>
                        <a href="https://wa.me/916292237207?text=I am interested in Om Suraj Gold Mandir"
                            class="action-btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Gold Painted Mandirs · Flagship</div>
                    <h3 class="product-name">Om Suraj Gold-Painted Mandir</h3>
                    <h3 class="product-name">Price: ₹ 1,50,000</h3>
                    <div class="product-meta">
                        <div class="product-size"><i class="fas fa-ruler-combined"></i> 30 × 24 in</div>
                        <!-- <a href="https://wa.me/916292237207?text=Enquiry: Om Suraj Gold Mandir" class="btn-enquire"
                                target="_blank"><i class="fab fa-whatsapp"></i> Enquire</a> -->
                    </div>
                    <div class="product-meta" style="margin-top: 10px;">
                        <a href="product-detail.html" class="btn-add-list" style="width: 100%;">ADD TO LIST</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="product-card" data-cat="mandir" data-sub="signature" data-size="42x24" data-finish="white"
                data-price="110000">
                <div class="product-img-wrap">
                    <img src="./img/hero.png" alt="Peacock Arched Open Mandir" loading="lazy" />
                    <div class="product-badge custom">Custom</div>
                    <div class="product-actions">
                        <button class="action-btn" onclick="toggleWishlist(this)" title="Wishlist"><i
                                class="fas fa-heart"></i></button>
                        <a href="product-detail.html" class="action-btn" title="View Details"><i
                                class="fas fa-eye"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Open Style Mandirs · Signature</div>
                    <h3 class="product-name">Peacock Arched Open Mandir</h3>
                    <h3 class="product-name">Price: ₹ 1,50,000</h3>
                    <div class="product-meta">
                        <div class="product-size"><i class="fas fa-ruler-combined"></i> 42 × 24 in</div>
                        <!-- <a href="https://wa.me/916292237207?text=Enquiry: Peacock Arched Mandir" class="btn-enquire"
                                target="_blank"><i class="fab fa-whatsapp"></i> Enquire</a> -->
                    </div>
                    <div class="product-meta" style="margin-top: 10px;">
                        <a href="product-detail.html" class="btn-add-list" style="width: 100%;">ADD TO LIST</a>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="product-card" data-cat="painted" data-sub="signature" data-size="30x24" data-finish="gold"
                data-price="65000">
                <div class="product-img-wrap">
                    <img src="./img/hero.png" alt="Om Surya Compact Mandir" loading="lazy" />
                    <div class="product-badge">Popular</div>
                    <div class="product-actions">
                        <button class="action-btn" onclick="toggleWishlist(this)" title="Wishlist"><i
                                class="fas fa-heart"></i></button>
                        <a href="product-detail.html" class="action-btn" title="View Details"><i
                                class="fas fa-eye"></i></a>
                        <a href="https://wa.me/916292237207?text=I am interested in Om Surya Compact Mandir"
                            class="action-btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Compact Mandirs · Signature</div>
                    <h3 class="product-name">Om Surya Compact Mandir</h3>
                    <h3 class="product-name">Price: ₹ 1,50,000</h3>
                    <div class="product-meta">
                        <div class="product-size"><i class="fas fa-ruler-combined"></i> 30 × 24 in</div>
                        <!-- <a href="https://wa.me/916292237207?text=Enquiry: Om Surya Compact Mandir"
                                class="btn-enquire" target="_blank"><i class="fab fa-whatsapp"></i> Enquire</a> -->
                    </div>
                    <div class="product-meta" style="margin-top: 10px;">
                        <a href="product-detail.html" class="btn-add-list" style="width: 100%;">ADD TO LIST</a>
                    </div>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="product-card" data-cat="mandir" data-sub="eco" data-size="24x24" data-finish="white"
                data-price="35000">
                <div class="product-img-wrap">
                    <img src="./img/hero.png" alt="Classic Single Shikhara Mandir" loading="lazy" />
                    <div class="product-badge" style="background:var(--deep-purple);">Eco Series</div>
                    <div class="product-actions">
                        <button class="action-btn" onclick="toggleWishlist(this)" title="Wishlist"><i
                                class="fas fa-heart"></i></button>
                        <a href="product-detail.html" class="action-btn" title="View Details"><i
                                class="fas fa-eye"></i></a>
                        <a href="https://wa.me/916292237207?text=I am interested in Classic Single Shikhara Mandir"
                            class="action-btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Home Mandirs · Eco Series</div>
                    <h3 class="product-name">Classic Single Shikhara Mandir</h3>
                    <h3 class="product-name">Price: ₹ 1,50,000</h3>
                    <div class="product-meta">
                        <div class="product-size"><i class="fas fa-ruler-combined"></i> 24 × 24 in</div>
                        <!-- <a href="https://wa.me/916292237207?text=Enquiry: Classic Single Shikhara Mandir"
                                class="btn-enquire" target="_blank"><i class="fab fa-whatsapp"></i> Enquire</a> -->
                    </div>
                    <div class="product-meta" style="margin-top: 10px;">
                        <a href="product-detail.html" class="btn-add-list" style="width: 100%;">ADD TO LIST</a>
                    </div>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="product-card" data-cat="idol" data-sub="signature" data-size="24x24" data-finish="white"
                data-price="18000">
                <div class="product-img-wrap">
                    <img src="./img/hero.png" alt="Ganesh Marble Idol" loading="lazy" />
                    <div class="product-badge">Idol</div>
                    <div class="product-actions">
                        <button class="action-btn" onclick="toggleWishlist(this)" title="Wishlist"><i
                                class="fas fa-heart"></i></button>
                        <a href="product-detail.html" class="action-btn" title="View Details"><i
                                class="fas fa-eye"></i></a>
                        <a href="https://wa.me/916292237207?text=I am interested in Ganesh Marble Idol"
                            class="action-btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Marble Idols · Signature</div>
                    <h3 class="product-name">Ganesh Marble Idol</h3>
                    <h3 class="product-name">Price: ₹ 1,50,000</h3>
                    <div class="product-meta">
                        <div class="product-size"><i class="fas fa-ruler-combined"></i> 12 × 8 in</div>
                        <!-- <a href="https://wa.me/916292237207?text=Enquiry: Ganesh Marble Idol" class="btn-enquire"
                                target="_blank"><i class="fab fa-whatsapp"></i> Enquire</a> -->
                    </div>
                    <div class="product-meta" style="margin-top: 10px;">
                        <a href="product-detail.html" class="btn-add-list" style="width: 100%;">ADD TO LIST</a>
                    </div>
                </div>
            </div>

            <!-- Card 7 -->
            <div class="product-card" data-cat="mandir" data-sub="flagship" data-size="48x24" data-finish="white"
                data-price="145000">
                <div class="product-img-wrap">
                    <img src="./img/hero.png" alt="Grand Panchashikhara Temple Mandir" loading="lazy" />
                    <div class="product-badge" style="background:#7B4F00;">Grand</div>
                    <div class="product-actions">
                        <button class="action-btn" onclick="toggleWishlist(this)" title="Wishlist"><i
                                class="fas fa-heart"></i></button>
                        <a href="product-detail.html" class="action-btn" title="View Details"><i
                                class="fas fa-eye"></i></a>
                        <a href="https://wa.me/916292237207?text=I am interested in Grand Panchashikhara Mandir"
                            class="action-btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Home Mandirs · Flagship</div>
                    <h3 class="product-name">Grand Panchashikhara Mandir</h3>
                    <h3 class="product-name">Price: ₹ 1,50,000</h3>
                    <div class="product-meta">
                        <div class="product-size"><i class="fas fa-ruler-combined"></i> 48 × 24 in</div>
                        <!-- <a href="https://wa.me/916292237207?text=Enquiry: Grand Panchashikhara Mandir"
                                class="btn-enquire" target="_blank"><i class="fab fa-whatsapp"></i> Enquire</a> -->
                    </div>
                    <div class="product-meta" style="margin-top: 10px;">
                        <a href="product-detail.html" class="btn-add-list" style="width: 100%;">ADD TO LIST</a>
                    </div>
                </div>
            </div>

            <!-- Card 8 -->
            <div class="product-card" data-cat="jaali" data-sub="signature" data-size="36x24" data-finish="white"
                data-price="28000">
                <div class="product-img-wrap">
                    <img src="./img/hero.png" alt="Lotus Jaali Panel" loading="lazy" />
                    <div class="product-badge" style="background:var(--indigo);">Panel</div>
                    <div class="product-actions">
                        <button class="action-btn" onclick="toggleWishlist(this)" title="Wishlist"><i
                                class="fas fa-heart"></i></button>
                        <a href="product-detail.html" class="action-btn" title="View Details"><i
                                class="fas fa-eye"></i></a>
                        <a href="https://wa.me/916292237207?text=I am interested in Lotus Jaali Panel"
                            class="action-btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Jaali Panels · Signature</div>
                    <h3 class="product-name">Lotus Jaali Decorative Panel</h3>
                    <h3 class="product-name">Price: ₹ 1,50,000</h3>
                    <div class="product-meta">
                        <div class="product-size"><i class="fas fa-ruler-combined"></i> 36 × 24 in</div>
                        <!-- <a href="https://wa.me/916292237207?text=Enquiry: Lotus Jaali Panel" class="btn-enquire"
                                target="_blank"><i class="fab fa-whatsapp"></i> Enquire</a> -->
                    </div>
                    <div class="product-meta" style="margin-top: 10px;">
                        <a href="product-detail.html" class="btn-add-list" style="width: 100%;">ADD TO LIST</a>
                    </div>
                </div>
            </div>

            <!-- Card 9 -->
            <div class="product-card" data-cat="idol" data-sub="eco" data-size="24x24" data-finish="white"
                data-price="12000">
                <div class="product-img-wrap">
                    <img src="./img/hero.png" alt="Lakshmi Marble Idol" loading="lazy" />
                    <div class="product-badge">Idol</div>
                    <div class="product-actions">
                        <button class="action-btn" onclick="toggleWishlist(this)" title="Wishlist"><i
                                class="fas fa-heart"></i></button>
                        <a href="product-detail.html" class="action-btn" title="View Details"><i
                                class="fas fa-eye"></i></a>
                        <a href="https://wa.me/916292237207?text=I am interested in Lakshmi Marble Idol"
                            class="action-btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Marble Idols · Eco Series</div>
                    <h3 class="product-name">Lakshmi Marble Idol</h3>
                    <h3 class="product-name">Price: ₹ 1,50,000</h3>
                    <div class="product-meta">
                        <div class="product-size"><i class="fas fa-ruler-combined"></i> 10 × 7 in</div>
                        <!-- <a href="https://wa.me/916292237207?text=Enquiry: Lakshmi Marble Idol" class="btn-enquire"
                                target="_blank"><i class="fab fa-whatsapp"></i> Enquire</a> -->
                    </div>
                    <div class="product-meta" style="margin-top: 10px;">
                        <a href="product-detail.html" class="btn-add-list" style="width: 100%;">ADD TO LIST</a>
                    </div>
                </div>
            </div>

            <!-- Card 10 -->
            <div class="product-card" data-cat="painted" data-sub="eco" data-size="24x24" data-finish="multi"
                data-price="42000">
                <div class="product-img-wrap">
                    <img src="./img/hero.png" alt="Multicolour Painted Mandir" loading="lazy" />
                    <div class="product-badge painted">Painted</div>
                    <div class="product-actions">
                        <button class="action-btn" onclick="toggleWishlist(this)" title="Wishlist"><i
                                class="fas fa-heart"></i></button>
                        <a href="product-detail.html" class="action-btn" title="View Details"><i
                                class="fas fa-eye"></i></a>
                        <a href="https://wa.me/916292237207?text=I am interested in Multicolour Painted Mandir"
                            class="action-btn" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Gold Painted Mandirs · Eco</div>
                    <h3 class="product-name">Multicolour Painted Compact Mandir</h3>
                    <h3 class="product-name">Price: ₹ 1,50,000</h3>
                    <div class="product-meta">
                        <div class="product-size"><i class="fas fa-ruler-combined"></i> 24 × 24 in</div>
                        <!-- <a href="https://wa.me/916292237207?text=Enquiry: Multicolour Painted Mandir"
                                class="btn-enquire" target="_blank"><i class="fab fa-whatsapp"></i> Enquire</a> -->
                    </div>
                    <div class="product-meta" style="margin-top: 10px;">
                        <a href="product-detail.html" class="btn-add-list" style="width: 100%;">ADD TO LIST</a>
                    </div>
                </div>
            </div>

        </div><!-- /product-grid -->

        <!-- Pagination -->
        <div class="pagination">
            <a href="#" class="page-btn prev"><i class="fas fa-chevron-left"></i> Prev</a>
            <a href="#" class="page-btn active">1</a>
            <a href="#" class="page-btn">2</a>
            <span class="page-dots">···</span>
            <a href="#" class="page-btn">8</a>
            <a href="#" class="page-btn next">Next <i class="fas fa-chevron-right"></i></a>
        </div>

    </section>
</div><!-- /shop-wrapper -->


<script src="{{ asset('./js/product.js') }}"></script>
@endsection