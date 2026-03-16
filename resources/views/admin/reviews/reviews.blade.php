@extends('admin.layout.app')

@section('title', 'All Product Reviews')

@section('content')

<!-- ══ 7. REVIEWS ══ -->
<section class="page-section active" id="page-reviews">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Reviews</h1>
            <p class="page-subtitle">Monitor and manage customer reviews.</p>
        </div>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" style="border-radius:10px;font-size:13px;width:auto">
                <option>All Ratings</option>
                <option>★★★★★ 5 Stars</option>
                <option>★★★★ 4 Stars</option>
                <option>★★★ 3 Stars</option>
                <option>★★ 2 Stars</option>
                <option>★ 1 Star</option>
            </select>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column gap-3">
                <div class="p-3 rounded-3" style="border:1.5px solid var(--border)">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-sm" style="background:var(--primary-light);color:var(--primary)">S</div>
                            <div>
                                <div style="font-size:13px;font-weight:600">Sarah Chen</div>
                                <div style="font-size:11px;color:var(--text-muted)">iPhone 15 Case Pro · Jan 14, 2025</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="stars">★★★★★</span>
                            <span class="badge-status badge-pending">Pending</span>
                        </div>
                    </div>
                    <p style="font-size:13px;color:var(--text-muted);margin:0 0 10px">"Absolutely love this case! Fits
                        perfectly and the material feels premium. Would definitely recommend to anyone looking for a reliable
                        case."</p>
                    <div class="d-flex gap-2"><button class="btn btn-sm"
                            style="background:#dcfce7;color:#16a34a;border-radius:8px;font-size:12px;padding:4px 12px"><i
                                class="bi bi-check me-1"></i>Approve</button><button class="btn btn-sm"
                            style="background:#fee2e2;color:#dc2626;border-radius:8px;font-size:12px;padding:4px 12px"><i
                                class="bi bi-x me-1"></i>Reject</button><button class="btn btn-sm btn-outline-custom"
                            style="font-size:12px;padding:4px 12px"><i class="bi bi-reply me-1"></i>Reply</button></div>
                </div>
                <div class="p-3 rounded-3" style="border:1.5px solid var(--border)">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-sm" style="background:#dbeafe;color:#1d4ed8">J</div>
                            <div>
                                <div style="font-size:13px;font-weight:600">James Wilson</div>
                                <div style="font-size:11px;color:var(--text-muted)">Wireless Earbuds X · Jan 12, 2025</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="stars">★★★★<span style="color:#d1d5db">★</span></span>
                            <span class="badge-status badge-active">Published</span>
                        </div>
                    </div>
                    <p style="font-size:13px;color:var(--text-muted);margin:0 0 10px">"Great sound quality for the price.
                        Battery life is decent. The only con is the case feels a bit cheap but the earbuds themselves are
                        excellent."</p>
                    <div class="d-flex gap-2"><button class="btn btn-sm btn-outline-custom"
                            style="font-size:12px;padding:4px 12px"><i class="bi bi-reply me-1"></i>Reply</button><button
                            class="btn btn-sm"
                            style="background:#fee2e2;color:#dc2626;border-radius:8px;font-size:12px;padding:4px 12px">Delete</button>
                    </div>
                </div>
                <div class="p-3 rounded-3" style="border:1.5px solid var(--border)">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-sm" style="background:#fee2e2;color:#dc2626">M</div>
                            <div>
                                <div style="font-size:13px;font-weight:600">Mike Torres</div>
                                <div style="font-size:11px;color:var(--text-muted)">Leather Tote Bag · Jan 10, 2025</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="stars"><span style="color:#d1d5db">★★</span>★★★</span>
                            <span class="badge-status badge-pending">Pending</span>
                        </div>
                    </div>
                    <p style="font-size:13px;color:var(--text-muted);margin:0 0 10px">"Disappointed with the quality. The
                        stitching on one side started coming apart after just 2 weeks. Not what I expected for the price."</p>
                    <div class="d-flex gap-2"><button class="btn btn-sm"
                            style="background:#dcfce7;color:#16a34a;border-radius:8px;font-size:12px;padding:4px 12px"><i
                                class="bi bi-check me-1"></i>Approve</button><button class="btn btn-sm"
                            style="background:#fee2e2;color:#dc2626;border-radius:8px;font-size:12px;padding:4px 12px"><i
                                class="bi bi-x me-1"></i>Reject</button><button class="btn btn-sm btn-outline-custom"
                            style="font-size:12px;padding:4px 12px"><i class="bi bi-reply me-1"></i>Reply</button></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection