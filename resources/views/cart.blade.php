@extends('frontend.layout.app')

@section('title', 'Shopping Cart - Rana Marble | Divine Marble')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('./css/cart.css') }}">
    <style>
        .float-wa{
            display: none !important;
        }
    </style>
</head>

<section class="cart-section">
    <div class="container cart-layout">

        <!-- ─── Cart Items ─── -->
        <div class="cart-items">
            <div class="cart-header">
                <h2>Shopping Cart
                    <span id="cartItemCount">({{ $cartItems->count() }} {{ Str::plural('Item', $cartItems->count()) }})</span>
                </h2>
            </div>

            @forelse($cartItems as $item)
            <div class="cart-item" id="cart-item-{{ $item->id }}"
                data-id="{{ $item->id }}"
                data-price="{{ $item->variant->price ?? 0 }}">

                {{-- Product Image --}}
                <img src="{{ $item->product->main_image ? Storage::url($item->product->main_image) : asset('./img/placeholder.png') }}"
                    alt="{{ $item->product->name }}"
                    class="cart-img">

                {{-- Product Details --}}
                <div class="cart-details">
                    <div class="cart-cat">{{ $item->product->category->name ?? '' }}</div>
                    <h3 class="cart-name">{{ $item->product->name }}</h3>
                    @if($item->variant->size)
                    <p class="cart-meta">Size: {{ $item->variant->size->name }}</p>
                    @endif
                    @if($item->variant->color)
                    <p class="cart-meta">Finish: {{ $item->variant->color->name }}</p>
                    @endif
                </div>

                {{-- Price & Qty --}}
                <div class="cart-price-qty">
                    <div class="cart-price" id="item-price-{{ $item->id }}">
                        ₹{{ number_format($item->variant->price * $item->quantity, 2) }}
                    </div>
                    <div class="qty-control">
                        <button type="button" onclick="updateQuantity({{ $item->id }}, -1)">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number"
                            id="qty-{{ $item->id }}"
                            value="{{ $item->quantity }}"
                            min="1" max="10" readonly>
                        <button type="button" onclick="updateQuantity({{ $item->id }}, 1)">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                {{-- Remove --}}
                <button class="cart-remove" title="Remove Item"
                    onclick="removeItem({{ $item->id }})">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
            @empty
            <div class="cart-empty" id="cartEmpty">
                <i class="fas fa-shopping-cart" style="font-size:3rem;color:var(--gold);opacity:0.4;"></i>
                <p style="margin-top:16px;color:var(--text-light);font-family:'Crimson Pro',serif;font-size:1.1rem;">
                    Your cart is empty.
                </p>
                <a href="{{ route('customer.product.all') }}" class="btn-secondary" style="margin-top:16px;">
                    <i class="fas fa-store"></i> Browse Products
                </a>
            </div>
            @endforelse

            <div class="cart-actions-bottom">
                <a href="{{ route('customer.product.all') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
            </div>
        </div>

        <!-- ─── Order Summary ─── -->
        <aside class="cart-summary">
            <h3>Order Summary</h3>

            <div class="summary-row">
                <span>Subtotal</span>
                <span id="summarySubtotal">₹{{ number_format($total, 2) }}</span>
            </div>

            {{-- Shipping Row --}}
            <div class="summary-row">
                <span>Shipping</span>
                <span id="summaryShipping">
                    @php
                    $customer = Auth::guard('customer')->user();
                    $customerPincode = $customer->pincode ?? null;
                    $matchedPincode = null;

                    if ($customerPincode) {
                    $matchedPincode = \App\Models\Pincode::where('name', $customerPincode)->first();
                    }
                    @endphp

                    @if(!$customerPincode)
                    {{-- No pincode set --}}
                    <span style="color:#e74c3c;font-size:0.82rem;">—</span>
                    @elseif($matchedPincode)
                    {{-- Matched --}}
                    ₹{{ number_format($matchedPincode->fees, 2) }}
                    @else
                    {{-- Not in service --}}
                    <span style="color:#e74c3c;font-size:0.82rem;">N/A</span>
                    @endif
                </span>
            </div>

            {{-- Shipping Notice --}}
            @if(!$customerPincode)
            <div style="background:rgba(201,168,76,0.1);border:1px solid var(--gold);
            border-radius:6px;padding:12px 14px;margin:10px 0;
            font-family:'Crimson Pro',serif;font-size:0.88rem;color:var(--text-mid);
            display:flex;align-items:flex-start;gap:8px;">
                <i class="fas fa-map-marker-alt" style="color:var(--saffron);margin-top:2px;"></i>
                <span>
                    Please add your delivery pincode from your
                    <a href="{{ route('customer.profile') ?? '#' }}"
                        style="color:var(--saffron);font-weight:600;text-decoration:none;">
                        profile page
                    </a> to calculate shipping charges.
                </span>
            </div>
            @elseif(!$matchedPincode)
            <div style="background:rgba(231,76,60,0.08);border:1px solid #e74c3c;
            border-radius:6px;padding:12px 14px;margin:10px 0;
            font-family:'Crimson Pro',serif;font-size:0.88rem;color:#c0392b;
            display:flex;align-items:flex-start;gap:8px;">
                <i class="fas fa-exclamation-circle" style="margin-top:2px;"></i>
                <span>
                    Your pincode <strong>{{ $customerPincode }}</strong> is not in our service area.
                    Please contact us on
                    @php
    $productList = $cartItems->map(fn($item) => 
        $item->product->name . ' (' . route('product.detail', $item->product->slug) . ')'
    )->join(', ');

    $waMessage = 'Hello! My pincode ' . $customerPincode . ' is not in your delivery list. '
               . 'I am interested in: ' . $productList . '. '
               . 'Can you help with delivery?';
