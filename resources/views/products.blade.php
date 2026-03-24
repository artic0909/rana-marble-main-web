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

        .page-btn.disabled {
            opacity: 0.4;
            pointer-events: none;
            cursor: default;
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
        @foreach($heroBanners as $banner)
        <div class="hero-slide" style="flex: 0 0 100%; height: 100%; scroll-snap-align: start; position: relative;">
            <img src="{{ Storage::url($banner->image) }}" alt="{{ $banner->title }}"
                style="width: 100%; height: 100%; object-fit: cover;" />
        </div>
        @endforeach
    </div>
    <div class="hero-mandala" style="pointer-events: none;"></div>
    <div class="hero-glow" style="pointer-events: none;"></div>
    <div class="hero-particles" style="pointer-events: none;"></div>
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
        <button class="btn-apply-filter" onclick="applyMobileFilters();">
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
                <label class="filter-item">
                    <input type="checkbox" name="cat" value="all" checked onchange="applyFilters()">
                    <div class="custom-check"></div>
                    <span class="filter-label">All Products</span>
                    <span class="filter-count">{{ $products->total() }}</span>
                </label>
                @foreach($categories as $cat)
                <label class="filter-item">
                    <input type="checkbox" name="cat" value="{{ $cat->slug }}" onchange="applyFilters()">
                    <div class="custom-check"></div>
                    <span class="filter-label">{{ $cat->name }}</span>
                    <span class="filter-count">{{ $cat->products()->where('status', 'active')->count() }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Sizes -->
        <div class="filter-group" id="fg-size">
            <div class="filter-group-header" onclick="toggleGroup('fg-size')">
                <h4><i class="fas fa-ruler-combined"></i> Sizes</h4>
                <div class="filter-toggle"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="filter-body">
                @php $sizes = \App\Models\Size::orderBy('name')->get(); @endphp
                @foreach($sizes->take(4) as $size)
                <label class="filter-item">
                    <input type="checkbox" name="size" value="{{ $size->slug }}" onchange="applyFilters()">
                    <div class="custom-check"></div>
                    <span class="filter-label">{{ $size->name }}</span>
                </label>
                @endforeach

                @if($sizes->count() > 4)
                <div id="moresSizes" style="display:none;">
                    @foreach($sizes->skip(4) as $size)
                    <label class="filter-item">
                        <input type="checkbox" name="size" value="{{ $size->slug }}" onchange="applyFilters()">
                        <div class="custom-check"></div>
                        <span class="filter-label">{{ $size->name }}</span>
                    </label>
                    @endforeach
                </div>
                <button class="view-more-btn" id="sizeMoreBtn" onclick="toggleMoreSizes()">
                    <i class="fas fa-plus-circle"></i> View More ({{ $sizes->count() - 4 }})
                </button>
                @endif
            </div>
        </div>

        <!-- Finish / Color -->
        <div class="filter-group" id="fg-finish">
            <div class="filter-group-header" onclick="toggleGroup('fg-finish')">
                <h4><i class="fas fa-palette"></i> Finish & Colour</h4>
                <div class="filter-toggle"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div class="swatch-grid">
                @foreach($colors as $color)
                <div class="swatch-item" onclick="toggleSwatch(this)" title="{{ strtolower($color->name) }}">
                    <div class="swatch" style="background: {{ $color->hex ?? '#ccc' }}; border: 1.5px solid rgba(0,0,0,0.1);"></div>
                    <span class="swatch-label">{{ $color->name }}</span>
                </div>
                @endforeach
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
                        <input type="number" id="priceMin"
                            value="{{ $priceMin }}"
                            min="{{ $priceMin }}"
                            max="{{ $priceMax }}"
                            placeholder="Min"
                            onchange="updateRange()" />
                    </div>
                    <span class="price-dash">–</span>
                    <div class="price-input-group">
                        <span>₹</span>
                        <input type="number" id="priceMax"
                            value="{{ $priceMax }}"
                            min="{{ $priceMin }}"
                            max="{{ $priceMax }}"
                            placeholder="Max"
                            onchange="updateRange()" />
                    </div>
                </div>
                <div class="range-slider-wrap">
                    <div class="range-track"></div>
                    <div class="range-fill" id="rangeFill"></div>
                    <input type="range" class="dual-range" id="rangeMin"
                        min="{{ $priceMin }}"
                        max="{{ $priceMax }}"
                        value="{{ $priceMin }}"
                        step="100"
                        oninput="syncRange('min')" />
                    <input type="range" class="dual-range" id="rangeMax"
                        min="{{ $priceMin }}"
                        max="{{ $priceMax }}"
                        value="{{ $priceMax }}"
                        step="100"
                        oninput="syncRange('max')" />
                </div>
                <div class="range-labels">
                    <span>₹{{ number_format($priceMin) }}</span>
                    <span>₹{{ number_format($priceMax) }}+</span>
                </div>
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
                <button class="btn-mobile-filter" onclick="openMobileFilter()">
                    <i class="fas fa-sliders-h"></i> Filters
                    <span id="filterBadgeMob"
                        style="background:rgba(255,255,255,0.25);padding:1px 7px;border-radius:10px;font-size:0.65rem;"></span>
                </button>
                <div class="result-count">
                    Showing <strong id="showingCount">{{ $products->count() }}</strong>
                    of <strong id="totalCount">{{ $products->total() }}</strong> products
                </div>
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
                    <button class="view-btn active" id="gridViewBtn" onclick="setView('grid')" title="Grid View">
                        <i class="fas fa-th"></i>
                    </button>
                    <button class="view-btn" id="listViewBtn" onclick="setView('list')" title="List View">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="product-grid" id="productGrid">

            @foreach($products as $product)
            <div class="product-card"
                data-cat="{{ $product->category->slug ?? 'all' }}"
                data-sub="{{ $product->category->slug ?? '' }}"
                data-size="{{ $product->variants->map(fn($v) => $v->size->slug ?? '')->filter()->unique()->implode(' ') }}"
                data-finish="{{ $product->variants->map(fn($v) => $v->color ? strtolower($v->color->name) : '')->filter()->unique()->implode(' ') ?: 'white' }}"
                data-price="{{ $product->variants->isNotEmpty() ? (int)$product->variants->min('price') : 0 }}">

                <div class="product-img-wrap">
                    <img src="{{ $product->main_image ? Storage::url($product->main_image) : '' }}"
                        alt="{{ $product->name }}" loading="lazy" />
                    <div class="product-badge">{{ $product->category->name }}</div>
                    <div class="product-actions">
                        @guest
                        <a href="{{route('login')}}" class="action-btn"  title="Wishlist">
                            <i class="fas fa-heart"></i>
                        </a>
                        @endguest
                                                @auth
                        <button class="action-btn"
    onclick="toggleWishlist(this, {{ $product->id }})"
    title="Wishlist"
    style="{{ Auth::guard('customer')->check() && $product->wishlists->where('customer_id', Auth::guard('customer')->id())->count() ? 'color:var(--saffron);' : '' }}">
    <i class="fas fa-heart"></i>
</button>
@endauth
                        <a href="{{ route('product.detail', $product->slug) }}" class="action-btn" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        @php
                        $phone = \App\Models\Setting::get('store_phone');
                        $message = urlencode(
                        'Hi! I am interested in ' . $product->name .
                        "\n\n🔗 " . route('product.detail', $product->slug)
                        );
                        @endphp
                        <a href="https://wa.me/{{ $phone }}?text={{ $message }}"
                            class="action-btn" target="_blank" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div class="product-info">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    @if($product->variants->count())
                    @php
                    $minPrice = $product->variants->min('price');
                    $maxPrice = $product->variants->max('price');
                    @endphp
                    <p class="product-price">
                        ₹{{ number_format($minPrice, 2) }}
                        @if($minPrice != $maxPrice)
                        — ₹{{ number_format($maxPrice, 2) }}
                        @endif
                    </p>
                    @endif
                    <div class="product-meta" style="margin-top: 10px;">
                        <a href="{{ route('product.detail', $product->slug) }}"
                            class="btn-add-list" style="width: 100%;">ADD TO LIST</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div><!-- /product-grid -->

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="pagination">
            {{-- Prev --}}
            @if($products->onFirstPage())
            <span class="page-btn prev disabled"><i class="fas fa-chevron-left"></i> Prev</span>
            @else
            <a href="{{ $products->previousPageUrl() }}" class="page-btn prev">
                <i class="fas fa-chevron-left"></i> Prev
            </a>
            @endif

            {{-- Page numbers --}}
            @php
            $current = $products->currentPage();
            $last = $products->lastPage();
            @endphp

            @for($page = 1; $page <= $last; $page++)
                @if($page==$current)
                <span class="page-btn active">{{ $page }}</span>
                @elseif($page == 1 || $page == $last || abs($page - $current) <= 1)
                    <a href="{{ $products->url($page) }}" class="page-btn">{{ $page }}</a>
                    @elseif($page == $current - 2 || $page == $current + 2)
                    <span class="page-dots">···</span>
                    @endif
                    @endfor

                    {{-- Next --}}
                    @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="page-btn next">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                    @else
                    <span class="page-btn next disabled">Next <i class="fas fa-chevron-right"></i></span>
                    @endif
        </div>
        @endif

    </section>
</div><!-- /shop-wrapper -->

<script src="{{ asset('./js/product.js') }}"></script>
@endsection