@extends('admin.layout.app')

@section('title', 'Payments')

@section('content')

<!-- ══ 11. PAYMENTS ══ -->
<section class="page-section active" id="page-payments">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Payments</h1>
            <p class="page-subtitle">Manage payment methods and transactions.</p>
        </div>
        <button class="btn btn-sm btn-primary-custom"><i class="bi bi-download me-1"></i>Export</button>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="icon-wrap" style="background:#dcfce7;color:#16a34a"><i class="bi bi-check-circle"></i></div>
                <div class="value">$48,250</div>
                <div class="label">Successful Payments</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="icon-wrap" style="background:#fee2e2;color:#dc2626"><i class="bi bi-x-circle"></i></div>
                <div class="value">$1,240</div>
                <div class="label">Failed/Declined</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="icon-wrap" style="background:#fef9c3;color:#854d0e"><i class="bi bi-clock"></i></div>
                <div class="value">$3,200</div>
                <div class="label">Pending Payouts</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="icon-wrap" style="background:#dbeafe;color:#1d4ed8"><i class="bi bi-arrow-return-left"></i>
                </div>
                <div class="value">$890</div>
                <div class="label">Refunds Issued</div>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-body p-0">
                    <div class="px-3 py-3 border-bottom">
                        <h6 class="card-title-sm mb-0">Recent Transactions</h6>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table table-custom table-hover mb-0">
                            <thead style="background:var(--surface2)">
                                <tr>
                                    <th style="padding-left:16px">Transaction</th>
                                    <th>Method</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding-left:16px">
                                        <div style="font-size:13px;font-weight:600">Order #4521</div>
                                        <div style="font-size:11px;color:var(--text-muted)">Jan 14 · Sarah Chen</div>
                                    </td>
                                    <td><span style="font-size:12px">💳 Visa •••4521</span></td>
                                    <td><strong>$149.00</strong></td>
                                    <td><span class="badge-status badge-active">Success</span></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:16px">
                                        <div style="font-size:13px;font-weight:600">Order #4520</div>
                                        <div style="font-size:11px;color:var(--text-muted)">Jan 14 · James Wilson</div>
                                    </td>
                                    <td><span style="font-size:12px">🅿️ PayPal</span></td>
                                    <td><strong>$89.00</strong></td>
                                    <td><span class="badge-status badge-active">Success</span></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:16px">
                                        <div style="font-size:13px;font-weight:600">Order #4519</div>
                                        <div style="font-size:11px;color:var(--text-muted)">Jan 13 · Emma Davis</div>
                                    </td>
                                    <td><span style="font-size:12px">💳 MC •••9821</span></td>
                                    <td><strong>$234.50</strong></td>
                                    <td><span class="badge-status badge-active">Success</span></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:16px">
                                        <div style="font-size:13px;font-weight:600">Refund #R1026</div>
                                        <div style="font-size:11px;color:var(--text-muted)">Jan 12 · David Kim</div>
                                    </td>
                                    <td><span style="font-size:12px">💳 Visa •••7732</span></td>
                                    <td><strong style="color:#dc2626">-$149.00</strong></td>
                                    <td><span class="badge-status badge-cancelled">Refunded</span></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:16px">
                                        <div style="font-size:13px;font-weight:600">Order #4516</div>
                                        <div style="font-size:11px;color:var(--text-muted)">Jan 12 · Ryan Kim</div>
                                    </td>
                                    <td><span style="font-size:12px">💳 Amex •••0012</span></td>
                                    <td><strong>$98.50</strong></td>
                                    <td><span class="badge-status badge-cancelled">Failed</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Payment Gateways</h6>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between align-items-center p-2 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div>
                                <div style="font-size:13px;font-weight:600">💳 Stripe</div>
                                <div style="font-size:11px;color:var(--text-muted)">Cards, Wallets</div>
                            </div>
                            <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-2 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div>
                                <div style="font-size:13px;font-weight:600">🅿️ PayPal</div>
                                <div style="font-size:11px;color:var(--text-muted)">PayPal, Venmo</div>
                            </div>
                            <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-2 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div>
                                <div style="font-size:13px;font-weight:600">🍎 Apple Pay</div>
                                <div style="font-size:11px;color:var(--text-muted)">iOS, Safari</div>
                            </div>
                            <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-2 rounded-3"
                            style="border:1.5px solid var(--border)">
                            <div>
                                <div style="font-size:13px;font-weight:600">🤖 Google Pay</div>
                                <div style="font-size:11px;color:var(--text-muted)">Android, Chrome</div>
                            </div>
                            <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Payment Split</h6>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:10px;height:10px;border-radius:3px;background:var(--primary)"></div><span
                                    style="font-size:13px">Credit Card</span>
                            </div><span style="font-weight:700;font-size:13px">58%</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:10px;height:10px;border-radius:3px;background:#3b82f6"></div><span
                                    style="font-size:13px">PayPal</span>
                            </div><span style="font-weight:700;font-size:13px">24%</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:10px;height:10px;border-radius:3px;background:#1a1a1a"></div><span
                                    style="font-size:13px">Apple Pay</span>
                            </div><span style="font-weight:700;font-size:13px">12%</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:10px;height:10px;border-radius:3px;background:#f59e0b"></div><span
                                    style="font-size:13px">Other</span>
                            </div><span style="font-weight:700;font-size:13px">6%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection