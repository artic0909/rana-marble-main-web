@extends('admin.layout.app')

@section('title', 'Orders')

@section('content')

<!-- ══ 8. ORDERS ══ -->
<section class="page-section active" id="page-orders">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Orders</h1>
            <p class="page-subtitle">Manage and track all customer orders.</p>
        </div>
        <button class="btn btn-sm btn-primary-custom"><i class="bi bi-download me-1"></i>Export Orders</button>
    </div>
    <div class="row g-2 mb-3">
        <div class="col-6 col-md-2">
            <div class="p-2 rounded-3 text-center cursor-pointer"
                style="border:2px solid var(--primary);background:var(--primary-light)">
                <div style="font-size:18px;font-weight:800;color:var(--primary);font-family:'Syne',sans-serif">All</div>
                <div style="font-size:11px;color:var(--text-muted)">1,284</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="p-2 rounded-3 text-center cursor-pointer card">
                <div style="font-size:18px;font-weight:800;color:#f59e0b;font-family:'Syne',sans-serif">14</div>
                <div style="font-size:11px;color:var(--text-muted)">Pending</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="p-2 rounded-3 text-center cursor-pointer card">
                <div style="font-size:18px;font-weight:800;color:#1d4ed8;font-family:'Syne',sans-serif">28</div>
                <div style="font-size:11px;color:var(--text-muted)">Processing</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="p-2 rounded-3 text-center cursor-pointer card">
                <div style="font-size:18px;font-weight:800;color:#4338ca;font-family:'Syne',sans-serif">42</div>
                <div style="font-size:11px;color:var(--text-muted)">Shipped</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="p-2 rounded-3 text-center cursor-pointer card">
                <div style="font-size:18px;font-weight:800;color:#16a34a;font-family:'Syne',sans-serif">1,193</div>
                <div style="font-size:11px;color:var(--text-muted)">Delivered</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="p-2 rounded-3 text-center cursor-pointer card">
                <div style="font-size:18px;font-weight:800;color:#dc2626;font-family:'Syne',sans-serif">7</div>
                <div style="font-size:11px;color:var(--text-muted)">Cancelled</div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <div class="px-3 py-3 border-bottom d-flex gap-2 flex-wrap">
                <div class="topbar-search flex-1" style="max-width:300px"><i class="bi bi-search"></i><input type="text"
                        placeholder="Search orders…"
                        style="width:100%;border-radius:10px;padding:8px 14px 8px 36px;border:1.5px solid var(--border);font-size:13px;outline:none;">
                </div>
                <input type="date" class="form-control" style="width:auto;font-size:13px">
                <select class="form-select" style="width:auto;font-size:13px">
                    <option>All Status</option>
                    <option>Pending</option>
                    <option>Processing</option>
                    <option>Shipped</option>
                    <option>Delivered</option>
                    <option>Cancelled</option>
                </select>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-custom table-hover mb-0">
                    <thead style="background:var(--surface2)">
                        <tr>
                            <th style="padding-left:16px">Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding-left:16px"><strong>#4521</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm"
                                        style="background:var(--primary-light);color:var(--primary);font-size:12px">SC</div>Sarah Chen
                                </div>
                            </td>
                            <td style="font-size:12px">Jan 14, 2025</td>
                            <td>2 items</td>
                            <td><strong>$149.00</strong></td>
                            <td><span style="font-size:12px">💳 Card</span></td>
                            <td><span class="badge-status badge-processing">Processing</span></td>
                            <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 10px">View</button></td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px"><strong>#4520</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm" style="background:#dbeafe;color:#1d4ed8;font-size:12px">JW</div>James
                                    Wilson
                                </div>
                            </td>
                            <td style="font-size:12px">Jan 14, 2025</td>
                            <td>1 item</td>
                            <td><strong>$89.00</strong></td>
                            <td><span style="font-size:12px">🅿️ PayPal</span></td>
                            <td><span class="badge-status badge-delivered">Delivered</span></td>
                            <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 10px">View</button></td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px"><strong>#4519</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm" style="background:#dcfce7;color:#16a34a;font-size:12px">ED</div>Emma
                                    Davis
                                </div>
                            </td>
                            <td style="font-size:12px">Jan 13, 2025</td>
                            <td>4 items</td>
                            <td><strong>$234.50</strong></td>
                            <td><span style="font-size:12px">💳 Card</span></td>
                            <td><span class="badge-status badge-shipped">Shipped</span></td>
                            <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 10px">View</button></td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px"><strong>#4518</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm" style="background:#f3e8ff;color:#7c3aed;font-size:12px">MT</div>Mike
                                    Torres
                                </div>
                            </td>
                            <td style="font-size:12px">Jan 13, 2025</td>
                            <td>1 item</td>
                            <td><strong>$67.00</strong></td>
                            <td><span style="font-size:12px">🍎 Apple Pay</span></td>
                            <td><span class="badge-status badge-pending">Pending</span></td>
                            <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 10px">View</button></td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px"><strong>#4517</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm" style="background:#fef9c3;color:#854d0e;font-size:12px">LP</div>Lisa Park
                                </div>
                            </td>
                            <td style="font-size:12px">Jan 12, 2025</td>
                            <td>3 items</td>
                            <td><strong>$312.00</strong></td>
                            <td><span style="font-size:12px">💳 Card</span></td>
                            <td><span class="badge-status badge-delivered">Delivered</span></td>
                            <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 10px">View</button></td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px"><strong>#4516</strong></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm" style="background:#fee2e2;color:#dc2626;font-size:12px">RK</div>Ryan Kim
                                </div>
                            </td>
                            <td style="font-size:12px">Jan 12, 2025</td>
                            <td>2 items</td>
                            <td><strong>$98.50</strong></td>
                            <td><span style="font-size:12px">💳 Card</span></td>
                            <td><span class="badge-status badge-cancelled">Cancelled</span></td>
                            <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 10px">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center px-3 py-3 border-top flex-wrap gap-2">
                <span style="font-size:13px;color:var(--text-muted)">Showing 1–6 of 1,284 orders</span>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                        <li class="page-item active"><a class="page-link" href="#"
                                style="background:var(--primary);border-color:var(--primary)">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">›</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

@endsection