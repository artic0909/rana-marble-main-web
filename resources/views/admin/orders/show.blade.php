@extends('admin.layout.app')

@section('title', 'Order #' . $order->order_number)

@section('content')

{{-- ── Header ── --}}
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h1 class="page-title mb-0">Order #{{ $order->order_number }}</h1>
            <p class="page-subtitle mb-0">Placed on {{ $order->created_at->format('M d, Y') }} at {{ $order->created_at->format('h:i A') }}</p>
        </div>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <button class="btn btn-sm btn-outline-custom" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Invoice
        </button>
    </div>
</div>

{{-- ── Flash ── --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="border-radius:10px;font-size:13px;">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-3">

    <!-- ── LEFT ── -->
    <div class="col-12 col-lg-8">

        <!-- Order Items -->
        <div class="card mb-3">
            <div class="card-body p-0">
                <div class="px-3 py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="card-title-sm mb-0">Order Items</h6>
                    <span style="font-size:12px;color:var(--text-muted)">
                        {{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-custom mb-0">
                        <thead style="background:var(--surface2)">
                            <tr>
                                <th style="padding-left:16px">Product</th>
                                <th>Variant</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                            <tr>
                                <td style="padding-left:16px">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:48px;height:48px;border-radius:8px;overflow:hidden;
                                                    border:1.5px solid var(--border);background:var(--surface2);flex-shrink:0">
                                            @if ($item->product_image)
                                            <img src="{{ Storage::url($item->product_image) }}"
                                                 style="width:100%;height:100%;object-fit:cover">
                                            @else
                                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--text-muted);">
                                                <i class="bi bi-image"></i>
                                            </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div style="font-weight:600;font-size:13px">{{ $item->product_name }}</div>
                                            <div style="font-size:11px;color:var(--text-muted)">SKU: {{ $item->sku ?? '—' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-1 flex-wrap">
                                        @if ($item->size)
                                        <span style="font-size:11px;font-weight:600;padding:2px 7px;border-radius:5px;
                                                     background:var(--surface2);border:1.5px solid var(--border)">
                                            {{ $item->size }}
                                        </span>
                                        @endif
                                        @if ($item->color)
                                        <span style="font-size:12px">{{ $item->color }}</span>
                                        @endif
                                        @if (!$item->size && !$item->color)
                                        <span style="font-size:12px;color:var(--text-muted)">—</span>
                                        @endif
                                    </div>
                                </td>
                                <td style="font-size:13px">₹{{ number_format($item->price, 2) }}</td>
                                <td style="font-size:13px">{{ $item->quantity }}</td>
                                <td style="font-weight:700;font-size:13px">₹{{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="px-3 py-3 border-top">
                    <div class="ms-auto" style="max-width:280px">
                        <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                            <span style="color:var(--text-muted)">Subtotal</span>
                            <span>₹{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                            <span style="color:var(--text-muted)">Shipping</span>
                            @if ($order->shipping == 0)
                            <span style="color:#16a34a;font-weight:600">Free</span>
                            @else
                            <span>₹{{ number_format($order->shipping, 2) }}</span>
                            @endif
                        </div>
                        @if ($order->discount > 0)
                        <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                            <span style="color:var(--text-muted)">Discount</span>
                            <span style="color:#dc2626">- ₹{{ number_format($order->discount, 2) }}</span>
                        </div>
                        @endif
                        @if ($order->tax > 0)
                        <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                            <span style="color:var(--text-muted)">Tax</span>
                            <span>₹{{ number_format($order->tax, 2) }}</span>
                        </div>
                        @endif
                        <hr style="border-color:var(--border);margin:8px 0">
                        <div class="d-flex justify-content-between" style="font-size:15px;font-weight:800">
                            <span>Total</span>
                            <span style="color:var(--primary)">₹{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Timeline -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-4">Order Timeline</h6>
                @php
                $allStatuses = ['pending', 'processing', 'shipped', 'delivered'];
                $currentIndex = array_search($order->status, $allStatuses);
                $isCancelled  = $order->status === 'cancelled';

                $timelineMap = [
                    'pending'    => ['icon' => 'bi-bag-check-fill', 'color' => '#f59e0b', 'bg' => '#fef9c3', 'label' => 'Order Placed'],
                    'processing' => ['icon' => 'bi-gear-fill',      'color' => '#1d4ed8', 'bg' => '#dbeafe', 'label' => 'Processing'],
                    'shipped'    => ['icon' => 'bi-truck',           'color' => '#4338ca', 'bg' => '#ede9fe', 'label' => 'Order Shipped'],
                    'delivered'  => ['icon' => 'bi-check-circle-fill','color'=> '#16a34a', 'bg' => '#dcfce7', 'label' => 'Delivered'],
                    'cancelled'  => ['icon' => 'bi-x-circle-fill',   'color' => '#dc2626', 'bg' => '#fee2e2', 'label' => 'Cancelled'],
                ];

                $steps = $isCancelled
                    ? [array_merge($timelineMap['cancelled'], ['time' => $order->updated_at->format('M d, Y · h:i A')])]
                    : collect($allStatuses)
                        ->take($currentIndex + 1)
                        ->reverse()
                        ->map(fn($s, $i) => array_merge($timelineMap[$s], [
                            'time' => $i === 0
                                ? $order->updated_at->format('M d, Y · h:i A')
                                : $order->created_at->format('M d, Y · h:i A'),
                        ]))->values()->toArray();
                @endphp

                <div class="d-flex flex-column gap-0" style="position:relative">
                    @foreach ($steps as $step)
                    <div class="d-flex gap-3" style="position:relative;{{ !$loop->last ? 'padding-bottom:24px' : '' }}">
                        @if (!$loop->last)
                        <div style="position:absolute;left:17px;top:36px;width:2px;bottom:0;background:var(--border)"></div>
                        @endif
                        <div style="width:36px;height:36px;border-radius:50%;background:{{ $step['bg'] }};color:{{ $step['color'] }};
                                    display:flex;align-items:center;justify-content:center;flex-shrink:0;z-index:1">
                            <i class="bi {{ $step['icon'] }}" style="font-size:15px"></i>
                        </div>
                        <div style="padding-top:6px">
                            <div style="font-size:13px;font-weight:700">{{ $step['label'] }}</div>
                            <div style="font-size:11px;color:var(--text-muted);margin:2px 0 3px">{{ $step['time'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <!-- ── RIGHT ── -->
    <div class="col-12 col-lg-4">

        <!-- Order Status Update -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Order Status</h6>
                <div class="mb-3">
                    <span class="badge-status"
                          style="font-size:13px;padding:5px 14px">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
                    @csrf @method('PATCH')
                    <label class="form-label" style="font-size:12px;color:var(--text-muted);">Update Status</label>
                    <select name="status" class="form-select form-select-sm mb-2">
                        @foreach (['pending','processing','shipped','delivered','cancelled'] as $s)
                        <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary-custom w-100">
                        <i class="bi bi-arrow-repeat me-1"></i>Update Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Customer -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Customer</h6>
                @if ($order->customer)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div style="width:42px;height:42px;font-size:15px;background:var(--primary-light);color:var(--primary);
                                border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0">
                        {{ strtoupper(substr($order->customer->name, 0, 2)) }}
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:14px">{{ $order->customer->name }}</div>
                        <div style="font-size:12px;color:var(--text-muted)">{{ $order->customer->email }}</div>
                    </div>
                </div>
                <div class="d-flex flex-column gap-2">
                    @if ($order->customer->phone)
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Phone</span>
                        <span style="font-weight:600">{{ $order->customer->phone }}</span>
                    </div>
                    @endif
                </div>
                @else
                <p style="font-size:13px;color:var(--text-muted);">Guest Order</p>
                @endif
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Shipping Address</h6>
                <address style="font-size:13px;line-height:1.8;color:var(--text-secondary);margin:0">
                    <strong style="color:var(--text-primary)">{{ $order->shipping_name }}</strong><br>
                    {{ $order->shipping_address }}<br>
                    {{ implode(', ', array_filter([$order->shipping_city, $order->shipping_state, $order->shipping_pincode])) }}<br>
                    @if ($order->shipping_phone)
                    <span style="color:var(--text-muted)">{{ $order->shipping_phone }}</span>
                    @endif
                </address>
            </div>
        </div>

        <!-- Notes -->
        @if ($order->notes)
        <div class="card">
            <div class="card-body">
                <h6 class="card-title-sm mb-2">Order Notes</h6>
                <p style="font-size:13px;color:var(--text-muted);margin:0">{{ $order->notes }}</p>
            </div>
        </div>
        @endif

    </div>
</div>

@endsection