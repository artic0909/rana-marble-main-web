@extends('frontend.layout.app')

@section('title', 'My Orders - Rana Marble | Divine Marble')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('./css/account.css') }}">
</head>

<section class="wishlist-section">
    <div class="container">
        <div class="profile-layout full-width-layout">

            <div class="profile-content">
                <div class="tab-pane active">
                    <h2 class="tab-title">Order History</h2>

                    {{-- Success / Error messages --}}
                    @if(session('success'))
                    <div style="background:rgba(39,174,96,0.1);border:1px solid #27ae60;color:#27ae60;
                            border-radius:6px;padding:12px 16px;margin-bottom:20px;
                            font-family:'Crimson Pro',serif;font-size:0.95rem;
                            display:flex;align-items:center;gap:8px;">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                    @endif

                    @forelse($orders as $order)
                    <div class="order-card">

                        {{-- Order Header --}}
                        <div class="order-header">
                            <div class="order-info">
                                <span class="order-id">Order #{{ $order->order_number }}</span>
                                <span class="order-date">Placed on {{ $order->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="order-status"
                                style="background:{{ $order->status_color }}20;
                                       color:{{ $order->status_color }};
                                       border:1px solid {{ $order->status_color }}40;
                                       padding:4px 14px;border-radius:20px;
                                       font-family:'Cinzel',serif;font-size:0.75rem;
                                       font-weight:600;letter-spacing:0.06em;">
                                {{ $order->status_label }}
                            </div>
                        </div>

                        {{-- Order Items --}}
                        @foreach($order->items as $item)
                        <div class="order-body" style="{{ !$loop->last ? 'border-bottom:1px solid rgba(201,168,76,0.15);padding-bottom:16px;margin-bottom:16px;' : '' }}">
                            <img src="{{ $item->product?->main_image ? Storage::url($item->product->main_image) : asset('./img/placeholder.png') }}"
                                alt="{{ $item->product_name }}"
                                class="order-img">

                            <div class="order-details">
                                <h4 class="order-name">{{ $item->product_name }}</h4>
                                <p class="order-meta">
                                    @if($item->size) Size: {{ $item->size }} @endif
                                    @if($item->size && $item->color) | @endif
                                    @if($item->color) Finish: {{ $item->color }} @endif
                                </p>
                                <p class="order-meta">Qty: {{ $item->quantity }}</p>
                                <p class="order-price">₹ {{ number_format($item->subtotal, 2) }}</p>
                            </div>

                            <div class="order-actions">
                                @if($order->status === 'delivered')
                                <a href="{{ route('customer.orders.invoice', $order->id) }}"
                                    class="btn-primary"
                                    style="padding:8px 16px;font-size:0.85rem;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                                    <i class="fas fa-file-invoice"></i> Invoice
                                </a>
                                @elseif(in_array($order->status, ['shipped', 'processing', 'confirmed']))
                                <a href="https://wa.me/919876543210?text={{ urlencode('Hello! I want to track my order #' . $order->order_number) }}"
                                    target="_blank"
                                    class="btn-primary"
                                    style="padding:8px 16px;font-size:0.85rem;text-decoration:none;display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,#25D366,#128C7E);">
                                    <i class="fas fa-truck"></i> Track Order
                                </a>
                                @elseif($order->status === 'pending')
                                <span style="font-family:'Crimson Pro',serif;font-size:0.85rem;
                                        color:var(--text-light);font-style:italic;">
                                    Awaiting confirmation...
                                </span>
                                @elseif($order->status === 'cancelled')
                                <span style="font-family:'Crimson Pro',serif;font-size:0.85rem;color:#e74c3c;">
                                    <i class="fas fa-times-circle"></i> Cancelled
                                </span>
                                @endif
                            </div>
                        </div>
                        @endforeach

                        {{-- Order Footer --}}
                        <div style="display:flex;justify-content:space-between;align-items:center;
                            padding-top:12px;border-top:1px solid rgba(201,168,76,0.15);
                            font-family:'Crimson Pro',serif;font-size:0.9rem;color:var(--text-mid);">
                            <span>
                                <i class="fas fa-map-marker-alt" style="color:var(--saffron);"></i>
                                {{ $order->shipping_city }}, {{ $order->shipping_state }} — {{ $order->pincode }}
                            </span>
                            <span style="font-weight:700;color:var(--maroon);font-size:1rem;">
                                Total: ₹ {{ number_format($order->total, 2) }}
                                <span style="font-size:0.78rem;font-weight:400;color:var(--text-light);">
                                    (incl. ₹{{ number_format($order->shipping_fees, 2) }} shipping)
                                </span>
                            </span>
                        </div>

                    </div>
                    @empty
                    <div style="text-align:center;padding:60px 20px;">
                        <i class="fas fa-box-open" style="font-size:3rem;color:var(--gold);opacity:0.4;"></i>
                        <p style="margin-top:16px;color:var(--text-light);
                            font-family:'Crimson Pro',serif;font-size:1.1rem;">
                            You have no orders yet.
                        </p>
                        <a href="{{ route('customer.product.all') }}" class="btn-primary"
                            style="margin-top:16px;display:inline-flex;align-items:center;gap:8px;text-decoration:none;">
                            <i class="fas fa-store"></i> Browse Products
                        </a>
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

@endsection