@extends('admin.layout.app')

@section('title', 'Order #4521')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div class="d-flex align-items-center gap-2">
        <a href="#" class="btn btn-sm btn-outline-custom"><i class="bi bi-arrow-left"></i></a>
        <div>
            <h1 class="page-title mb-0">Order #4521</h1>
            <p class="page-subtitle mb-0">Placed on Jan 14, 2025 at 10:32 AM</p>
        </div>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <button class="btn btn-sm btn-outline-custom"><i class="bi bi-printer me-1"></i>Print Invoice</button>
        <button class="btn btn-sm btn-outline-custom"><i class="bi bi-download me-1"></i>Download PDF</button>
        <button class="btn btn-sm btn-primary-custom"><i class="bi bi-pencil me-1"></i>Edit Order</button>
    </div>
</div>

<div class="row g-3">

    <!-- ── LEFT ─────────────────────────────────────────── -->
    <div class="col-12 col-lg-8">

        <!-- Order Items -->
        <div class="card mb-3">
            <div class="card-body p-0">
                <div class="px-3 py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="card-title-sm mb-0">Order Items</h6>
                    <span style="font-size:12px;color:var(--text-muted)">2 items</span>
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
                            <tr>
                                <td style="padding-left:16px">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:48px;height:48px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:var(--surface2);flex-shrink:0">
                                            <img src="https://placehold.co/100/f1f5f9/94a3b8?text=P1" style="width:100%;height:100%;object-fit:cover">
                                        </div>
                                        <div>
                                            <div style="font-weight:600;font-size:13px">iPhone 15 Case Pro</div>
                                            <div style="font-size:11px;color:var(--text-muted)">SKU: IP15-001</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <span style="font-size:11px;font-weight:600;padding:2px 7px;border-radius:5px;background:var(--surface2);border:1.5px solid var(--border)">M</span>
                                        <span class="d-flex align-items-center gap-1" style="font-size:12px">
                                            <span style="width:11px;height:11px;border-radius:50%;background:black;display:inline-block;border:1.5px solid var(--border)"></span> Black
                                        </span>
                                    </div>
                                </td>
                                <td style="font-size:13px">$24.99</td>
                                <td style="font-size:13px">2</td>
                                <td style="font-weight:700;font-size:13px">$49.98</td>
                            </tr>
                            <tr>
                                <td style="padding-left:16px">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:48px;height:48px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:var(--surface2);flex-shrink:0">
                                            <img src="https://placehold.co/100/f1f5f9/94a3b8?text=P2" style="width:100%;height:100%;object-fit:cover">
                                        </div>
                                        <div>
                                            <div style="font-weight:600;font-size:13px">Wireless Charging Pad</div>
                                            <div style="font-size:11px;color:var(--text-muted)">SKU: WCP-202</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="font-size:12px;color:var(--text-muted)">One Size / White</span>
                                </td>
                                <td style="font-size:13px">$99.02</td>
                                <td style="font-size:13px">1</td>
                                <td style="font-weight:700;font-size:13px">$99.02</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="px-3 py-3 border-top">
                    <div class="ms-auto" style="max-width:280px">
                        <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                            <span style="color:var(--text-muted)">Subtotal</span>
                            <span>$148.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                            <span style="color:var(--text-muted)">Shipping</span>
                            <span style="color:#16a34a;font-weight:600">Free</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                            <span style="color:var(--text-muted)">Discount</span>
                            <span style="color:#dc2626">- $0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                            <span style="color:var(--text-muted)">Tax (GST 7%)</span>
                            <span>$1.00</span>
                        </div>
                        <hr style="border-color:var(--border);margin:8px 0">
                        <div class="d-flex justify-content-between" style="font-size:15px;font-weight:800">
                            <span>Total</span>
                            <span style="color:var(--primary)">$149.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Timeline -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-4">Order Timeline</h6>
                <div class="d-flex flex-column gap-0" style="position:relative">

                    @php
                    $timeline = [
                    ['icon'=>'bi-check-circle-fill', 'color'=>'#16a34a', 'bg'=>'#dcfce7', 'label'=>'Order Delivered', 'time'=>'Jan 16, 2025 · 2:14 PM', 'note'=>'Package delivered to customer.', 'done'=>true],
                    ['icon'=>'bi-truck', 'color'=>'#4338ca', 'bg'=>'#ede9fe', 'label'=>'Order Shipped', 'time'=>'Jan 15, 2025 · 9:00 AM', 'note'=>'Shipped via FedEx · Tracking: FX928374651', 'done'=>true],
                    ['icon'=>'bi-gear-fill', 'color'=>'#1d4ed8', 'bg'=>'#dbeafe', 'label'=>'Processing', 'time'=>'Jan 14, 2025 · 11:05 AM','note'=>'Order confirmed and being prepared.', 'done'=>true],
                    ['icon'=>'bi-bag-check-fill', 'color'=>'#f59e0b', 'bg'=>'#fef9c3', 'label'=>'Order Placed', 'time'=>'Jan 14, 2025 · 10:32 AM','note'=>'Customer placed the order successfully.', 'done'=>true],
                    ];
                    @endphp

                    @foreach($timeline as $i => $step)
                    <div class="d-flex gap-3" style="position:relative;{{ !$loop->last ? 'padding-bottom:24px' : '' }}">
                        @if(!$loop->last)
                        <div style="position:absolute;left:17px;top:36px;width:2px;bottom:0;background:var(--border)"></div>
                        @endif
                        <div style="width:36px;height:36px;border-radius:50%;background:{{ $step['bg'] }};color:{{ $step['color'] }};display:flex;align-items:center;justify-content:center;flex-shrink:0;z-index:1">
                            <i class="bi {{ $step['icon'] }}" style="font-size:15px"></i>
                        </div>
                        <div style="padding-top:6px">
                            <div style="font-size:13px;font-weight:700">{{ $step['label'] }}</div>
                            <div style="font-size:11px;color:var(--text-muted);margin:2px 0 3px">{{ $step['time'] }}</div>
                            <div style="font-size:12px;color:var(--text-secondary)">{{ $step['note'] }}</div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

        <!-- Note -->
        <!-- <div class="card">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Order Note</h6>
                <textarea class="form-control" rows="3" placeholder="Add an internal note about this order…" style="font-size:13px"></textarea>
                <button class="btn btn-sm btn-primary-custom mt-2">Save Note</button>
            </div>
        </div> -->

    </div>

    <!-- ── RIGHT ─────────────────────────────────────────── -->
    <div class="col-12 col-lg-4">

        <!-- Order Status -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Order Status</h6>
                <div class="mb-3">
                    <span class="badge-status badge-processing" style="font-size:13px;padding:5px 14px">Processing</span>
                </div>
                <label class="form-label-custom">Update Status</label>
                <select class="form-select form-select-sm mb-2">
                    <option>Pending</option>
                    <option selected>Processing</option>
                    <option>Shipped</option>
                    <option>Delivered</option>
                    <option>Cancelled</option>
                </select>
                <button class="btn btn-sm btn-primary-custom w-100">Update Status</button>
            </div>
        </div>

        <!-- Customer -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Customer</h6>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="avatar-sm" style="width:42px;height:42px;font-size:15px;background:var(--primary-light);color:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0">SC</div>
                    <div>
                        <div style="font-weight:700;font-size:14px">Sarah Chen</div>
                        <div style="font-size:12px;color:var(--text-muted)">sarah.chen@email.com</div>
                    </div>
                </div>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Phone</span>
                        <span style="font-weight:600">+1 (555) 012-3456</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Total Orders</span>
                        <span style="font-weight:600">14 orders</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Total Spent</span>
                        <span style="font-weight:600">$1,842.00</span>
                    </div>
                </div>
                <a href="#" class="btn btn-sm btn-outline-custom w-100 mt-3" style="font-size:12px">
                    <i class="bi bi-person me-1"></i>View Customer Profile
                </a>
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Shipping Address</h6>
                <address style="font-size:13px;line-height:1.8;color:var(--text-secondary);margin:0">
                    <strong style="color:var(--text-primary)">Sarah Chen</strong><br>
                    42 Maple Street, Apt 3B<br>
                    San Francisco, CA 94102<br>
                    United States<br>
                    <span style="color:var(--text-muted)">+1 (555) 012-3456</span>
                </address>
            </div>
        </div>

        <!-- Billing Address -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="card-title-sm mb-0">Billing Address</h6>
                    <span style="font-size:11px;padding:2px 8px;border-radius:20px;background:#dcfce7;color:#15803d;font-weight:600">Same as shipping</span>
                </div>
                <address style="font-size:13px;line-height:1.8;color:var(--text-secondary);margin:0">
                    <strong style="color:var(--text-primary)">Sarah Chen</strong><br>
                    42 Maple Street, Apt 3B<br>
                    San Francisco, CA 94102<br>
                    United States
                </address>
            </div>
        </div>

        <!-- Payment -->
        <!-- <div class="card">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Payment</h6>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Method</span>
                        <span style="font-weight:600">💳 Credit Card</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Card</span>
                        <span style="font-weight:600;font-family:monospace">•••• •••• •••• 4242</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Transaction ID</span>
                        <span style="font-weight:600;font-family:monospace;font-size:11px">TXN-8827364</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Payment Status</span>
                        <span class="badge-status badge-active" style="font-size:11px">Paid</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Paid On</span>
                        <span style="font-weight:600">Jan 14, 2025</span>
                    </div>
                </div>
            </div>
        </div> -->

    </div>
</div>

@endsection