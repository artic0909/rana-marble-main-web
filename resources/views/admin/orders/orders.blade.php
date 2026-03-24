@extends('admin.layout.app')

@section('title', 'Orders')

@section('content')

<section class="page-section active" id="page-orders">

    {{-- ── Header ── --}}
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Orders</h1>
            <p class="page-subtitle">Manage and track all customer orders.</p>
        </div>
        <a href="{{ route('admin.orders.index', ['export' => 1]) }}"
           class="btn btn-sm btn-outline-custom">
            <i class="bi bi-download me-1"></i>Export Orders
        </a>
    </div>

    {{-- ── Flash ── --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="border-radius:10px;font-size:13px;">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- ── Status Summary Tabs ── --}}
    @php
    $tabs = [
        'all'        => ['label' => 'All',        'color' => 'var(--primary)', 'count' => $counts['all']],
        'pending'    => ['label' => 'Pending',     'color' => '#f59e0b',        'count' => $counts['pending']],
        'processing' => ['label' => 'Processing',  'color' => '#1d4ed8',        'count' => $counts['processing']],
        'shipped'    => ['label' => 'Shipped',     'color' => '#4338ca',        'count' => $counts['shipped']],
        'delivered'  => ['label' => 'Delivered',   'color' => '#16a34a',        'count' => $counts['delivered']],
        'cancelled'  => ['label' => 'Cancelled',   'color' => '#dc2626',        'count' => $counts['cancelled']],
    ];
    $activeStatus = request('status', 'all');
    @endphp

    <div class="row g-2 mb-3">
        @foreach ($tabs as $key => $tab)
        <div class="col-6 col-md-2">
            <a href="{{ route('admin.orders.index', array_merge(request()->except('status','page'), $key !== 'all' ? ['status' => $key] : [])) }}"
               style="text-decoration:none;">
                <div class="p-2 rounded-3 text-center {{ $activeStatus === $key ? '' : 'card' }}"
                     style="{{ $activeStatus === $key ? 'border:2px solid var(--primary);background:var(--primary-light)' : '' }}">
                    <div style="font-size:18px;font-weight:800;color:{{ $tab['color'] }};font-family:'Syne',sans-serif">
                        {{ $tab['count'] }}
                    </div>
                    <div style="font-size:11px;color:var(--text-muted)">{{ $tab['label'] }}</div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{-- ── Table Card ── --}}
    <div class="card">
        <div class="card-body p-0">

            {{-- Filters --}}
            <form method="GET" action="{{ route('admin.orders.index') }}"
                  class="px-3 py-3 border-bottom d-flex gap-2 flex-wrap">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <div class="topbar-search flex-1" style="max-width:300px;position:relative;">
                    <i class="bi bi-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:13px;"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search orders or customer…"
                           style="width:100%;border-radius:10px;padding:8px 14px 8px 32px;border:1.5px solid var(--border);font-size:13px;outline:none;background:transparent;">
                </div>
                <input type="date" name="date" value="{{ request('date') }}"
                       class="form-control" style="width:auto;font-size:13px">
                <button type="submit" class="btn btn-sm btn-primary-custom">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
                @if(request()->hasAny(['search','date','status']))
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-custom">
                    <i class="bi bi-x me-1"></i>Clear
                </a>
                @endif
            </form>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="table table-custom table-hover mb-0">
                    <thead style="background:var(--surface2)">
                        <tr>
                            <th style="padding-left:16px">Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td style="padding-left:16px">
                                <strong>#{{ $order->order_number }}</strong>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm"
                                         style="background:var(--primary-light);color:var(--primary);font-size:12px;
                                                display:flex;align-items:center;justify-content:center;
                                                width:32px;height:32px;border-radius:50%;font-weight:700;flex-shrink:0;">
                                        {{ strtoupper(substr($order->customer?->name ?? 'G', 0, 2)) }}
                                    </div>
                                    {{ $order->customer?->name ?? 'Guest' }}
                                </div>
                            </td>
                            <td style="font-size:12px">{{ $order->created_at->format('M d, Y') }}</td>
                            <td>{{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}</td>
                            <td><strong>₹{{ number_format($order->total, 2) }}</strong></td>
                            <td>
                                <span class="badge-status">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="btn btn-sm btn-outline-custom"
                                   style="font-size:11px;padding:3px 10px">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4" style="color:var(--text-muted);font-size:13px;">
                                No orders found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center px-3 py-3 border-top flex-wrap gap-2">
                <span style="font-size:13px;color:var(--text-muted)">
                    Showing {{ $orders->firstItem() }}–{{ $orders->lastItem() }} of {{ $orders->total() }} orders
                </span>
                {{ $orders->links() }}
            </div>

        </div>
    </div>
</section>

@endsection