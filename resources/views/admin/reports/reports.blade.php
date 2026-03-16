@extends('admin.layout.app')

@section('title', 'Reports')

@section('content')

<!-- ══ 20. REPORTS ══ -->
<section class="page-section active" id="page-reports">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Reports</h1>
            <p class="page-subtitle">Download and view detailed business reports.</p>
        </div>
        <!-- <button class="btn btn-sm btn-primary-custom"><i class="bi bi-plus-lg me-1"></i>Generate Report</button> -->
    </div>
    <div class="row g-3 mb-4">
        <!-- <div class="col-12 col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Quick Reports</h6>
                    <div class="d-flex flex-column gap-2">
                        <button class="btn btn-outline-custom text-start d-flex align-items-center gap-3"><i
                                class="bi bi-file-earmark-bar-graph text-primary-custom" style="font-size:18px"></i>
                            <div>
                                <div style="font-size:13px;font-weight:600">Sales Report</div>
                                <div style="font-size:11px;color:var(--text-muted)">Revenue, orders, averages</div>
                            </div>
                        </button>
                        <button class="btn btn-outline-custom text-start d-flex align-items-center gap-3"><i
                                class="bi bi-people text-primary-custom" style="font-size:18px"></i>
                            <div>
                                <div style="font-size:13px;font-weight:600">Customer Report</div>
                                <div style="font-size:11px;color:var(--text-muted)">Acquisition, retention, LTV</div>
                            </div>
                        </button>
                        <button class="btn btn-outline-custom text-start d-flex align-items-center gap-3"><i
                                class="bi bi-box-seam text-primary-custom" style="font-size:18px"></i>
                            <div>
                                <div style="font-size:13px;font-weight:600">Product Report</div>
                                <div style="font-size:11px;color:var(--text-muted)">Best sellers, inventory</div>
                            </div>
                        </button>
                        <button class="btn btn-outline-custom text-start d-flex align-items-center gap-3"><i
                                class="bi bi-credit-card text-primary-custom" style="font-size:18px"></i>
                            <div>
                                <div style="font-size:13px;font-weight:600">Finance Report</div>
                                <div style="font-size:11px;color:var(--text-muted)">P&L, taxes, refunds</div>
                            </div>
                        </button>
                        <button class="btn btn-outline-custom text-start d-flex align-items-center gap-3"><i
                                class="bi bi-truck text-primary-custom" style="font-size:18px"></i>
                            <div>
                                <div style="font-size:13px;font-weight:600">Shipping Report</div>
                                <div style="font-size:11px;color:var(--text-muted)">Fulfillment times, carriers</div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-12 col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Custom Report Builder</h6>
                    <div class="row g-3">
                        <div class="col-12 col-md-6"><label class="form-label-custom">Report Type</label><select
                                class="form-select">
                                <option>Sales Overview</option>
                                <option>Product Performance</option>
                                <option>Customer Analytics</option>
                                <option>Financial Summary</option>
                            </select></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Date Range</label><select
                                class="form-select">
                                <option>Last 30 Days</option>
                                <option>Last 7 Days</option>
                                <option>Last 90 Days</option>
                                <option>This Year</option>
                                <option>Custom</option>
                            </select></div>
                        <div class="col-6"><label class="form-label-custom">From Date</label><input type="date"
                                class="form-control"></div>
                        <div class="col-6"><label class="form-label-custom">To Date</label><input type="date"
                                class="form-control"></div>
                        <div class="col-12"><label class="form-label-custom">Export Format</label>
                            <div class="d-flex gap-2">
                                <!-- <button class="btn btn-outline-custom flex-1"><i class="bi bi-filetype-csv me-1"></i>CSV</button> -->
                                <!-- <button class="btn btn-primary-custom flex-1"><i class="bi bi-filetype-pdf me-1"></i>PDF</button> -->
                                <button class="btn btn-primary-custom flex-1"><i class="bi bi-filetype-xlsx me-1"></i>Export as Excel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="card">
                <div class="card-body p-0">
                    <div class="px-3 py-3 border-bottom">
                        <h6 class="card-title-sm mb-0">Recent Reports</h6>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table table-custom mb-0">
                            <thead style="background:var(--surface2)">
                                <tr>
                                    <th style="padding-left:16px">Report Name</th>
                                    <th>Type</th>
                                    <th>Generated</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding-left:16px;font-size:13px;font-weight:600">Sales Report Jan 2025</td>
                                    <td style="font-size:12px">Sales</td>
                                    <td style="font-size:12px">Jan 14, 2025</td>
                                    <td><button class="btn btn-sm"
                                            style="background:var(--surface2);border-radius:7px;padding:4px 10px;font-size:11px"><i
                                                class="bi bi-download me-1"></i>PDF</button></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:16px;font-size:13px;font-weight:600">Customer Report Q4 2024</td>
                                    <td style="font-size:12px">Customers</td>
                                    <td style="font-size:12px">Jan 2, 2025</td>
                                    <td><button class="btn btn-sm"
                                            style="background:var(--surface2);border-radius:7px;padding:4px 10px;font-size:11px"><i
                                                class="bi bi-download me-1"></i>CSV</button></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:16px;font-size:13px;font-weight:600">Finance Report Dec 2024</td>
                                    <td style="font-size:12px">Finance</td>
                                    <td style="font-size:12px">Dec 31, 2024</td>
                                    <td><button class="btn btn-sm"
                                            style="background:var(--surface2);border-radius:7px;padding:4px 10px;font-size:11px"><i
                                                class="bi bi-download me-1"></i>Excel</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>

@endsection