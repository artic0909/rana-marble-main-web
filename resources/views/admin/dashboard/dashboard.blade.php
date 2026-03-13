@extends('admin.layout.app')

@section('title', 'Admin Dashboard')

@section('content')

<!-- ══ 1. DASHBOARD ══ -->
<section class="page-section active" id="page-dashboard">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Welcome back, Admin! Here's what's happening today.</p>
        </div>
        <button class="btn btn-sm btn-primary-custom" onclick="navigate('reports')"><i
                class="bi bi-download me-1"></i>Export Report</button>
    </div>

    <!-- Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="icon-wrap" style="background:#fff3ee;color:var(--primary)"><i
                        class="bi bi-currency-dollar"></i></div>
                <div class="value">$48,250</div>
                <div class="label">Total Revenue</div>
                <span class="trend trend-up"><i class="bi bi-arrow-up-short"></i>+12.4%</span>
                <i class="bi bi-currency-dollar bg-icon"></i>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="icon-wrap" style="background:#dcfce7;color:#16a34a"><i class="bi bi-receipt"></i></div>
                <div class="value">1,284</div>
                <div class="label">Total Orders</div>
                <span class="trend trend-up"><i class="bi bi-arrow-up-short"></i>+8.7%</span>
                <i class="bi bi-receipt bg-icon"></i>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="icon-wrap" style="background:#dbeafe;color:#1d4ed8"><i class="bi bi-people"></i></div>
                <div class="value">9,741</div>
                <div class="label">Customers</div>
                <span class="trend trend-up"><i class="bi bi-arrow-up-short"></i>+5.2%</span>
                <i class="bi bi-people bg-icon"></i>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="icon-wrap" style="background:#fee2e2;color:#dc2626"><i class="bi bi-arrow-return-left"></i>
                </div>
                <div class="value">2.1%</div>
                <div class="label">Return Rate</div>
                <span class="trend trend-down"><i class="bi bi-arrow-down-short"></i>-0.3%</span>
                <i class="bi bi-arrow-return-left bg-icon"></i>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h6 class="card-title-sm">Revenue Overview</h6>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm"
                                style="background:var(--primary);color:#fff;border-radius:8px;font-size:12px;padding:4px 10px;">Monthly</button>
                            <button class="btn btn-sm btn-outline-custom"
                                style="font-size:12px;padding:4px 10px;">Weekly</button>
                        </div>
                    </div>
                    <div class="chart-area">
                        <div class="chart-bars w-100">
                            <div class="chart-bar" style="height:55%;background:linear-gradient(to top,var(--primary),#ff9a5c)"
                                title="Jan $26k"></div>
                            <div class="chart-bar" style="height:72%;background:linear-gradient(to top,var(--primary),#ff9a5c)"
                                title="Feb $34k"></div>
                            <div class="chart-bar" style="height:48%;background:linear-gradient(to top,var(--primary),#ff9a5c)"
                                title="Mar $23k"></div>
                            <div class="chart-bar" style="height:88%;background:linear-gradient(to top,var(--primary),#ff9a5c)"
                                title="Apr $42k"></div>
                            <div class="chart-bar" style="height:65%;background:linear-gradient(to top,var(--primary),#ff9a5c)"
                                title="May $31k"></div>
                            <div class="chart-bar" style="height:80%;background:linear-gradient(to top,var(--primary),#ff9a5c)"
                                title="Jun $38k"></div>
                            <div class="chart-bar" style="height:95%;background:linear-gradient(to top,var(--primary),#ff9a5c)"
                                title="Jul $48k"></div>
                            <div class="chart-bar" style="height:70%;background:rgba(255,107,43,.2)" title="Aug $33k"></div>
                            <div class="chart-bar" style="height:60%;background:rgba(255,107,43,.2)" title="Sep $29k"></div>
                            <div class="chart-bar" style="height:50%;background:rgba(255,107,43,.2)" title="Oct $24k"></div>
                            <div class="chart-bar" style="height:40%;background:rgba(255,107,43,.2)" title="Nov $19k"></div>
                            <div class="chart-bar" style="height:30%;background:rgba(255,107,43,.2)" title="Dec $14k"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2"
                        style="font-size:11px;color:var(--text-muted);padding:0 4px;">
                        <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span>
                        <span>Jul</span><span>Aug</span><span>Sep</span><span>Oct</span><span>Nov</span><span>Dec</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Sales by Category</h6>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1"><span style="font-size:13px">Electronics</span><span
                                style="font-size:13px;font-weight:600">38%</span></div>
                        <div class="progress">
                            <div class="progress-bar" style="width:38%;background:var(--primary)"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1"><span style="font-size:13px">Fashion</span><span
                                style="font-size:13px;font-weight:600">25%</span></div>
                        <div class="progress">
                            <div class="progress-bar" style="width:25%;background:#3b82f6"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1"><span style="font-size:13px">Home &
                                Garden</span><span style="font-size:13px;font-weight:600">18%</span></div>
                        <div class="progress">
                            <div class="progress-bar" style="width:18%;background:#22c55e"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1"><span style="font-size:13px">Sports</span><span
                                style="font-size:13px;font-weight:600">12%</span></div>
                        <div class="progress">
                            <div class="progress-bar" style="width:12%;background:#f59e0b"></div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="d-flex justify-content-between mb-1"><span style="font-size:13px">Books</span><span
                                style="font-size:13px;font-weight:600">7%</span></div>
                        <div class="progress">
                            <div class="progress-bar" style="width:7%;background:#8b5cf6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders + Top Products -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-title-sm">Recent Orders</h6>
                        <a href="#" class="text-primary-custom" style="font-size:13px;font-weight:600"
                            onclick="navigate('orders')">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table table-custom table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>#4521</strong></td>
                                    <td>Sarah Chen</td>
                                    <td>$149.00</td>
                                    <td><span class="badge-status badge-processing">Processing</span></td>
                                </tr>
                                <tr>
                                    <td><strong>#4520</strong></td>
                                    <td>James Wilson</td>
                                    <td>$89.00</td>
                                    <td><span class="badge-status badge-delivered">Delivered</span></td>
                                </tr>
                                <tr>
                                    <td><strong>#4519</strong></td>
                                    <td>Emma Davis</td>
                                    <td>$234.50</td>
                                    <td><span class="badge-status badge-shipped">Shipped</span></td>
                                </tr>
                                <tr>
                                    <td><strong>#4518</strong></td>
                                    <td>Mike Torres</td>
                                    <td>$67.00</td>
                                    <td><span class="badge-status badge-pending">Pending</span></td>
                                </tr>
                                <tr>
                                    <td><strong>#4517</strong></td>
                                    <td>Lisa Park</td>
                                    <td>$312.00</td>
                                    <td><span class="badge-status badge-delivered">Delivered</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-title-sm">Top Products</h6>
                        <a href="#" class="text-primary-custom" style="font-size:13px;font-weight:600"
                            onclick="navigate('products')">See All</a>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="product-img-placeholder"><i class="bi bi-phone"></i></div>
                            <div class="flex-1">
                                <div style="font-size:13px;font-weight:600">iPhone 15 Case Pro</div>
                                <div style="font-size:11px;color:var(--text-muted)">Electronics</div>
                            </div>
                            <div class="text-end">
                                <div style="font-size:13px;font-weight:700">$29.99</div>
                                <div style="font-size:11px;color:var(--success)">+142 sold</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="product-img-placeholder"><i class="bi bi-headphones"></i></div>
                            <div class="flex-1">
                                <div style="font-size:13px;font-weight:600">Wireless Earbuds X</div>
                                <div style="font-size:11px;color:var(--text-muted)">Electronics</div>
                            </div>
                            <div class="text-end">
                                <div style="font-size:13px;font-weight:700">$79.99</div>
                                <div style="font-size:11px;color:var(--success)">+98 sold</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="product-img-placeholder"><i class="bi bi-watch"></i></div>
                            <div class="flex-1">
                                <div style="font-size:13px;font-weight:600">Smart Watch Band</div>
                                <div style="font-size:11px;color:var(--text-muted)">Accessories</div>
                            </div>
                            <div class="text-end">
                                <div style="font-size:13px;font-weight:700">$19.99</div>
                                <div style="font-size:11px;color:var(--success)">+76 sold</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="product-img-placeholder"><i class="bi bi-bag"></i></div>
                            <div class="flex-1">
                                <div style="font-size:13px;font-weight:600">Leather Tote Bag</div>
                                <div style="font-size:11px;color:var(--text-muted)">Fashion</div>
                            </div>
                            <div class="text-end">
                                <div style="font-size:13px;font-weight:700">$54.99</div>
                                <div style="font-size:11px;color:var(--success)">+61 sold</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Feed -->
    <div class="row g-3">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Recent Activity</h6>
                    <div class="activity-item">
                        <div class="avatar-sm" style="background:#fff3ee;color:var(--primary)"><i class="bi bi-receipt"></i>
                        </div>
                        <div>
                            <div style="font-size:13px"><strong>New order #4521</strong> from Sarah Chen</div>
                            <div style="font-size:11px;color:var(--text-muted)">2 minutes ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="avatar-sm" style="background:#dcfce7;color:#16a34a"><i class="bi bi-check-circle"></i>
                        </div>
                        <div>
                            <div style="font-size:13px"><strong>Order #4518</strong> marked as delivered</div>
                            <div style="font-size:11px;color:var(--text-muted)">15 minutes ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="avatar-sm" style="background:#dbeafe;color:#1d4ed8"><i class="bi bi-person-plus"></i>
                        </div>
                        <div>
                            <div style="font-size:13px"><strong>New customer</strong> Emma Davis registered</div>
                            <div style="font-size:11px;color:var(--text-muted)">1 hour ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="avatar-sm" style="background:#fee2e2;color:#dc2626"><i
                                class="bi bi-exclamation-triangle"></i></div>
                        <div>
                            <div style="font-size:13px"><strong>Low stock alert:</strong> Nike Air Max</div>
                            <div style="font-size:11px;color:var(--text-muted)">3 hours ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="avatar-sm" style="background:#f3e8ff;color:#7c3aed"><i class="bi bi-star"></i></div>
                        <div>
                            <div style="font-size:13px"><strong>New 5★ review</strong> on iPhone Case</div>
                            <div style="font-size:11px;color:var(--text-muted)">5 hours ago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Quick Stats</h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="p-3 rounded-3" style="background:var(--surface2)">
                                <div style="font-size:20px;font-weight:800;font-family:'Syne',sans-serif">$1,240</div>
                                <div style="font-size:11px;color:var(--text-muted)">Today's Sales</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3" style="background:var(--surface2)">
                                <div style="font-size:20px;font-weight:800;font-family:'Syne',sans-serif">24</div>
                                <div style="font-size:11px;color:var(--text-muted)">Today's Orders</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3" style="background:var(--surface2)">
                                <div style="font-size:20px;font-weight:800;font-family:'Syne',sans-serif">186</div>
                                <div style="font-size:11px;color:var(--text-muted)">Visitors Today</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3" style="background:var(--surface2)">
                                <div style="font-size:20px;font-weight:800;font-family:'Syne',sans-serif">4.8★</div>
                                <div style="font-size:11px;color:var(--text-muted)">Avg. Rating</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection