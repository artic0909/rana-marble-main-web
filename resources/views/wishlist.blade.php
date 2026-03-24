@extends('frontend.layout.app')

@section('title', 'My Wishlist - Rana Marble | Divine Marble')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('./css/account.css') }}">
</head>

<section class="wishlist-section">
    <div class="container">
        <div class="profile-layout full-width-layout">
            <div class="profile-content">
                <div class="tab-pane active">

                    <div class="wishlist-header">
                        <div class="wishlist-count" id="wishlistCount">
                            {{ $wishlistItems->count() }} {{ Str::plural('Item', $wishlistItems->count()) }} in Wishlist
                        </div>
                        @if($wishlistItems->count())
                        <button class="clear-wishlist" onclick="clearWishlist()">
                            <i class="fas fa-trash-alt"></i> Clear All
                        </button>
                        @endif
                    </div>

                    @forelse($wishlistItems as $item)
                    <div class="wishlist-date-group">
                        <div class="wishlist-list">

                            <div class="product-card wishlist-card list-view"
                                id="wishlist-item-{{ $item->id }}">

                                <div class="product-img-wrap">
                                    <img src="{{ $item->product->main_image ? Storage::url($item->product->main_image) : asset('./img/placeholder.png') }}"
                                        alt="{{ $item->product->name }}" loading="lazy" />
                                    <div class="product-badge">{{ $item->product->category->name ?? '' }}</div>
                                </div>

                                <div class="product-info">
                                    <div class="product-cat">{{ $item->product->category->name ?? '' }}</div>
                                    <h3 class="product-name">{{ $item->product->name }}</h3>
                                    <h3 class="product-name">
                                        Price: ₹ {{ number_format($item->product->variants->min('price'), 2) }}
                                        @if($item->product->variants->count() > 1)
                                        — ₹ {{ number_format($item->product->variants->max('price'), 2) }}
                                        @endif
                                    </h3>
                                    <div class="product-meta">
                                        <span style="font-family:'Crimson Pro',serif;font-size:0.82rem;color:var(--text-light);">
                                            Added {{ $item->created_at->diffForHumans() }}
                                        </span>
                                        <a href="{{ route('product.detail', $item->product->slug) }}"
                                            class="btn-add-list">
                                            View Product
                                        </a>
                                    </div>
                                </div>

                                <button class="btn-remove" title="Remove from wishlist"
                                    onclick="removeFromWishlist({{ $item->id }})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                    @empty
                    <div id="wishlistEmpty" style="text-align:center;padding:60px 20px;">
                        <i class="fas fa-heart" style="font-size:3rem;color:var(--gold);opacity:0.4;"></i>
                        <p style="margin-top:16px;color:var(--text-light);
                            font-family:'Crimson Pro',serif;font-size:1.1rem;">
                            Your wishlist is empty.
                        </p>
                        @guest
                        <a href="{{ route('product.all') }}" class="btn-primary"
                            style="margin-top:16px;display:inline-flex;align-items:center;gap:8px;text-decoration:none;">
                            <i class="fas fa-store"></i> Browse Products
                        </a>
                        @endguest
                        @auth
                        <a href="{{ route('customer.product.all') }}" class="btn-primary"
                            style="margin-top:16px;display:inline-flex;align-items:center;gap:8px;text-decoration:none;">
                            <i class="fas fa-store"></i> Browse Products
                        </a>
                        @endauth
                    </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</section>

<div class="ornament-divider" style="margin:0 0 40px;text-align:center;color:var(--saffron);">
    <i class="fas fa-om"></i>
</div>

<script>
    const CSRF = "{{ csrf_token() }}";

    /* ─── Remove single item ─── */
    function removeFromWishlist(id) {
        fetch(`/customer/wishlist/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const el = document.getElementById('wishlist-item-' + id);
                    el.style.transition = 'opacity 0.3s, transform 0.3s';
                    el.style.opacity = '0';
                    el.style.transform = 'translateX(30px)';
                    setTimeout(() => {
                        el.closest('.wishlist-date-group')?.remove();
                        updateWishlistCount();
                        checkEmpty();
                    }, 300);
                }
            });
    }

    /* ─── Clear all ─── */
    function clearWishlist() {
        if (!confirm('Clear all wishlist items?')) return;
        fetch(`/customer/wishlist`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.querySelectorAll('.wishlist-date-group').forEach(el => el.remove());
                    updateWishlistCount();
                    checkEmpty();
                }
            });
    }

    /* ─── Update count ─── */
    function updateWishlistCount() {
        const count = document.querySelectorAll('.wishlist-card').length;
        const el = document.getElementById('wishlistCount');
        if (el) el.textContent = `${count} ${count === 1 ? 'Item' : 'Items'} in Wishlist`;
    }

    /* ─── Show empty state ─── */
    function checkEmpty() {
        if (!document.querySelectorAll('.wishlist-card').length) {
            document.querySelector('.tab-pane').insertAdjacentHTML('beforeend', `
                <div style="text-align:center;padding:60px 20px;">
                    <i class="fas fa-heart" style="font-size:3rem;color:var(--gold);opacity:0.4;"></i>
                    <p style="margin-top:16px;color:var(--text-light);
                        font-family:'Crimson Pro',serif;font-size:1.1rem;">
                        Your wishlist is empty.
                    </p>
                    <a href="{{ route('product.all') }}" class="btn-primary"
                        style="margin-top:16px;display:inline-flex;align-items:center;gap:8px;text-decoration:none;">
                        <i class="fas fa-store"></i> Browse Products
                    </a>
                </div>
            `);
            // Hide clear button
            document.querySelector('.clear-wishlist')?.remove();
        }
    }

    function toggleWishlist(btn, productId) {
        fetch(`/customer/wishlist/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.redirect) {
                    window.location.href = data.redirect;
                    return;
                }
                if (data.success) {
                    const icon = btn.querySelector('i');
                    icon.style.color = data.added ? 'var(--saffron)' : '';
                }
            });
    }
</script>

@endsection