@extends('frontend.layout.app')

@section('title', 'My Orders - Rana Marble | Divine Marble')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('./css/account.css') }}">
</head>

<!-- CONTENT -->
<section class="wishlist-section">
    <div class="container">
        <div class="profile-layout full-width-layout">
            <!-- Sidebar -->


            <!-- Main Content -->
            <div class="profile-content">

                <div class="tab-pane active">
                    <h2 class="tab-title">Order History</h2>

                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-info">
                                <span class="order-id">Order #RM-2026-089</span>
                                <span class="order-date">Placed on Oct 24, 2026</span>
                            </div>
                            <div class="order-status status-delivered">Delivered</div>
                        </div>
                        <div class="order-body">
                            <img src="./img/hero.png" alt="Royal Tri-Shikhara Mandir" class="order-img">
                            <div class="order-details">
                                <h4 class="order-name">Royal Tri-Shikhara Mandir</h4>
                                <p class="order-meta">Size: 4 × 3 × 2 ft | Finish: White Marble</p>
                                <p class="order-price">₹ 1,50,000</p>
                            </div>
                            <div class="order-actions">
                                <button class="btn-primary" style="padding: 8px 16px; font-size: 0.85rem;"><i
                                        class="fas fa-file-invoice"></i> File Invoice</button>
                            </div>
                        </div>
                    </div>

                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-info">
                                <span class="order-id">Order #RM-2026-092</span>
                                <span class="order-date">Placed on Nov 02, 2026</span>
                            </div>
                            <div class="order-status status-processing">Processing</div>
                        </div>
                        <div class="order-body">
                            <img src="./img/hero2.png" alt="Peacock Arched Open Mandir" class="order-img">
                            <div class="order-details">
                                <h4 class="order-name">Peacock Arched Open Mandir</h4>
                                <p class="order-meta">Size: 42 × 24 in | Custom Order</p>
                                <p class="order-price">₹ 1,25,000</p>
                            </div>
                            <div class="order-actions">
                                <button class="btn-primary" style="padding: 8px 16px; font-size: 0.85rem;"><i
                                        class="fas fa-truck"></i> Track Order</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div> <!-- End profile-content -->
        </div> <!-- End profile-layout -->
    </div>
</section>

<div class="ornament-divider" style="margin: 0 0 40px; text-align: center; color: var(--saffron);"><i class="fas fa-om"></i></div>

@endsection