@endphp

<a href="https://wa.me/919876543210?text={{ urlencode($waMessage) }}"
    target="_blank"
    style="color:#25D366;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
    <i class="fab fa-whatsapp"></i> WhatsApp
</a>
                </span>
            </div>
            @endif

            <hr>
            <div class="summary-row total">
                <span>Total Amount</span>
                <span id="summaryTotal">
                    @if($matchedPincode)
                    ₹{{ number_format(($total) + ($matchedPincode->fees), 2) }}
                    @else
                    ₹{{ number_format($total, 2) }}
                    @endif
                </span>
            </div>

            <!-- <div class="promo-code">
                <input type="text" id="couponInput" placeholder="Coupon Code">
                <button onclick="applyCoupon()">Apply</button>
            </div> -->

            @if($matchedPincode)
<form action="{{ route('customer.checkout') }}" method="POST">
    @csrf
    <button type="submit" class="btn-checkout">
        Proceed to Checkout <i class="fas fa-shield-alt"></i>
    </button>
</form>
            @else
            <button class="btn-checkout" disabled
                style="opacity:0.5;cursor:not-allowed;pointer-events:none;">
                Proceed to Checkout <i class="fas fa-shield-alt"></i>
            </button>
            @endif

            <div class="secure-checkout">
                <i class="fas fa-lock"></i> 100% Secure Checkout<br>
                Authentic Makrana Marble Guarantee
            </div>
        </aside>

    </div>
</section>

<div class="ornament-divider" style="margin:0 0 40px;text-align:center;color:var(--saffron);">
    <i class="fas fa-om"></i>
</div>

<script>
    const CSRF = "{{ csrf_token() }}";

    /* ─── Update Quantity ─── */
    function updateQuantity(id, change) {
        const input = document.getElementById('qty-' + id);
        let newQty = parseInt(input.value) + change;
        if (newQty < 1) newQty = 1;
        if (newQty > 10) newQty = 10;

        fetch(`/customer/cart/${id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    quantity: newQty
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    input.value = newQty;
                    updateItemPrice(id, newQty);
                    recalcSummary();
                }
            })
            .catch(() => showToast('Failed to update quantity.', 'error'));
    }

    /* ─── Remove Item ─── */
    function removeItem(id) {
        fetch(`/customer/cart/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const el = document.getElementById('cart-item-' + id);
                    el.style.transition = 'opacity 0.3s, transform 0.3s';
                    el.style.opacity = '0';
                    el.style.transform = 'translateX(30px)';
                    setTimeout(() => {
                        el.remove();
                        recalcSummary();
                        updateItemCount();
                        checkEmpty();
                    }, 300);
                }
            })
            .catch(() => showToast('Failed to remove item.', 'error'));
    }

    /* ─── Update displayed item price ─── */
    function updateItemPrice(id, qty) {
        const row = document.getElementById('cart-item-' + id);
        const price = parseFloat(row.dataset.price);
        document.getElementById('item-price-' + id).textContent =
            '₹' + (price * qty).toLocaleString('en-IN', {
                minimumFractionDigits: 2
            });
    }

    /* ─── Recalculate Summary ─── */
const SHIPPING_FEES = {{ $matchedPincode?->fees ?? 0 }};

function recalcSummary() {
    let subtotal = 0;
    document.querySelectorAll('.cart-item').forEach(row => {
        const price = parseFloat(row.dataset.price) || 0;
        const qty   = parseInt(document.getElementById('qty-' + row.dataset.id)?.value) || 0;
        subtotal   += price * qty;
    });

    const total = subtotal + SHIPPING_FEES;

    document.getElementById('summarySubtotal').textContent =
        '₹' + subtotal.toLocaleString('en-IN', { minimumFractionDigits: 2 });
    document.getElementById('summaryTotal').textContent =
        '₹' + total.toLocaleString('en-IN', { minimumFractionDigits: 2 });
}

    /* ─── Update item count in header ─── */
    function updateItemCount() {
        const count = document.querySelectorAll('.cart-item').length;
        document.getElementById('cartItemCount').textContent =
            `(${count} ${count === 1 ? 'Item' : 'Items'})`;
        const badge = document.querySelector('.cart-count');
        if (badge) badge.textContent = count;
    }

    /* ─── Show empty state ─── */
    function checkEmpty() {
        if (!document.querySelectorAll('.cart-item').length) {
            document.querySelector('.cart-items').insertAdjacentHTML('afterbegin', `
                <div style="text-align:center;padding:40px 20px;">
                    <i class="fas fa-shopping-cart" style="font-size:3rem;color:var(--gold);opacity:0.4;"></i>
                    <p style="margin-top:16px;color:var(--text-light);font-family:'Crimson Pro',serif;font-size:1.1rem;">
                        Your cart is empty.
                    </p>
                    <a href="{{ route('customer.product.all') }}" class="btn-secondary" style="margin-top:16px;display:inline-flex;">
                        <i class="fas fa-store"></i> Browse Products
                    </a>
                </div>
            `);
        }
    }

    /* ─── Apply Coupon ─── */
    function applyCoupon() {
        const code = document.getElementById('couponInput').value.trim();
        if (!code) {
            showToast('Please enter a coupon code.', 'error');
            return;
        }
        showToast('Coupon feature coming soon!', 'info');
    }

    /* ─── Toast ─── */
    function showToast(msg, type = 'success') {
        const colors = {
            success: 'linear-gradient(135deg,#27ae60,#1e8449)',
            error: 'linear-gradient(135deg,#e74c3c,#c0392b)',
            info: 'linear-gradient(135deg,#c9a84c,#a0772a)',
        };
        let toast = document.getElementById('cartToast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'cartToast';
            toast.style.cssText = `
                position:fixed;bottom:30px;left:50%;transform:translateX(-50%);
                color:white;padding:14px 24px;border-radius:8px;
                font-family:'Cinzel',serif;font-size:0.85rem;letter-spacing:0.08em;
                box-shadow:0 8px 24px rgba(0,0,0,0.2);z-index:9999;
                display:flex;align-items:center;gap:10px;transition:opacity 0.4s;
            `;
            document.body.appendChild(toast);
        }
        toast.style.background = colors[type] || colors.success;
        toast.style.opacity = '1';
        toast.innerHTML = `<i class="fas fa-${type === 'error' ? 'times' : 'check'}-circle"></i> ${msg}`;
        clearTimeout(toast._t);
        toast._t = setTimeout(() => {
            toast.style.opacity = '0';
        }, 3000);
    }
</script>

@endsection