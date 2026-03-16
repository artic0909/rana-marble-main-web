@extends('admin.layout.app')

@section('title', 'Returns')

@section('content')

<!-- ══ 9. RETURNS ══ -->
<section class="page-section active" id="page-returns">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Returns & Refunds</h1>
            <p class="page-subtitle">Handle return requests and refund processing.</p>
        </div>
        <button class="btn btn-sm btn-primary-custom"><i class="bi bi-plus-lg me-1"></i>Manual Return</button>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="icon-wrap" style="background:#fef9c3;color:#854d0e"><i class="bi bi-hourglass"></i></div>
                <div class="value">3</div>
                <div class="label">Pending Review</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="icon-wrap" style="background:#dbeafe;color:#1d4ed8"><i class="bi bi-truck"></i></div>
                <div class="value">8</div>
                <div class="label">Items in Transit</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="icon-wrap" style="background:#dcfce7;color:#16a34a"><i class="bi bi-check-circle"></i></div>
                <div class="value">$1,240</div>
                <div class="label">Refunded This Month</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="icon-wrap" style="background:#fee2e2;color:#dc2626"><i class="bi bi-percent"></i></div>
                <div class="value">2.1%</div>
                <div class="label">Return Rate</div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table table-custom table-hover mb-0">
                    <thead style="background:var(--surface2)">
                        <tr>
                            <th style="padding-left:16px">Return ID</th>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Reason</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding-left:16px"><strong>#R1029</strong></td>
                            <td>#4510</td>
                            <td>Anna Lee</td>
                            <td style="font-size:12px">Wrong size received</td>
                            <td><strong>$54.99</strong></td>
                            <td><span class="badge-status badge-pending">Pending</span></td>
                            <td>
                                <div class="d-flex gap-1"><button class="btn btn-sm"
                                        style="background:#dcfce7;color:#16a34a;border-radius:7px;font-size:11px;padding:3px 8px">Approve</button><button
                                        class="btn btn-sm"
                                        style="background:#fee2e2;color:#dc2626;border-radius:7px;font-size:11px;padding:3px 8px">Deny</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px"><strong>#R1028</strong></td>
                            <td>#4505</td>
                            <td>Tom Brown</td>
                            <td style="font-size:12px">Defective item</td>
                            <td><strong>$79.99</strong></td>
                            <td><span class="badge-status badge-processing">Processing</span></td>
                            <td>
                                <div class="d-flex gap-1"><button class="btn btn-sm btn-outline-custom"
                                        style="font-size:11px;padding:3px 8px">View</button></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px"><strong>#R1027</strong></td>
                            <td>#4498</td>
                            <td>Julia Martinez</td>
                            <td style="font-size:12px">Changed mind</td>
                            <td><strong>$29.99</strong></td>
                            <td><span class="badge-status badge-pending">Pending</span></td>
                            <td>
                                <div class="d-flex gap-1"><button class="btn btn-sm"
                                        style="background:#dcfce7;color:#16a34a;border-radius:7px;font-size:11px;padding:3px 8px">Approve</button><button
                                        class="btn btn-sm"
                                        style="background:#fee2e2;color:#dc2626;border-radius:7px;font-size:11px;padding:3px 8px">Deny</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px"><strong>#R1026</strong></td>
                            <td>#4490</td>
                            <td>David Kim</td>
                            <td style="font-size:12px">Not as described</td>
                            <td><strong>$149.00</strong></td>
                            <td><span class="badge-status badge-delivered">Refunded</span></td>
                            <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 8px">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection