@extends('admin.layout.app')

@section('title', 'Customer – Sarah Chen')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-outline-custom"><i class="bi bi-arrow-left"></i></a>
        <div>
            <h1 class="page-title mb-0">Sarah Chen</h1>
            <p class="page-subtitle mb-0">Customer since Jan 2024 &nbsp;·&nbsp; VIP</p>
        </div>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <button class="btn btn-sm btn-outline-custom"><i class="bi bi-envelope me-1"></i>Send Email</button>
        <button class="btn btn-sm btn-outline-custom"><i class="bi bi-pencil me-1"></i>Edit</button>
        <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:8px;padding:5px 14px;border:none;font-size:13px;font-weight:500">
            <i class="bi bi-slash-circle me-1"></i>Suspend
        </button>
    </div>
</div>

<div class="row g-3">

    <!-- ── LEFT ─────────────────────────────────────────── -->
    <div class="col-12 col-lg-8">

        <!-- Stats Row -->
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="value">14</div>
                    <div class="label">Total Orders</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="value">$2,140</div>
                    <div class="label">Total Spent</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="value">$152.86</div>
                    <div class="label">Avg. Order</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="value">2</div>
                    <div class="label">Returns</div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="card mb-3">
            <div class="card-body p-0">
                <div class="px-3 py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="card-title-sm mb-0">Recent Orders</h6>
                    <a href="#" style="font-size:12px;color:var(--primary);font-weight:600;text-decoration:none">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-custom table-hover mb-0">
                        <thead style="background:var(--surface2)">
                            <tr>
                                <th style="padding-left:16px">Order ID</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $orders = [
                                ['id'=>'#4521','date'=>'Jan 14, 2025','items'=>2,'total'=>'$149.00','pay'=>'💳 Card',  'status'=>'Processing','badge'=>'badge-processing'],
                                ['id'=>'#4488','date'=>'Dec 28, 2024','items'=>1,'total'=>'$89.00', 'pay'=>'💳 Card',  'status'=>'Delivered', 'badge'=>'badge-delivered'],
                                ['id'=>'#4462','date'=>'Dec 10, 2024','items'=>3,'total'=>'$312.00','pay'=>'🅿️ PayPal','status'=>'Delivered', 'badge'=>'badge-delivered'],
                                ['id'=>'#4401','date'=>'Nov 22, 2024','items'=>1,'total'=>'$54.99', 'pay'=>'💳 Card',  'status'=>'Delivered', 'badge'=>'badge-delivered'],
                                ['id'=>'#4380','date'=>'Nov 05, 2024','items'=>2,'total'=>'$198.00','pay'=>'💳 Card',  'status'=>'Cancelled', 'badge'=>'badge-cancelled'],
                            ];
                            @endphp
                            @foreach($orders as $o)
                            <tr>
                                <td style="padding-left:16px"><strong>{{ $o['id'] }}</strong></td>
                                <td style="font-size:12px">{{ $o['date'] }}</td>
                                <td style="font-size:13px">{{ $o['items'] }}</td>
                                <td style="font-weight:700;font-size:13px">{{ $o['total'] }}</td>
                                <td style="font-size:12px">{{ $o['pay'] }}</td>
                                <td><span class="badge-status {{ $o['badge'] }}">{{ $o['status'] }}</span></td>
                                <td><a href="#" class="btn btn-sm btn-outline-custom" style="font-size:11px;padding:3px 10px">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Return History -->
        <div class="card mb-3">
            <div class="card-body p-0">
                <div class="px-3 py-3 border-bottom">
                    <h6 class="card-title-sm mb-0">Return History</h6>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-custom table-hover mb-0">
                        <thead style="background:var(--surface2)">
                            <tr>
                                <th style="padding-left:16px">Return ID</th>
                                <th>Order</th>
                                <th>Reason</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding-left:16px"><strong>#R1021</strong></td>
                                <td>#4380</td>
                                <td style="font-size:12px">Wrong size received</td>
                                <td style="font-weight:700">$54.99</td>
                                <td><span class="badge-status badge-delivered">Refunded</span></td>
                                <td><a href="#" class="btn btn-sm btn-outline-custom" style="font-size:11px;padding:3px 10px">View</a></td>
                            </tr>
                            <tr>
                                <td style="padding-left:16px"><strong>#R0998</strong></td>
                                <td>#4310</td>
                                <td style="font-size:12px">Defective item</td>
                                <td style="font-weight:700">$89.00</td>
                                <td><span class="badge-status badge-delivered">Refunded</span></td>
                                <td><a href="#" class="btn btn-sm btn-outline-custom" style="font-size:11px;padding:3px 10px">View</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Activity Log -->
        <div class="card">
            <div class="card-body">
                <h6 class="card-title-sm mb-4">Recent Activity</h6>
                <div style="position:relative">
                    @php
                    $activities = [
                        ['icon'=>'bi-bag-check',        'color'=>'#16a34a','bg'=>'#dcfce7','label'=>'Placed Order #4521',           'time'=>'Jan 14, 2025 · 10:32 AM'],
                        ['icon'=>'bi-arrow-counterclockwise','color'=>'#f59e0b','bg'=>'#fef9c3','label'=>'Return #R1021 Approved',   'time'=>'Dec 30, 2024 · 2:15 PM'],
                        ['icon'=>'bi-bag-check',        'color'=>'#16a34a','bg'=>'#dcfce7','label'=>'Placed Order #4488',           'time'=>'Dec 28, 2024 · 9:50 AM'],
                        ['icon'=>'bi-pencil-square',    'color'=>'#1d4ed8','bg'=>'#dbeafe','label'=>'Updated shipping address',     'time'=>'Dec 20, 2024 · 4:00 PM'],
                        ['icon'=>'bi-person-check',     'color'=>'#7c3aed','bg'=>'#f3e8ff','label'=>'Account verified',            'time'=>'Jan 5, 2024 · 11:22 AM'],
                    ];
                    @endphp
                    @foreach($activities as $a)
                    <div class="d-flex gap-3" style="{{ !$loop->last ? 'padding-bottom:20px' : '' }};position:relative">
                        @if(!$loop->last)
                        <div style="position:absolute;left:17px;top:36px;width:2px;bottom:0;background:var(--border)"></div>
                        @endif
                        <div style="width:36px;height:36px;border-radius:50%;background:{{ $a['bg'] }};color:{{ $a['color'] }};display:flex;align-items:center;justify-content:center;flex-shrink:0;z-index:1">
                            <i class="bi {{ $a['icon'] }}" style="font-size:14px"></i>
                        </div>
                        <div style="padding-top:7px">
                            <div style="font-size:13px;font-weight:600">{{ $a['label'] }}</div>
                            <div style="font-size:11px;color:var(--text-muted);margin-top:2px">{{ $a['time'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <!-- ── RIGHT ─────────────────────────────────────────── -->
    <div class="col-12 col-lg-4">

        <!-- Profile -->
        <div class="card mb-3">
            <div class="card-body text-center" style="padding-top:28px">
                <div style="width:64px;height:64px;border-radius:50%;background:var(--primary-light);color:var(--primary);font-size:24px;font-weight:800;display:flex;align-items:center;justify-content:center;margin:0 auto 12px">SC</div>
                <div style="font-size:16px;font-weight:800">Sarah Chen</div>
                <div style="font-size:12px;color:var(--text-muted);margin-bottom:10px">sarah.chen@email.com</div>
                <span class="badge-status badge-new" style="font-size:12px;padding:4px 14px">⭐ VIP Customer</span>
            </div>
            <div class="card-body border-top pt-3">
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Phone</span>
                        <span style="font-weight:600">+1 (555) 012-3456</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Gender</span>
                        <span style="font-weight:600">Female</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Date of Birth</span>
                        <span style="font-weight:600">Mar 12, 1992</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Joined</span>
                        <span style="font-weight:600">Jan 5, 2024</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Last Login</span>
                        <span style="font-weight:600">Jan 14, 2025</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Account Status</span>
                        <span class="badge-status badge-active" style="font-size:11px">Active</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="card-title-sm mb-0">Shipping Address</h6>
                    <button class="btn btn-sm btn-outline-custom" style="font-size:11px;padding:3px 10px">Edit</button>
                </div>
                <address style="font-size:13px;line-height:1.9;color:var(--text-secondary);margin:0">
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
                <address style="font-size:13px;line-height:1.9;color:var(--text-secondary);margin:0">
                    <strong style="color:var(--text-primary)">Sarah Chen</strong><br>
                    42 Maple Street, Apt 3B<br>
                    San Francisco, CA 94102<br>
                    United States
                </address>
            </div>
        </div>

        <!-- Preferences -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Preferences</h6>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between align-items-center" style="font-size:12px">
                        <span style="color:var(--text-muted)">Email Notifications</span>
                        <span style="font-weight:600;color:#16a34a">Enabled</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center" style="font-size:12px">
                        <span style="color:var(--text-muted)">SMS Notifications</span>
                        <span style="font-weight:600;color:#dc2626">Disabled</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center" style="font-size:12px">
                        <span style="color:var(--text-muted)">Marketing Emails</span>
                        <span style="font-weight:600;color:#16a34a">Enabled</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center" style="font-size:12px">
                        <span style="color:var(--text-muted)">Newsletter</span>
                        <span style="font-weight:600;color:#16a34a">Subscribed</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Internal Note -->
        <div class="card">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Internal Note</h6>
                <textarea class="form-control" rows="3" style="font-size:13px" placeholder="Add a private note about this customer…">VIP customer — handle returns with priority. Prefers email communication.</textarea>
                <button class="btn btn-sm btn-primary-custom mt-2">Save Note</button>
            </div>
        </div>

    </div>
</div>

@endsection