@extends('frontend.layout.app')

@section('title', $product->meta_title ?: $product->name . ' — Rana Marble')
@section('meta_description', $product->meta_description ?: \App\Models\Setting::get('meta_description'))
@section('meta_keywords', $product->meta_keywords ?: \App\Models\Setting::get('meta_keywords'))
@section('og_image', $product->og_image ?: ($product->main_image ? Storage::url($product->main_image) : \App\Models\Setting::get('og_image')))

@section('title', 'Product — ' . $product->name)

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('./css/product-details.css') }}">
</head>

<!-- ══ BREADCRUMB ══ -->
<!-- <div class="breadcrumb-bar">
    <div class="inner">
        <a href="index.html">Home</a>
        <i class="fas fa-chevron-right"></i>
        <a href="products.html">All Products</a>
        <i class="fas fa-chevron-right"></i>
        <a href="mandirs.html">Home Mandirs</a>
        <i class="fas fa-chevron-right"></i>
        <span>Royal Tri-Shikhara Mandir</span>
    </div>
</div> -->

<!-- ══════════════ PRODUCT DETAIL ══════════════ -->
<section class="product-detail">
    <div class="detail-grid">

        <!-- ─── GALLERY COLUMN ─── -->
        <div class="gallery-col">
            <div class="main-image-wrap" id="mainImgWrap" onclick="openLightbox(currentImg)">
                <div class="gallery-badge">
                    <span class="g-badge bestseller">✦ {{ $product->category->name }}</span>
                </div>
                @guest
                <a href="{{route('login')}}" class="wish-main" id="wishMainBtn"
                    title="Add to Wishlist" style="text-decoration: none;">
                    <i class="fas fa-heart"></i>
                </a>
                @endguest
                @auth
                <button class="wish-main" id="wishMainBtn"
                    onclick="event.stopPropagation(); toggleWishlist(this, {{ $product->id }})"
                    title="Add to Wishlist"
                    style="{{ $product->wishlists->where('customer_id', Auth::guard('customer')->id())->count() ? 'color:var(--saffron);' : '' }}">
                    <i class="fas fa-heart"></i>
                </button>
                @endauth

                <!-- Main Image -->
                <img id="mainImg"
                    src="{{ $product->main_image ? Storage::url($product->main_image) : '' }}"
                    alt="{{ $product->name }}"
                    style="transition: opacity 0.18s ease;" />

                <!-- Main Video (hidden by default) -->
                <video id="mainVideo" controls
                    style="display:none; width:100%; height:100%; object-fit:cover;">
                    <source src="" type="video/mp4" id="mainVideoSource">
                    Your browser does not support the video tag.
                </video>

                <div class="zoom-hint" id="zoomHint">
                    <i class="fas fa-search-plus"></i> Click to Zoom
                </div>
            </div>

            <!-- Thumbnails -->
            <div class="thumbnails">

                {{-- Main product image as first thumb --}}
                @if($product->main_image)
                <div class="thumb active"
                    onclick="switchMedia(this, 'image', '{{ Storage::url($product->main_image) }}')">
                    <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->name }}" />
                </div>
                @endif

                {{-- Gallery images & videos --}}
                @foreach($product->images as $media)
                @if($media->type === 'video')
                <div class="thumb video-thumb"
                    onclick="switchMedia(this, 'video', '{{ Storage::url($media->image) }}')">
                    {{-- Use a video element with preload to grab first frame as poster --}}
                    <video
                        src="{{ Storage::url($media->image) }}"
                        style="width:100%;height:100%;object-fit:cover;filter:brightness(0.6);pointer-events:none;"
                        preload="metadata"
                        muted
                        playsinline>
                    </video>
                    <div class="play-icon-overlay"><i class="fas fa-play"></i></div>
                </div>
                @else
                <div class="thumb"
                    onclick="switchMedia(this, 'image', '{{ Storage::url($media->image) }}')">
                    <img src="{{ Storage::url($media->image) }}" alt="{{ $product->name }}" />
                </div>
                @endif
                @endforeach

            </div>
        </div>

        {{-- Pass first media src to JS --}}
        <script>
            // Set initial currentImg to main product image
            currentImg = "{{ $product->main_image ? Storage::url($product->main_image) : '' }}";
            currentMediaType = "image";
        </script>

        <!-- ─── INFO COLUMN ─── -->
        <div class="info-col">
            <div class="product-tag-row">
                <span class="ptag cat"><i class="fas fa-place-of-worship"></i> &nbsp;{{ $product->category->name }}</span>
                <span class="ptag instock"><i class="fas fa-circle" style="font-size:0.5rem;"></i> &nbsp;Available
                    to Order</span>
            </div>

            <h1 class="product-title">{{ $product->name }}</h1>
            <!-- {{-- Price — shows first variant price by default --}} -->
            @php
            $variantsJson = $product->variants->map(fn($v) => [
            'id' => $v->id,
            'size_id' => $v->size_id,
            'color_id' => $v->color_id,
            'price' => $v->price,
            'size' => $v->size?->name,
            'color' => $v->color?->name,
            'hex' => $v->color?->hex ?? '#ccc',
            ])->values();

            $firstVariant = $product->variants->first();
            $uniqueSizes = $product->variants->whereNotNull('size_id')->unique('size_id')->values();
            @endphp
            <!-- {{-- Price --}} -->
            <h1 class="product-title">
                Price: <span class="price" id="variantPrice">
                    ₹ {{ number_format($firstVariant?->price ?? 0, 2) }}
                </span>
            </h1>

            <div class="rating-row">
                <div class="stars">★★★★★</div>
                <span class="divider-dot">·</span>
                <span class="review-count"><a href="#tab-reviews">{{ $reviewCount }} Reviews</a></span>
                <span class="divider-dot">·</span>
                <span class="review-count">SKU: <strong>{{ $product->sku }}</strong></span>
            </div>


            <!-- {{-- Size Selector --}} -->
            @if($uniqueSizes->count())
            <div class="variant-section">
                <div class="variant-label">
                    <i class="fas fa-ruler-combined" style="color:var(--saffron);"></i>
                    Select Size <span id="selectedSize">({{ $firstVariant?->size?->name ?? '' }})</span>
                </div>
                <div class="size-options">
                    @foreach($uniqueSizes as $i => $variant)
                    <div class="size-opt {{ $i === 0 ? 'active' : '' }}"
                        data-size-id="{{ $variant->size_id }}"
                        onclick="selectSize(this, '{{ $variant->size?->name }}')">
                        {{ $variant->size?->name }}
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- {{-- Color / Finish Selector --}} -->
            <div class="variant-section" id="colorSection">
                <div class="variant-label">
                    <i class="fas fa-palette" style="color:var(--saffron);"></i>
                    Finish <span id="selectedFinish">({{ $firstVariant?->color?->name ?? '' }})</span>
                </div>
                <div class="finish-options" id="finishOptions">
                    {{-- Populated by JS --}}
                </div>
            </div>

            <!-- Pincode Input -->
            {{-- Pass pincodes to JS --}}
            @php
            $pincodesJson = $pincodes->map(fn($p) => [
            'name' => (string) $p->name,
            'fees' => (float) $p->fees,
            ])->values();
            @endphp
            <script>
                window.PINCODES = {!!json_encode($pincodesJson)!!};
            </script>
            <div class="variant-section">
                <div class="variant-label">
                    <i class="fas fa-map-marker-alt" style="color:var(--saffron);"></i> Delivery Pincode
                </div>
                <div class="pincode-row">
                    <input type="text" id="pincodeInput"
                        placeholder="Enter 6-digit Pincode"
                        maxlength="6"
                        inputmode="numeric"
                        oninput="validatePincode()" />
                    <button class="btn-email-cta" onclick="checkDelivery()">
                        <i class="fas fa-truck"></i> Check
                    </button>
                </div>
                <div id="deliveryResult" style="margin-top:10px;font-size:0.85rem;"></div>
            </div>

            <p class="product-short-desc">
                {{ $product->description }}
            </p>

            <!-- CTA Buttons -->
            <form class="cta-row" id="addToCartForm" action="{{ route('customer.cart.add') }}" method="POST">
                 @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="variant_id" id="selectedVariantId" value="">
    <input type="hidden" name="quantity" value="1">
             <button type="button" class="btn-email-cta btn-add-cart" onclick="addToCart()">
       Add to Cart
        </button>

        <a href="mailto:ruidas82ramesh@gmail.com?subject=Enquiry: {{ $product->name }} (SKU: {{ $product->sku }}) &body=Namaste! I am interested in {{ $product->name }} (SKU: {{ $product->sku }}) url: {{ url()->current() }}. Please provide more details about the product, pricing, and delivery options. Thank you! "
            class="btn-email-cta btn-buy-now">
            <i class="fas fa-envelope mobile-hide-icon"></i> Buy Now
        </a>

        <a href="https://wa.me/917364957139?text=Namaste! I am interested in {{ $product->name }} (SKU: {{ $product->sku }}). Please provide more details about the product, pricing, and delivery options. url: {{ url()->current() }}. Thank you!"
            class="btn-wa-cta btn-enquiry" target="_blank">
            <i class="fab fa-whatsapp fa-lg mobile-hide-icon"></i> Enquiry
        </a>
            </form>


            <!-- Enquiry Note -->
            <div class="enquiry-note">
                <i class="fas fa-info-circle"></i>
                <p><strong>How to Order:</strong> This is a handcrafted product made to order. Click <em>Enquire on
                        WhatsApp</em> or <em>Email Enquiry</em> above — share your size, finish preference, and
                    delivery address. Our team will respond with pricing and estimated delivery within 24 hours.</p>
            </div>

            <!-- Key Highlights -->
            <!-- <div class="highlights">
                <div class="highlights-title"><i class="fas fa-gem"></i> Key Highlights</div>
                <div class="highlights-grid">
                    <div class="highlight-item"><i class="fas fa-check-circle"></i><span>100% Pure Makrana White
                            Marble</span></div>
                    <div class="highlight-item"><i class="fas fa-check-circle"></i><span>Hand Carved by Master
                            Artisans</span></div>
                    <div class="highlight-item"><i class="fas fa-check-circle"></i><span>Three Ornate Shikhara
                            Spires</span></div>
                    <div class="highlight-item"><i class="fas fa-check-circle"></i><span>Peacock & Floral Motif
                            Carvings</span></div>
                    <div class="highlight-item"><i class="fas fa-check-circle"></i><span>Storage Cabinet Below
                            Sanctum</span></div>
                    <div class="highlight-item"><i class="fas fa-check-circle"></i><span>Custom Sizes
                            Available</span></div>
                    <div class="highlight-item"><i class="fas fa-check-circle"></i><span>Gold Painting Option
                            Available</span></div>
                    <div class="highlight-item"><i class="fas fa-check-circle"></i><span>Pan-India Delivery with
                            Assembly</span></div>
                </div>
            </div> -->

           {{-- ─── WRITE A REVIEW ─── --}}
<div class="write-review-section">
    <h3 class="write-review-title"><i class="fas fa-star"></i> Share Your Experience</h3>

    {{-- Single unified form — works for both guest & auth --}}
    <form class="write-review-form"
          action="{{ route('reviews.store', $product->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="review-form-top">
            <div class="star-picker" id="starPicker">
                <span>Your Rating:</span>
                <div class="stars-input">
                    <i class="far fa-star" onclick="setRating(1)" data-val="1"></i>
                    <i class="far fa-star" onclick="setRating(2)" data-val="2"></i>
                    <i class="far fa-star" onclick="setRating(3)" data-val="3"></i>
                    <i class="far fa-star" onclick="setRating(4)" data-val="4"></i>
                    <i class="far fa-star" onclick="setRating(5)" data-val="5"></i>
                </div>
                <input type="hidden" name="rating" id="selectedRating" value="{{ old('rating', 0) }}" />
                @error('rating')
                    <span class="r-error" style="color:red;font-size:0.8rem;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="review-form-fields">
            <div class="rf-row">
                <div class="rf-col">
                    <label>Your Name</label>
                    <input type="text"
                           name="name"
                           placeholder="e.g. Ramesh Gupta"
                           required
                           value="{{ old('name', Auth::guard('customer')->user()->name ?? '') }}" />
                    @error('name')
                        <span class="r-error" style="color:red;font-size:0.8rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="rf-col">
                    <label>State</label>
                    <input type="text"
                           name="state"
                           placeholder="e.g. Rajasthan"
                           value="{{ old('state', Auth::guard('customer')->user()->state ?? '') }}" />
                    @error('state')
                        <span class="r-error" style="color:red;font-size:0.8rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="rf-col">
                    <label>City</label>
                    <input type="text"
                           name="city"
                           placeholder="e.g. Jaipur"
                           value="{{ old('city', Auth::guard('customer')->user()->city ?? '') }}" />
                    @error('city')
                        <span class="r-error" style="color:red;font-size:0.8rem;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="rf-col full">
                <label>Your Review</label>
                <textarea name="review"
                          rows="4"
                          placeholder="Share your experience with this product…"
                          required>{{ old('review') }}</textarea>
                @error('review')
                    <span class="r-error" style="color:red;font-size:0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group review-media-upload" style="grid-column: 1 / -1; margin-top: 10px;">
                <label for="reviewMedia" class="r-upload-btn"
                    style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px;
                           background: rgba(201, 168, 76, 0.1); border: 1px dashed var(--gold);
                           border-radius: 4px; cursor: pointer; color: var(--text-mid);
                           font-size: 0.9rem; transition: background 0.2s;">
                    <i class="fas fa-camera"></i> Add Photos / Video
                </label>
                <input type="file"
                       id="reviewMedia"
                       name="reviewMedia[]"
                       accept="image/*,video/mp4,video/webm"
                       multiple
                       style="display:none;"
                       onchange="handleReviewMedia(this)">
                <div id="reviewMediaPreview" class="r-media-preview-container"
                     style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;"></div>
                @error('reviewMedia')
                    <span class="r-error" style="color:red;font-size:0.8rem;">{{ $message }}</span>
                @enderror
                @error('reviewMedia.*')
                    <span class="r-error" style="color:red;font-size:0.8rem;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn-wa-cta" style="border:none;cursor:pointer;margin-top:14px;">
            <i class="fas fa-paper-plane" style="margin-right:6px;"></i> Submit Review
        </button>

        @if (session('review_success'))
            <div class="review-success" style="margin-top:12px; color:green;">
                <i class="fas fa-check-circle"></i> {{ session('review_success') }}
            </div>
        @endif

    </form>
</div>
        </div>

    </div>
</section>

<!-- ══════════════ TABS ══════════════ -->
<section class="tabs-section">
    <div class="tabs-header">
        <button class="tab-btn active" onclick="switchTab(this,'tab-reviews')" id="tab-reviews-btn">
            <i class="fas fa-star"></i> Reviews ({{ $reviewCount }})
        </button>
        <button class="tab-btn" onclick="switchTab(this,'tab-desc')">
            <i class="fas fa-align-left"></i> Description
        </button>
        <button class="tab-btn" onclick="switchTab(this,'tab-shipping')">
            <i class="fas fa-truck"></i> Shipping & Care
        </button>
        <button class="tab-btn" onclick="switchTab(this,'tab-custom')">
            <i class="fas fa-pencil-ruler"></i> Custom Orders
        </button>
    </div>

    <!-- ─── DESCRIPTION TAB ─── -->
    <div class="tab-panel" id="tab-desc">
        <div class="desc-content">
            <div class="desc-text">
                <h3><i class="fas fa-om"></i> About {{ $product->name }}</h3>
                <p>{{ $product->description }}</p>

                <h3 style="margin-top:20px;"><i class="fas fa-carving"></i> Carving Details</h3>
                <ul>
                    <li>Triple shikhara spires with traditional kalash finials</li>
                    <li>Peacock motifs on central arch and side turrets</li>
                    <li>Swastika medallions on all four corner pillars</li>
                    <li>Perforated jaali jharokha arches in the front</li>
                    <li>Twisted rope-pattern columns with lotus capitals</li>
                    <li>Sunflower rosette carvings along the cornice</li>
                    <li>Engraved floral rangoli pattern on inner sanctum back wall</li>
                    <li>Storage compartment with sliding marble doors below the puja platform</li>
                </ul>

                <h3 style="margin-top:20px;"><i class="fas fa-layer-group"></i> Structure</h3>
                <ul>
                    <li>Upper Section: Triple-spired shikhara with peacock finials</li>
                    <li>Mid Section: Triple arched puja sanctum with columns</li>
                    <li>Lower Section: Raised puja platform with step access</li>
                    <li>Base Cabinet: Sliding-door storage for puja essentials</li>
                    <li>Total height includes the 3-step entrance staircase</li>
                </ul>
            </div>
            <div class="desc-image">
                <img src="{{ $product->main_image ? Storage::url($product->main_image) : '' }}"
                     alt="{{ $product->name }} Detail" />
            </div>
        </div>
    </div>

    <!-- ─── REVIEWS TAB ─── -->
    <div class="tab-panel active" id="tab-reviews">

        <!-- ── Rating Summary ── -->
        <div class="reviews-summary">
            <div class="big-rating">
                <div class="big-num">{{ $reviewCount > 0 ? number_format($avgRating, 1) : '—' }}</div>
                <div class="big-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        {{ $i <= round($avgRating) ? '★' : '☆' }}
                    @endfor
                </div>
                <div class="big-count">
                    Based on {{ $reviewCount }} {{ Str::plural('Review', $reviewCount) }}
                </div>
            </div>

            <div class="rating-bars">
                @for ($star = 5; $star >= 1; $star--)
                    <div class="rating-bar-row">
                        <span class="bar-label">{{ $star }} ★</span>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ $starCounts[$star]['pct'] }}%"></div>
                        </div>
                        <span class="bar-pct">{{ $starCounts[$star]['pct'] }}%</span>
                    </div>
                @endfor
            </div>
        </div>

        <!-- ── Review Cards ── -->
        <div class="review-cards">
            @forelse ($reviews as $review)
            <div class="review-card">
                <div class="review-header">
                    <div class="reviewer">
                        <div class="reviewer-avatar">
                            {{ strtoupper(substr($review->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="reviewer-name">{{ $review->name }}</div>
                            @if ($review->city || $review->state)
                            <div class="reviewer-loc">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ implode(', ', array_filter([$review->city, $review->state])) }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="review-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                {{ $i <= $review->rating ? '★' : '☆' }}
                            @endfor
                        </div>
                        <div class="review-date">{{ $review->created_at->format('F Y') }}</div>
                    </div>
                </div>

                <p class="review-text">{{ $review->review }}</p>

                {{-- Media grid — photos & videos --}}
                @if (!empty($review->media) && count($review->media))
                <div class="review-media-grid">
                    @foreach ($review->media as $mediaPath)
                        @php
                            $ext     = strtolower(pathinfo($mediaPath, PATHINFO_EXTENSION));
                            $isVideo = in_array($ext, ['mp4', 'webm']);
                            $url     = Storage::url($mediaPath);
                        @endphp

                        @if ($isVideo)
                        <div class="r-media-item video"
                             onclick="openReviewMediaLightbox(this, 'video', '{{ $url }}')">
                            <video src="{{ $url }}"
                                   style="width:100%;height:100%;object-fit:cover;pointer-events:none;"
                                   preload="metadata" muted playsinline></video>
                            <div class="r-play-btn"><i class="fas fa-play"></i></div>
                        </div>
                        @else
                        <img src="{{ $url }}"
                             class="r-media-item"
                             onclick="openReviewMediaLightbox(this)"
                             alt="Review photo by {{ $review->name }}" />
                        @endif
                    @endforeach
                </div>
                @endif

                @if ($review->customer_id)
                <div class="review-verified">
                    <i class="fas fa-check-circle"></i> Verified Customer
                </div>
                @endif
            </div>

            @empty
            <div style="padding:40px 0; text-align:center; color:var(--text-mid, #888);">
                <i class="fas fa-star" style="font-size:2rem; opacity:0.3;"></i>
                <p style="margin-top:12px;">No reviews yet. Be the first to share your experience!</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- ─── SHIPPING TAB ─── -->
    <div class="tab-panel" id="tab-shipping">
        <div class="shipping-grid">
            <div class="ship-card">
                <div class="ship-icon"><i class="fas fa-box-open"></i></div>
                <h4>Safe Packaging</h4>
                <p>Every piece is individually wrapped in bubble foam, packed in custom wooden crates, and secured
                    with industrial strapping before dispatch.</p>
            </div>
            <div class="ship-card">
                <div class="ship-icon"><i class="fas fa-truck"></i></div>
                <h4>Pan-India Delivery</h4>
                <p>We deliver to all major cities across India. Surface freight is used for safe handling of heavy
                    marble pieces. Transit time: 7–14 days after dispatch.</p>
            </div>
            <div class="ship-card">
                <div class="ship-icon"><i class="fas fa-tools"></i></div>
                <h4>Assembly Support</h4>
                <p>Detailed assembly guide included. For cities near Rajasthan, we arrange professional
                    installation. WhatsApp video-call assistance available anywhere.</p>
            </div>
        </div>
        <div class="ship-note">
            <strong>Delivery Timeline:</strong> Handcrafted-to-order products take <strong>6–8 weeks</strong> to
            carve and finish, followed by <strong>7–14 days</strong> for delivery. Total: 7–10 weeks from order
            confirmation.<br /><br />
            <strong>Marble Care:</strong> Clean with a soft damp cloth. Avoid acidic cleaners (lemon, vinegar). For
            deep cleaning, use mild soap and warm water. Polish annually with marble polishing powder. Keep away
            from direct water ingress. The natural luminosity of Makrana marble only improves with time and care.
        </div>
    </div>

    <!-- ─── CUSTOM ORDERS TAB ─── -->
    <div class="tab-panel" id="tab-custom">
        <div class="desc-content">
            <div class="desc-text">
                <h3><i class="fas fa-pencil-ruler"></i> Custom Orders Welcome</h3>
                <p>Every Rana Marble mandir can be customised to your exact specifications. Whether you have a
                    specific size in mind, a favourite deity motif, or a dream design from a reference photo — our
                    artisans will bring it to life.</p>
                <p>We accept custom orders for home mandirs of any size, from compact 18-inch apartment mandirs to
                    full 10-foot room installations. Share your requirements via WhatsApp and receive a detailed
                    quote within 24 hours.</p>
                <h3 style="margin-top:20px;"><i class="fas fa-list-check"></i> What Can Be Customised</h3>
                <ul>
                    <li>Width, depth, and height to fit your space perfectly</li>
                    <li>Number of spires (single, double, triple, five, or more)</li>
                    <li>Deity motifs — Ganesh, Radha-Krishna, Shiva, Durga, Hanuman, etc.</li>
                    <li>Finish — pure white, gold paint, full multicolour, or natural polish</li>
                    <li>Number of columns and arch styles</li>
                    <li>Addition of LED light channels inside the sanctum</li>
                    <li>Engraving of family name or deity shloka on base</li>
                    <li>Custom jaali patterns and perforated screens</li>
                </ul>
                <div style="margin-top:24px;">
                    <a href="https://wa.me/919876543210?text=Namaste! I want to enquire about a custom marble mandir order."
                        class="btn-wa-cta" target="_blank" style="display:inline-flex;text-decoration:none;">
                        <i class="fab fa-whatsapp fa-lg"></i> Discuss Custom Order on WhatsApp
                    </a>
                </div>
            </div>
            <div class="desc-image">
                <img src="{{ $product->main_image ? Storage::url($product->main_image) : '' }}"
                     alt="Gold Painted Custom Marble Mandir" />
            </div>
        </div>
    </div>

</section>










<!-- ══════════════ RELATED PRODUCTS ══════════════ -->
<section class="related-section">
    <div class="related-inner">
        <div class="section-header">
            <span class="section-tag"><i class="fas fa-heart"></i> &nbsp; You May Also Like</span>
            <h2 class="section-title" style="color: var(--gold);">Related Products</h2>
            <div class="gold-line"></div>
        </div>

        <div class="related-carousel" id="relatedCarousel">
            @foreach($categoryWiseAllProducts as $product)
            <div class="product-card" style="background: #1b0b06 !important;">
                <div class="product-img-wrap">
                    <img src="{{ $product->main_image ? Storage::url($product->main_image) : '' }}" alt="{{ $product->name }}" loading="lazy" />
                    <div class="prod-badge">{{ $product->category->name }}</div>
                    <div class="prod-actions">
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
                        <a href="{{ route('product.detail', $product->slug) }}" class="prod-action-btn"><i class="fas fa-eye"></i></a>
                    </div>
                </div>
                <div class="prod-info">
                    <div class="prod-name" style="color: #c9a84c !important;">{{ $product->name }}</div>
                    <div class="prod-meta"><a href="{{ route('product.detail', $product->slug) }}" class="btn-add-list"
                            style="width: 100%; margin-top: 8px; color: #c9a84c !important;">ADD TO CART</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>



<!-- ══ LIGHTBOX ══ -->
<div id="lightbox" onclick="closeLightbox()"
    style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.92);z-index:9999;align-items:center;justify-content:center;padding:20px;">
    <button onclick="closeLightbox()"
        style="position:absolute;top:20px;right:24px;background:none;border:none;color:white;font-size:2rem;cursor:pointer;z-index:2;">&times;</button>
    <img id="lightboxImg" src="" alt=""
        style="display:none; max-width:90vw;max-height:90vh;object-fit:contain;border-radius:6px;box-shadow:0 20px 60px rgba(0,0,0,0.5);"
        onclick="event.stopPropagation()" />
    <video id="lightboxVideo" controls
        style="display:none; max-width:90vw;max-height:90vh;border-radius:6px;box-shadow:0 20px 60px rgba(0,0,0,0.5);"
        onclick="event.stopPropagation()">
        <source src="" type="video/mp4" id="lightboxVideoSource">
    </video>
</div>

<!-- {{-- Pass all variants to JS --}} -->
<script src="{{ asset('./js/product-details.js') }}"></script>

{{-- Pass all variants to JS --}}
<script>
    window.VARIANTS = {!! json_encode($variantsJson) !!};
    window.SELECTED = {!! json_encode([
        'sizeId'  => $firstVariant?->size_id,
        'colorId' => $firstVariant?->color_id,
    ]) !!};
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (!window.VARIANTS || !window.SELECTED) return;

        window.SELECTED.sizeId  = parseInt(window.SELECTED.sizeId);
        window.SELECTED.colorId = parseInt(window.SELECTED.colorId);

        renderColors(window.SELECTED.sizeId, window.SELECTED.colorId);
        updatePrice();
        updateSelectedVariantInput(); // ← set hidden input on load
    });

    /* ─── Select Size ─── */
    function selectSize(el, label) {
        if (!window.SELECTED) window.SELECTED = {};

        document.querySelectorAll(".size-opt").forEach(o => o.classList.remove("active"));
        el.classList.add("active");
        document.getElementById("selectedSize").textContent = "(" + label + ")";

        const sizeId = parseInt(el.dataset.sizeId);
        window.SELECTED.sizeId = sizeId;

        const firstForSize = window.VARIANTS.find(v => v.size_id === sizeId);
        window.SELECTED.colorId = firstForSize ? parseInt(firstForSize.color_id) : null;

        renderColors(sizeId, window.SELECTED.colorId);
        updatePrice();
        updateSelectedVariantInput(); // ← update hidden input on size change
    }

    /* ─── Select Finish ─── */
    function selectFinish(el, label) {
        document.querySelectorAll(".finish-opt").forEach(o => o.classList.remove("active"));
        el.classList.add("active");
        document.getElementById("selectedFinish").textContent = "(" + label + ")";
        window.SELECTED.colorId = parseInt(el.dataset.colorId);
        updatePrice();
        updateSelectedVariantInput(); // ← update hidden input on color change
    }

    /* ─── Render Colors for a Given Size ─── */
    function renderColors(sizeId, activeColorId) {
        const container    = document.getElementById("finishOptions");
        const colorSection = document.getElementById("colorSection");
        if (!container) return;

        const sizeVariants = window.VARIANTS.filter(v => parseInt(v.size_id) === parseInt(sizeId));

        if (!sizeVariants.length) {
            container.innerHTML = "<p style='color:#999;font-size:0.85rem;'>No finishes available.</p>";
            if (colorSection) colorSection.style.display = "none";
            return;
        }

        if (colorSection) colorSection.style.display = "";

        container.innerHTML = sizeVariants.map(v => `
            <div class="finish-opt ${parseInt(v.color_id) === parseInt(activeColorId) ? 'active' : ''}"
                data-color-id="${v.color_id}"
                onclick="selectFinish(this, '${v.color}')">
                <div class="finish-swatch"
                    style="background:${v.hex}; border:1.5px solid rgba(0,0,0,0.1);">
                </div>
                <span class="finish-name">${v.color}</span>
            </div>
        `).join("");

        const active = sizeVariants.find(v => parseInt(v.color_id) === parseInt(activeColorId)) || sizeVariants[0];
        if (active) {
            document.getElementById("selectedFinish").textContent = "(" + active.color + ")";
            window.SELECTED.colorId = parseInt(active.color_id);
        }
    }

    /* ─── Update hidden variant_id input ─── */
    function updateSelectedVariantInput() {
        const input = document.getElementById('selectedVariantId');
        if (!input) return;

        const variant = window.VARIANTS?.find(v =>
            parseInt(v.size_id)  === parseInt(window.SELECTED?.sizeId) &&
            parseInt(v.color_id) === parseInt(window.SELECTED?.colorId)
        );

        input.value = variant?.id ?? '';
    }

    /* ─── Add to Cart ─── */
    function addToCart() {
        const variantInput = document.getElementById('selectedVariantId');

        if (!variantInput || !variantInput.value) {
            alert('Please select a size and finish first.');
            return;
        }

        const form = document.getElementById('addToCartForm');

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
                'Content-Type': 'application/json',
                'Accept':       'application/json',
            },
            body: JSON.stringify({
                product_id: form.querySelector('[name="product_id"]').value,
                variant_id: variantInput.value,
                quantity:   form.querySelector('[name="quantity"]').value,
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showCartToast(data.message);
                updateCartCount(data.cart_count);
            } else if (data.redirect) {
                window.location.href = data.redirect;
            } else {
                alert(data.message ?? 'Something went wrong.');
            }
        })
        .catch(() => alert('Something went wrong. Please try again.'));
    }

    /* ─── Toast Notification ─── */
    function showCartToast(msg) {
        let toast = document.getElementById('cartToast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'cartToast';
            toast.style.cssText = `
                position: fixed; bottom: 30px; left: 50%;
                transform: translateX(-50%);
                background: linear-gradient(135deg, #27ae60, #1e8449);
                color: white; padding: 14px 24px; border-radius: 8px;
                font-family: 'Cinzel', serif; font-size: 0.85rem;
                letter-spacing: 0.08em;
                box-shadow: 0 8px 24px rgba(0,0,0,0.2);
                z-index: 9999; display: flex; align-items: center;
                gap: 10px; transition: opacity 0.4s;
            `;
            document.body.appendChild(toast);
        }
        toast.innerHTML = `<i class="fas fa-check-circle"></i> ${msg}`;
        toast.style.opacity = '1';
        clearTimeout(toast._timeout);
        toast._timeout = setTimeout(() => { toast.style.opacity = '0'; }, 3000);
    }

    /* ─── Update Cart Count in Navbar ─── */
    function updateCartCount(count) {
        const badge = document.querySelector('.cart-count');
        if (badge) badge.textContent = count;
    }

    /* ─── Update Price ─── */
    function updatePrice() {
        const priceEl = document.getElementById("variantPrice");
        if (!priceEl || !window.VARIANTS || !window.SELECTED) return;

        const variant = window.VARIANTS.find(v =>
            parseInt(v.size_id)  === parseInt(window.SELECTED.sizeId) &&
            parseInt(v.color_id) === parseInt(window.SELECTED.colorId)
        );

        if (variant) {
            priceEl.textContent = "₹ " + formatPrice(variant.price);
            return;
        }

        const sizeMatches = window.VARIANTS.filter(v =>
            parseInt(v.size_id) === parseInt(window.SELECTED.sizeId)
        );

        if (sizeMatches.length) {
            const min = Math.min(...sizeMatches.map(v => v.price));
            const max = Math.max(...sizeMatches.map(v => v.price));
            priceEl.textContent = min === max
                ? "₹ " + formatPrice(min)
                : "₹ " + formatPrice(min) + " — ₹ " + formatPrice(max);
            return;
        }

        priceEl.textContent = "Price on request";
    }

    /* ─── Format Price Indian Style ─── */
    function formatPrice(n) {
        return Number(n).toLocaleString("en-IN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }
</script>

<script>
    // ── Star Rating ───────────────────────────────────────────────────────────
    (function () {
        const stars  = document.querySelectorAll('#starPicker .stars-input i');
        const hidden = document.getElementById('selectedRating');

        if (!stars.length || !hidden) return;

        // Restore state on page load (e.g. after validation fail with old('rating'))
        const saved = parseInt(hidden.value) || 0;
        if (saved > 0) paintStars(saved);

        // Hover — preview
        stars.forEach(star => {
            star.addEventListener('mouseenter', () => paintStars(parseInt(star.dataset.val)));
            star.addEventListener('mouseleave', () => paintStars(parseInt(hidden.value) || 0));
        });

        // Click — lock in value
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const val    = parseInt(star.dataset.val);
                hidden.value = val;
                paintStars(val);
            });
        });

        function paintStars(upTo) {
            stars.forEach(s => {
                const v = parseInt(s.dataset.val);
                s.classList.toggle('fas', v <= upTo);   // filled
                s.classList.toggle('far', v > upTo);    // empty
                s.style.color = v <= upTo ? 'var(--gold, #c9a84c)' : '';
            });
        }
    })();
</script>

<script>
function toggleWishlist(btn, productId) {
    fetch(`/wishlist/${productId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success && data.redirect) {
            window.location.href = data.redirect;
            return;
        }

        if (data.success) {
            if (data.added) {
                btn.style.color = 'var(--saffron)';
                btn.title = 'Remove from Wishlist';
            } else {
                btn.style.color = '';
                btn.title = 'Add to Wishlist';
            }

            // Optional: show toast/flash
            showToast(data.message);
        }
    })
    .catch(err => console.error('Wishlist error:', err));
}

</script>

@endsection