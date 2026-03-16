@extends('admin.layout.app')

@section('title', 'Customers')

@section('content')

<!-- ══ 12. CUSTOMERS ══ -->
<section class="page-section active" id="page-customers">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Customers</h1>
            <p class="page-subtitle">View and manage your customer base.</p>
        </div>
        <button class="btn btn-sm btn-primary-custom"><i class="bi bi-download me-1"></i>Export</button>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-6">
            <div class="stat-card">
                <div class="value">9,741</div>
                <div class="label">Total Customers</div><span class="trend trend-up"><i
                        class="bi bi-arrow-up-short"></i>+5.2%</span>
            </div>
        </div>
        <div class="col-6 col-md-6">
            <div class="stat-card">
                <div class="value">2,840</div>
                <div class="label">New This Month</div><span class="trend trend-up"><i
                        class="bi bi-arrow-up-short"></i>+12%</span>
            </div>
        </div>
        <!-- <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="value">28%</div>
                <div class="label">Returning</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="value">$37.50</div>
                <div class="label">Avg. Order Value</div>
            </div>
        </div> -->
    </div>
    <div class="card">
        <div class="card-body p-0">
            <div class="px-3 py-3 border-bottom d-flex gap-2 flex-wrap">
                <div class="topbar-search flex-1" style="max-width:300px"><i class="bi bi-search"></i><input type="text"
                        placeholder="Search customers…"
                        style="width:100%;border-radius:10px;padding:8px 14px 8px 36px;border:1.5px solid var(--border);font-size:13px;outline:none;">
                </div>
                <select class="form-select" style="width:auto;font-size:13px">
                    <option>All Customers</option>
                    <option>VIP</option>
                    <option>New</option>
                    <option>At Risk</option>
                </select>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-custom table-hover mb-0">
                    <thead style="background:var(--surface2)">
                        <tr>
                            <th style="padding-left:16px">Customer</th>
                            <th>Email</th>
                            <th>Orders</th>
                            <th>Spent</th>
                            <th>Joined</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm" style="background:var(--primary-light);color:var(--primary)">S</div>
                                    <strong style="font-size:13px">Sarah Chen</strong>
                                </div>
                            </td>
                            <td style="font-size:12px">sarah@email.com</td>
                            <td>14</td>
                            <td style="font-weight:700">$2,140</td>
                            <td style="font-size:12px">Jan 2024</td>
                            <td><span class="badge-status badge-new">VIP</span></td>
                            <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 10px">View</button></td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm" style="background:#dbeafe;color:#1d4ed8">J</div><strong
                                        style="font-size:13px">James Wilson</strong>
                                </div>
                            </td>
                            <td style="font-size:12px">james@email.com</td>
                            <td>8</td>
                            <td style="font-weight:700">$890</td>
                            <td style="font-size:12px">Mar 2024</td>
                            <td><span class="badge-status badge-active">Active</span></td>
                            <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 10px">View</button></td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm" style="background:#dcfce7;color:#16a34a">E</div><strong
                                        style="font-size:13px">Emma Davis</strong>
                                </div>
                            </td>
                            <td style="font-size:12px">emma@email.com</td>
                            <td>22</td>
                            <td style="font-weight:700">$3,840</td>
                            <td style="font-size:12px">Nov 2023</td>
                            <td><span class="badge-status badge-new">VIP</span></td>
                            <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 10px">View</button></td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm" style="background:#fee2e2;color:#dc2626">M</div><strong
                                        style="font-size:13px">Mike Torres</strong>
                                </div>
                            </td>
                            <td style="font-size:12px">mike@email.com</td>
                            <td>1</td>
                            <td style="font-weight:700">$67</td>
                            <td style="font-size:12px">Jan 2025</td>
                            <td><span class="badge-status badge-new">New</span></td>
                            <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 10px">View</button></td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm" style="background:#f3e8ff;color:#7c3aed">L</div><strong
                                        style="font-size:13px">Lisa Park</strong>
                                </div>
                            </td>
                            <td style="font-size:12px">lisa@email.com</td>
                            <td>6</td>
                            <td style="font-weight:700">$560</td>
                            <td style="font-size:12px">Jun 2024</td>
                            <td><span class="badge-status badge-active">Active</span></td>
                            <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 10px">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center px-3 py-3 border-top flex-wrap gap-2">
                <span style="font-size:13px;color:var(--text-muted)">Showing 1–5 of 9,741 customers</span>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                        <li class="page-item active"><a class="page-link" href="#"
                                style="background:var(--primary);border-color:var(--primary)">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">›</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

@endsection