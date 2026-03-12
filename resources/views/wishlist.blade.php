@extends('frontend.layout.app')

@section('title', 'My Wishlist - Rana Marble | Divine Marble')

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
                <!-- WISHLIST TAB -->
                <div class="tab-pane active">
                    <div class="wishlist-header">
                        <div class="wishlist-count">2 Items in Wishlist</div>
                        <button class="clear-wishlist"
                            onclick="alert('In a real app, this would clear the wishlist.')"><i
                                class="fas fa-trash-alt"></i> Clear All</button>
                    </div>

                    <!-- Date Wise List View -->

                    <!-- Group 1: Today -->
                    <div class="wishlist-date-group">
                        <h3 class="wishlist-date"><i class="fas fa-calendar-day"></i> Added Products</h3>
                        <div class="wishlist-list">

                            <!-- Product 1 -->
                            <div class="product-card wishlist-card list-view">
                                <div class="product-img-wrap">
                                    <img src="./img/hero.png" alt="Royal Tri-Shikhara White Marble Mandir"
                                        loading="lazy" />
                                    <div class="product-badge">Bestseller</div>
                                </div>
                                <div class="product-info">
                                    <div class="product-cat">Home Mandirs</div>
                                    <h3 class="product-name">Royal Tri-Shikhara Mandir</h3>
                                    <h3 class="product-name">Price: ₹ 1,50,000</h3>
                                    <div class="product-meta">
                                        <div class="product-size"><i class="fas fa-ruler-combined"></i> 4 × 3 × 2 ft
                                        </div>
                                        <a href="#" class="btn-add-list" target="_blank">
                                            Add to Cart
                                        </a>
                                    </div>
                                </div>
                                <button class="btn-remove" title="Remove from wishlist"
                                    onclick="this.closest('.wishlist-card').style.display='none';"><i
                                        class="fas fa-times"></i></button>
                            </div>

                            <!-- Product 2 -->
                            <div class="product-card wishlist-card list-view">
                                <div class="product-img-wrap">
                                    <img src="./img/hero.png" alt="Om Suraj Gold-Painted Marble Mandir"
                                        loading="lazy" />
                                    <div class="product-badge new">New Arrival</div>
                                </div>
                                <div class="product-info">
                                    <div class="product-cat">Gold Painted Mandirs</div>
                                    <h3 class="product-name">Om Suraj Gold-Painted Mandir</h3>
                                    <h3 class="product-name">Price: ₹ 1,50,000</h3>
                                    <div class="product-meta">
                                        <div class="product-size"><i class="fas fa-ruler-combined"></i> 3.5 × 2.5 ft
                                        </div>
                                        <a href="#" class="btn-add-list" target="_blank">
                                            Add to Cart
                                        </a>
                                    </div>
                                </div>
                                <button class="btn-remove" title="Remove from wishlist"
                                    onclick="this.closest('.wishlist-card').style.display='none';"><i
                                        class="fas fa-times"></i></button>
                            </div>

                        </div>
                    </div>

                </div> <!-- End tab-wishlist -->


            </div> <!-- End profile-content -->
        </div> <!-- End profile-layout -->
    </div>
</section>

<div class="ornament-divider" style="margin: 0 0 40px; text-align: center; color: var(--saffron);"><i class="fas fa-om"></i></div>

@endsection