@extends('admin.layout.app')

@section('title', 'Banners')

@section('content')

<!-- ══ 16. BANNERS ══ -->
<section class="page-section active" id="page-banners">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Banners</h1>
            <p class="page-subtitle">Manage promotional banners and hero images.</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="rounded-3 mb-3 d-flex align-items-center justify-content-center"
                        style="height:120px;background:linear-gradient(135deg,#FF6B2B,#ff9a5c);position:relative;overflow:hidden">
                        <div style="color:#fff;text-align:center;position:relative;z-index:1">
                            <div style="font-size:18px;font-weight:800;font-family:'Syne',sans-serif">WINTER SALE</div>
                            <div style="font-size:12px;opacity:.8">Up to 50% off selected items</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-weight:600;font-size:13px">Winter Sale Banner</div>
                            <div style="font-size:11px;color:var(--text-muted)">Homepage · Hero</div>
                        </div>
                        <div class="d-flex gap-2 align-items-center"><span
                                class="badge-status badge-active">Active</span><button class="btn btn-sm"
                                style="background:var(--surface2);border-radius:7px;padding:4px 8px"><i class="bi bi-pencil"
                                    style="font-size:12px"></i></button></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="rounded-3 mb-3 d-flex align-items-center justify-content-center"
                        style="height:120px;background:linear-gradient(135deg,#1d4ed8,#3b82f6);position:relative;overflow:hidden">
                        <div style="color:#fff;text-align:center;position:relative;z-index:1">
                            <div style="font-size:18px;font-weight:800;font-family:'Syne',sans-serif">NEW ARRIVALS</div>
                            <div style="font-size:12px;opacity:.8">Check out the latest collection</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-weight:600;font-size:13px">New Arrivals Banner</div>
                            <div style="font-size:11px;color:var(--text-muted)">Homepage · Secondary</div>
                        </div>
                        <div class="d-flex gap-2 align-items-center"><span
                                class="badge-status badge-draft">Draft</span><button class="btn btn-sm"
                                style="background:var(--surface2);border-radius:7px;padding:4px 8px"><i class="bi bi-pencil"
                                    style="font-size:12px"></i></button></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Add New Banner</h6>
                    <div class="row g-3">
                        <div class="col-12 col-md-6"><label class="form-label-custom">Banner Title</label><input type="text"
                                class="form-control" placeholder="e.g. Summer Sale"></div>
                        <div class="col-12 col-md-6"><label class="form-label-custom">Placement</label><select
                                class="form-select">
                                <option>Homepage Hero</option>
                                <option>Homepage Secondary</option>
                                <option>Category Page</option>
                                <option>Checkout</option>
                            </select></div>
                        <div class="col-12"><label class="form-label-custom">Banner Image</label>
                            <div class="upload-zone"><i class="bi bi-cloud-upload"
                                    style="font-size:32px;color:var(--text-muted)"></i>
                                <div style="font-size:13px;color:var(--text-muted);margin-top:8px">Drag & drop or <span
                                        style="color:var(--primary);font-weight:600">browse</span></div>
                                <div style="font-size:11px;color:var(--text-muted);margin-top:4px">Recommended: 1920×600px · Max
                                    5MB</div>
                            </div>
                        </div>
                        <div class="col-12"><button class="btn btn-primary-custom">Publish Banner</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection