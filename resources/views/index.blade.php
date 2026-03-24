@extends('frontend.layout.app')

@section('title', 'Rana Marble – Divine Marble Mandirs & Temple Crafts')

@section('content')

<!-- ═══════════════════════════════════ HERO ═══════════════════════════════════ -->
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
        @foreach($heroBanners as $banner)
        <div class="hero-slide" style="flex: 0 0 100%; height: 100%; scroll-snap-align: start; position: relative;">
            <img src="{{ Storage::url($banner->image) }}"
                alt="{{ $banner->title }}"
                style="width: 100%; height: 100%; object-fit: cover;" />
        </div>
        @endforeach
    </div>

    <!-- <div class="hero-mandala" style="pointer-events: none;"></div>
        <div class="hero-glow" style="pointer-events: none;"></div>
        <div class="hero-particles" style="pointer-events: none;"></div>

        <div class="hero-content"
            style="position: relative; z-index: 10; pointer-events: none; margin: 0 auto; text-align: center; justify-content: center; width: 100%; display: flex; flex-direction: column;">
            <div class="hero-text" style="pointer-events: auto; padding: 20px;">
                <div class="hero-tag">
                    <i class="fas fa-star-of-life fa-spin" style="animation-duration:4s;"></i>
                    Est. Since 2005 &nbsp;·&nbsp; Rajasthan Artisans
                </div>
                <h1 class="hero-title">
                    Sacred <span class="accent">Marble Mandirs</span><br />Crafted with Devotion
                </h1>
                <p class="hero-sub" style="margin-left: auto; margin-right: auto; max-width: 600px;">
                    Every chisel stroke is a prayer. Bringing the divine grace of Makrana white marble
                    into your home — mandirs, idols, and spiritual décor handcrafted by master artisans.
                </p>
                <div class="hero-ctas" style="justify-content: center; display: flex; gap: 14px;">
                    <a href="products.html" class="btn-primary" style="pointer-events: auto;">
                        <i class="fas fa-th-large"></i> Explore Collection
                    </a>
                </div>
            </div>
        </div> -->
</section>

<!-- Trust Strip -->
<div class="trust-strip">
    <div class="marquee-track">
        <!-- Duplicated for seamless loop -->
        <span class="marquee-item"><i class="fas fa-gem"></i> Pure Makrana White Marble</span>
        <span class="marquee-item"><i class="fas fa-hammer"></i> Master Artisan Carved</span>
        <span class="marquee-item"><i class="fas fa-truck"></i> Pan-India Delivery</span>
        <span class="marquee-item"><i class="fas fa-ruler-combined"></i> Custom Sizes Available</span>
        <span class="marquee-item"><i class="fas fa-shield-alt"></i> Quality Guaranteed</span>
        <span class="marquee-item"><i class="fas fa-paint-brush"></i> Gold & Color Painting</span>
        <span class="marquee-item"><i class="fas fa-gem"></i> Pure Makrana White Marble</span>
        <span class="marquee-item"><i class="fas fa-hammer"></i> Master Artisan Carved</span>
        <span class="marquee-item"><i class="fas fa-truck"></i> Pan-India Delivery</span>
        <span class="marquee-item"><i class="fas fa-ruler-combined"></i> Custom Sizes Available</span>
        <span class="marquee-item"><i class="fas fa-shield-alt"></i> Quality Guaranteed</span>
        <span class="marquee-item"><i class="fas fa-paint-brush"></i> Gold & Color Painting</span>
    </div>
</div>

<!-- ═══════════════════════════════════ FEATURED PRODUCTS ═══════════════════════════════════ -->
<section class="section products-section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><i class="fas fa-star"></i> &nbsp; Featured</span>
            <h2 class="section-title">Our Finest Creations</h2>
            <p class="section-sub">Handpicked masterpieces from our atelier, carved from the finest Makrana marble.
            </p>
            <div class="gold-line"></div>
        </div>

        <div class="product-grid">

            @foreach($featuredProducts as $product)
            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="{{ $product->main_image ? Storage::url($product->main_image) : '' }}" alt="{{ $product->name }}" loading="lazy" />
                    <div class="product-badge">Bestseller</div>
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
                        @guest
                        <a href="{{ route('product.detail', $product->slug) }}" class="action-btn" title="Quick View">
                            <i class="fas fa-eye"></i>
                        </a>
                        @endguest
                        @auth
                        <a href="{{ route('customer.product.detail', $product->slug) }}" class="action-btn" title="Quick View">
                            <i class="fas fa-eye"></i>
                        </a>
                        @endauth
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
                    <!-- <div class="product-cat">Home Mandirs</div> -->
                    <h3 class="product-name">{{ $product->name }}</h3>
                    @if($product->variants->count())
                    @php
                    $min = $product->variants->min('price');
                    $max = $product->variants->max('price');
                    @endphp
                    <div class="product-price"
                        style="font-size: 0.85rem; font-weight: 600; color: var(--maroon); margin-bottom: 12px; font-family: \'Cinzel\', serif;">
                        Price: ₹{{ number_format($min, 2) }}
                        @if($min != $max) — ₹{{ number_format($max, 2) }} @endif
                    </div>
                    @endif
                    <div class="product-meta" style="margin-top: 10px;">
                        @guest
                        <a href="{{ route('product.detail', $product->slug) }}" class="btn-add-list" style="width: 100%;">ADD TO CART</a>
                        @endguest
                        @auth
                        <a href="{{ route('customer.product.detail', $product->slug) }}" class="btn-add-list" style="width: 100%;">ADD TO CART</a>
                        @endauth
                    </div>

                </div>
            </div>
            @endforeach

        </div>



        <div style="text-align:center; margin-top: 48px;">
            @guest
            <a href="{{ route('product.all') }}" class="btn-primary" style="display:inline-flex;">
                <i class="fas fa-th-large"></i> View All Products
            </a>
            @endguest
            @auth
            <a href="{{ route('customer.product.all') }}" class="btn-primary" style="display:inline-flex;">
                <i class="fas fa-th-large"></i> View All Products
            </a>
            @endauth
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════ CATEGORIES ═══════════════════════════════════ -->
<section class="section categories-bg">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><i class="fas fa-om"></i> &nbsp; Browse by Category</span>
            <h2 class="section-title">Our Sacred Collections</h2>
            <p class="section-sub">Every piece tells a story of faith, crafted to honour the divine presence in your
                home.</p>
            <div class="gold-line"></div>
        </div>

        <div class="cat-grid">
            <a href="mandirs.html" class="cat-card">
                <div class="cat-icon-wrap">
                    <div class="cat-icon"><i class="fas fa-place-of-worship"></i></div>
                    <div class="cat-name">Home Mandirs<span class="cat-count">30+ Designs</span></div>
                </div>
            </a>
            <a href="idols.html" class="cat-card">
                <div class="cat-icon-wrap">
                    <div class="cat-icon"><i class="fas fa-hands-praying"></i></div>
                    <div class="cat-name">Marble Idols<span class="cat-count">50+ Idols</span></div>
                </div>
            </a>
            <a href="pillars.html" class="cat-card">
                <div class="cat-icon-wrap">
                    <div class="cat-icon"><i class="fas fa-columns"></i></div>
                    <div class="cat-name">Pillars & Columns<span class="cat-count">15+ Styles</span></div>
                </div>
            </a>
            <a href="wall-panels.html" class="cat-card">
                <div class="cat-icon-wrap">
                    <div class="cat-icon"><i class="fas fa-border-all"></i></div>
                    <div class="cat-name">Jaali Panels<span class="cat-count">20+ Patterns</span></div>
                </div>
            </a>
            <a href="fountains.html" class="cat-card">
                <div class="cat-icon-wrap">
                    <div class="cat-icon"><i class="fas fa-water"></i></div>
                    <div class="cat-name">Marble Fountains<span class="cat-count">10+ Designs</span></div>
                </div>
            </a>
            <a href="custom.html" class="cat-card">
                <div class="cat-icon-wrap">
                    <div class="cat-icon"><i class="fas fa-pencil-ruler"></i></div>
                    <div class="cat-name">Custom Orders<span class="cat-count">Any Design</span></div>
                </div>
            </a>
        </div>
    </div>
</section>



<!-- Ornament Divider -->
<div class="ornament-divider"><i class="fas fa-om"></i></div>

<!-- ═══════════════════════════════════ WHY US ═══════════════════════════════════ -->
<section class="section why-section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><i class="fas fa-award"></i> &nbsp; Why Rana Marble</span>
            <h2 class="section-title">Crafted with Sacred Intent</h2>
            <p class="section-sub">Every piece we make carries the blessings of skilled artisans who have dedicated
                their lives to this craft.</p>
            <div class="gold-line"></div>
        </div>

        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-gem"></i></div>
                <h3 class="why-title">Pure Makrana Marble</h3>
                <p class="why-desc">We source only the finest Grade-A white Makrana marble — the same stone used in
                    the Taj Mahal — for unmatched luminosity and durability.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-hands"></i></div>
                <h3 class="why-title">Master Artisan Carved</h3>
                <p class="why-desc">Each mandir is hand-carved by craftsmen with 20+ years of experience, carrying
                    forward a centuries-old tradition of Rajasthani stone art.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-pencil-ruler"></i></div>
                <h3 class="why-title">Custom Made for You</h3>
                <p class="why-desc">Share your space dimensions and deity preference — we design and carve a mandir
                    that fits your home perfectly, in any size or style.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-truck"></i></div>
                <h3 class="why-title">Safe Pan-India Delivery</h3>
                <p class="why-desc">Carefully packed in custom crates and delivered with professional handling
                    across India. Assembly guidance provided.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-paint-brush"></i></div>
                <h3 class="why-title">Gold & Colour Painting</h3>
                <p class="why-desc">Optional premium 22K gold leaf detailing, traditional colour painting, or
                    natural polished finish — the choice is yours.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-headset"></i></div>
                <h3 class="why-title">Dedicated Support</h3>
                <p class="why-desc">From design consultation to post-delivery, our team is available on WhatsApp to
                    assist you every step of the way.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════ TESTIMONIALS ═══════════════════════════════════ -->
<section class="section testi-section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><i class="fas fa-quote-left"></i> &nbsp; Devotee Stories</span>
            <h2 class="section-title">Words from Our Sacred Family</h2>
            <p class="section-sub">Thousands of homes across India now carry a piece of our devotion.</p>
            <div class="gold-line"></div>
        </div>

        <div class="testi-carousel" id="testiCarousel">
           @foreach($reviews as $review)
<div class="testi-card">

    {{-- Stars --}}
    <div class="testi-stars">
        @for ($i = 1; $i <= 5; $i++)
            {{ $i <= $review->rating ? '★' : '☆' }}
        @endfor
    </div>

    {{-- Review text --}}
    <p class="testi-text">"{{ $review->review }}"</p>

    {{-- Author --}}
    <div class="testi-author">
        <div class="testi-avatar">{{ strtoupper(substr($review->name, 0, 1)) }}</div>
        <div>
            <div class="testi-name">{{ $review->name }}</div>
            @if ($review->city || $review->state)
            <div class="testi-loc">
                <i class="fas fa-map-marker-alt" style="color:var(--saffron);font-size:0.7rem;"></i>
                {{ implode(', ', array_filter([$review->city, $review->state])) }}
            </div>
            @endif
        </div>
    </div>

</div>
@endforeach
        </div>
    </div>
</section>

@endsection