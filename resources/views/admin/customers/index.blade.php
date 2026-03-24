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
                <div class="value">{{$totalCustomer}}</div>
                <div class="label">Total Customers</div>
            </div>
        </div>
        <div class="col-6 col-md-6">
            <div class="stat-card">
                <div class="value">{{$currentMonthTotalCustomer}}</div>
                <div class="label">New This Month</div>
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
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm" style="background:var(--primary-light);color:var(--primary)">
                                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                                    </div>
                                    <strong style="font-size:13px">{{ $customer->name }}</strong>
                                </div>
                            </td>
                            <td style="font-size:12px">{{ $customer->email }}</td>
                            <td>{{ $customer->orders->count() }}</td>
                            <td style="font-weight:700">₹{{ $customer->orders->sum('total') }}</td>
                            <td style="font-size:12px">{{ $customer->created_at->format('M Y') }}</td>
                            <!-- <td><button class="btn btn-sm btn-outline-custom"
                                    style="font-size:11px;padding:3px 10px">View</button></td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center px-3 py-3 border-top flex-wrap gap-2">
                <span style="font-size:13px;color:var(--text-muted)">
                    Showing {{ $customers->firstItem() }}–{{ $customers->lastItem() }} of {{ $customers->total() }} customers
                </span>
                <nav>
                    {{ $customers->links('pagination::bootstrap-4') }}
                </nav>
            </div>
        </div>
    </div>
    </div>
</section>

@endsection