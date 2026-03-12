@extends('frontend.layout.app')

@section('title', 'Shopping Cart - Rana Marble | Divine Marble')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('./css/cart.css') }}">
</head>



<!-- ═══════════════════════════════════ CART SECTION ═══════════════════════════════════ -->
<section class="cart-section">
    <div class="container cart-layout">

        <!-- Cart Items -->
        <div class="cart-items">
            <div class="cart-header">
                <h2>Shopping Cart (2 Items)</h2>
            </div>

            <div class="cart-item">
                <img src="./img/hero.png" alt="Royal Tri-Shikhara Mandir" class="cart-img">
                <div class="cart-details">
                    <div class="cart-cat">Home Mandirs</div>
                    <h3 class="cart-name">Royal Tri-Shikhara Mandir</h3>
                    <p class="cart-meta">Size: 4 × 3 × 2 ft</p>
                    <p class="cart-meta">Finish: White Makrana</p>
                </div>
                <div class="cart-price-qty">
                    <div class="cart-price">₹1,50,000</div>
                    <div class="qty-control">
                        <button onclick="updateQuantity(this, -1)"><i class="fas fa-minus"></i></button>
                        <input type="number" value="1" min="1" readonly>
                        <button onclick="updateQuantity(this, 1)"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <button class="cart-remove" title="Remove Item"
                    onclick="this.closest('.cart-item').style.display='none';"><i
                        class="fas fa-trash-alt"></i></button>
            </div>

            <div class="cart-item">
                <img src="./img/hero2.png" alt="Om Suraj Gold Painted Mandir" class="cart-img">
                <div class="cart-details">
                    <div class="cart-cat">Gold Painted Mandirs</div>
                    <h3 class="cart-name">Om Suraj Gold-Painted Mandir</h3>
                    <p class="cart-meta">Size: 3.5 × 2.5 ft</p>
                </div>
                <div class="cart-price-qty">
                    <div class="cart-price">₹1,25,000</div>
                    <div class="qty-control">
                        <button onclick="updateQuantity(this, -1)"><i class="fas fa-minus"></i></button>
                        <input type="number" value="1" min="1" readonly>
                        <button onclick="updateQuantity(this, 1)"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <button class="cart-remove" title="Remove Item"
                    onclick="this.closest('.cart-item').style.display='none';"><i
                        class="fas fa-trash-alt"></i></button>
            </div>

            <div class="cart-actions-bottom">
                <a href="products.html" class="btn-secondary"><i class="fas fa-arrow-left"></i> Continue
                    Shopping</a>
            </div>
        </div>

        <!-- Cart Summary -->
        <aside class="cart-summary">
            <h3>Order Summary</h3>
            <div class="summary-row">
                <span>Subtotal</span>
                <span>₹2,75,000</span>
            </div>
            <div class="summary-row">
                <span>GST (18%)</span>
                <span>₹49,500</span>
            </div>
            <div class="summary-row">
                <span>Shipping</span>
                <span style="color: #28a745; font-weight: 600;">Free</span>
            </div>
            <hr>
            <div class="summary-row total">
                <span>Total Amount</span>
                <span>₹3,24,500</span>
            </div>

            <div class="promo-code">
                <input type="text" placeholder="Coupon Code">
                <button>Apply</button>
            </div>

            <a href="#" class="btn-checkout">Proceed to Checkout <i class="fas fa-shield-alt"></i></a>

            <div class="secure-checkout">
                <i class="fas fa-lock"></i> 100% Secure Checkout<br>
                Authentic Makrana Marble Guarantee
            </div>
        </aside>

    </div>
</section>

<div class="ornament-divider" style="margin: 0 0 40px; text-align: center; color: var(--saffron);"><i class="fas fa-om"></i></div>


<script>
    function updateQuantity(btn, change) {
        const input = btn.parentElement.querySelector('input');
        let val = parseInt(input.value) + change;
        if (val < 1) val = 1;
        input.value = val;
    }
</script>
@endsection