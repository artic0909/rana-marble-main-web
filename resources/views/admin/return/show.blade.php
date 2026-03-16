@extends('admin.layout.app')

@section('title', 'Return #R1029')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.returns.index') }}" class="btn btn-sm btn-outline-custom"><i class="bi bi-arrow-left"></i></a>
        <div>
            <h1 class="page-title mb-0">Return #R1029</h1>
            <p class="page-subtitle mb-0">Order #4510 &nbsp;·&nbsp; Requested Jan 16, 2025 at 3:45 PM</p>
        </div>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <button class="btn btn-sm" style="background:#dcfce7;color:#16a34a;border-radius:8px;padding:5px 14px;border:none;font-size:13px;font-weight:500">
            <i class="bi bi-check-lg me-1"></i>Approve Return
        </button>
        <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:8px;padding:5px 14px;border:none;font-size:13px;font-weight:500">
            <i class="bi bi-x-lg me-1"></i>Deny Return
        </button>
    </div>
</div>

<div class="row g-3">

    <!-- ── LEFT ─────────────────────────────────────────── -->
    <div class="col-12 col-lg-8">

        <!-- Returned Item -->
        <div class="card mb-3">
            <div class="card-body p-0">
                <div class="px-3 py-3 border-bottom">
                    <h6 class="card-title-sm mb-0">Returned Item</h6>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-custom mb-0">
                        <thead style="background:var(--surface2)">
                            <tr>
                                <th style="padding-left:16px">Product</th>
                                <th>Variant</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Refund</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding-left:16px">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:48px;height:48px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:var(--surface2);flex-shrink:0">
                                            <img src="https://placehold.co/100/f1f5f9/94a3b8?text=P" style="width:100%;height:100%;object-fit:cover">
                                        </div>
                                        <div>
                                            <div style="font-weight:600;font-size:13px">Slim Fit Polo Shirt</div>
                                            <div style="font-size:11px;color:var(--text-muted)">SKU: SFP-088</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <span style="font-size:11px;font-weight:600;padding:2px 7px;border-radius:5px;background:var(--surface2);border:1.5px solid var(--border)">XL</span>
                                        <span class="d-flex align-items-center gap-1" style="font-size:12px">
                                            <span style="width:11px;height:11px;border-radius:50%;background:#3b82f6;display:inline-block;border:1.5px solid var(--border)"></span> Blue
                                        </span>
                                    </div>
                                </td>
                                <td style="font-size:13px">$54.99</td>
                                <td style="font-size:13px">1</td>
                                <td style="font-weight:700;font-size:13px;color:var(--primary)">$54.99</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Refund breakdown -->
                <div class="px-3 py-3 border-top">
                    <div class="ms-auto" style="max-width:280px">
                        <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                            <span style="color:var(--text-muted)">Item Total</span>
                            <span>$54.99</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                            <span style="color:var(--text-muted)">Restocking Fee</span>
                            <span style="color:#dc2626">- $0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                            <span style="color:var(--text-muted)">Return Shipping</span>
                            <span style="color:#dc2626">- $0.00</span>
                        </div>
                        <hr style="border-color:var(--border);margin:8px 0">
                        <div class="d-flex justify-content-between" style="font-size:15px;font-weight:800">
                            <span>Refund Total</span>
                            <span style="color:var(--primary)">$54.99</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Return Reason & Evidence -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Return Reason & Evidence</h6>

                <div class="mb-3 p-3 rounded-3" style="background:var(--surface2);border:1.5px solid var(--border)">
                    <p style="font-size:12px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Reason</p>
                    <p style="font-size:13px;font-weight:700;margin:0">Wrong size received</p>
                </div>

                <div class="mb-3">
                    <p style="font-size:12px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">Customer Message</p>
                    <p style="font-size:13px;line-height:1.7;color:var(--text-secondary);margin:0">
                        I ordered size L but received size XL. The tag clearly says XL and the shirt is too big. I would like to return it and get the correct size or a full refund.
                    </p>
                </div>

                <div>
                    <p style="font-size:12px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px">Attached Photos</p>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach([1,2,3] as $img)
                        <div style="width:90px;height:90px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:var(--surface2);cursor:pointer">
                            <img src="https://placehold.co/180/f1f5f9/94a3b8?text=Photo+{{ $img }}"
                                style="width:100%;height:100%;object-fit:cover;display:block">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Return Timeline -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-4">Return Timeline</h6>
                <div style="position:relative">

                    @php
                    $timeline = [
                    ['icon'=>'bi-hourglass-split', 'color'=>'#f59e0b', 'bg'=>'#fef9c3', 'label'=>'Awaiting Review', 'time'=>'Jan 16, 2025 · 3:45 PM', 'note'=>'Return request submitted by customer.'],
                    ['icon'=>'bi-envelope-open', 'color'=>'#1d4ed8', 'bg'=>'#dbeafe', 'label'=>'Confirmation Sent', 'time'=>'Jan 16, 2025 · 3:46 PM', 'note'=>'Auto-confirmation email sent to anna.lee@email.com.'],
                    ['icon'=>'bi-truck', 'color'=>'#4338ca', 'bg'=>'#ede9fe', 'label'=>'Return Label Issued', 'time'=>'Jan 17, 2025 · 9:00 AM', 'note'=>'Return shipping label sent to customer.'],
                    ];
                    @endphp

                    @foreach($timeline as $step)
                    <div class="d-flex gap-3" style="{{ !$loop->last ? 'padding-bottom:24px' : '' }};position:relative">
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

        <!-- Admin Note -->
        <div class="card">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Internal Note</h6>
                <textarea class="form-control" rows="3" placeholder="Add a private note about this return…" style="font-size:13px"></textarea>
                <button class="btn btn-sm btn-primary-custom mt-2">Save Note</button>
            </div>
        </div>

    </div>

    <!-- ── RIGHT ─────────────────────────────────────────── -->
    <div class="col-12 col-lg-4">

        <!-- Return Status -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Return Status</h6>
                <div class="mb-3">
                    <span class="badge-status badge-pending" style="font-size:13px;padding:5px 14px">Pending Review</span>
                </div>
                <label class="form-label-custom">Update Status</label>
                <select class="form-select form-select-sm mb-2">
                    <option selected>Pending Review</option>
                    <option>Approved</option>
                    <option>Item in Transit</option>
                    <option>Item Received</option>
                    <option>Refund Issued</option>
                    <option>Denied</option>
                    <option>Closed</option>
                </select>
                <button class="btn btn-sm btn-primary-custom w-100">Update Status</button>
            </div>
        </div>

        <!-- Refund Action -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Issue Refund</h6>
                <div class="mb-3">
                    <label class="form-label-custom">Refund Method</label>
                    <select class="form-select form-select-sm">
                        <option>Original Payment Method</option>
                        <option>Store Credit</option>
                        <option>Bank Transfer</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label-custom">Refund Amount ($)</label>
                    <input type="number" class="form-control form-control-sm" value="54.99">
                </div>
                <div class="mb-3">
                    <label class="form-label-custom">Refund Note (optional)</label>
                    <input type="text" class="form-control form-control-sm" placeholder="e.g. Wrong size sent by warehouse">
                </div>
                <button class="btn btn-sm w-100" style="background:#16a34a;color:#fff;border-radius:8px;font-size:13px;font-weight:600;padding:7px">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Process Refund
                </button>
            </div>
        </div>

        <!-- Customer -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Customer</h6>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div style="width:42px;height:42px;font-size:15px;background:#f3e8ff;color:#7c3aed;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0">AL</div>
                    <div>
                        <div style="font-weight:700;font-size:14px">Anna Lee</div>
                        <div style="font-size:12px;color:var(--text-muted)">anna.lee@email.com</div>
                    </div>
                </div>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Phone</span>
                        <span style="font-weight:600">+1 (555) 987-6543</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Past Returns</span>
                        <span style="font-weight:600">2 returns</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Total Orders</span>
                        <span style="font-weight:600">9 orders</span>
                    </div>
                </div>
                <a href="#" class="btn btn-sm btn-outline-custom w-100 mt-3" style="font-size:12px">
                    <i class="bi bi-person me-1"></i>View Customer Profile
                </a>
            </div>
        </div>

        <!-- Linked Order -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Linked Order</h6>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Order ID</span>
                        <span style="font-weight:700">#4510</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Order Date</span>
                        <span style="font-weight:600">Jan 10, 2025</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Order Total</span>
                        <span style="font-weight:600">$54.99</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Payment</span>
                        <span style="font-weight:600">💳 Card</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Order Status</span>
                        <span class="badge-status badge-delivered" style="font-size:11px">Delivered</span>
                    </div>
                </div>
                <a href="#" class="btn btn-sm btn-outline-custom w-100 mt-3" style="font-size:12px">
                    <i class="bi bi-bag me-1"></i>View Full Order
                </a>
            </div>
        </div>

        <!-- Return Shipping -->
        <div class="card">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Return Shipping</h6>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Carrier</span>
                        <span style="font-weight:600">FedEx</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Tracking #</span>
                        <span style="font-weight:600;font-family:monospace;font-size:11px">FX00192837465</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Label Issued</span>
                        <span style="font-weight:600">Jan 17, 2025</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Item Status</span>
                        <span class="badge-status badge-processing" style="font-size:11px">In Transit</span>
                    </div>
                </div>
                <a href="#" class="btn btn-sm btn-outline-custom w-100 mt-3" style="font-size:12px">
                    <i class="bi bi-geo-alt me-1"></i>Track Shipment
                </a>
            </div>
        </div>

    </div>
</div>

@endsection