@extends('admin.layout.app')

@section('title', 'All Products')

@section('content')

<!-- ══ 3. PRODUCTS ══ -->
<section class="page-section active" id="page-products">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Products</h1>
            <p class="page-subtitle">Manage your product catalog.</p>
        </div>
        <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-primary-custom"><i
                class="bi bi-plus-lg me-1"></i>Add Product</a>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-12 col-md-4">
                    <div class="topbar-search" style="max-width:100%"><i class="bi bi-search"></i><input type="text"
                            placeholder="Search products…"
                            style="width:100%;border-radius:10px;padding:9px 14px 9px 38px;border:1.5px solid var(--border);font-size:14px;outline:none;">
                    </div>
                </div>
                <div class="col-6 col-md-2"><select class="form-select" style="font-size:13px">
                        <option>All Categories</option>
                        <option>Electronics</option>
                        <option>Fashion</option>
                        <option>Home</option>
                        <option>Sports</option>
                    </select></div>
                <div class="col-6 col-md-2"><select class="form-select" style="font-size:13px">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Draft</option>
                        <option>Inactive</option>
                    </select></div>
                <div class="col-6 col-md-2"><select class="form-select" style="font-size:13px">
                        <option>Sort: Newest</option>
                        <option>Price: Low-High</option>
                        <option>Price: High-Low</option>
                        <option>Best Selling</option>
                    </select></div>
                <div class="col-6 col-md-2"><button class="btn btn-outline-custom w-100"><i
                            class="bi bi-funnel me-1"></i>Filter</button></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table table-custom table-hover mb-0">
                    <thead style="background:var(--surface2)">
                        <tr>
                            <th style="padding-left:16px"><input type="checkbox" class="form-check-input"></th>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding-left:16px"><input type="checkbox" class="form-check-input"></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="product-img-placeholder"><i class="bi bi-phone"></i></div>
                                    <div>
                                        <div style="font-size:13px;font-weight:600">iPhone 15 Case Pro</div>
                                        <div style="font-size:11px;color:var(--text-muted)">Added Jan 12, 2025</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:13px">IP15-CP-001</td>
                            <td style="font-size:13px">IP15</td>
                            <td style="font-size:13px">12"X14"</td>
                            <td><span class="cat-pill">Electronics</span></td>
                            <td style="font-weight:600">$29.99</td>
                            <td><span style="font-size:13px;color:#16a34a;font-weight:600">142</span></td>
                            <td><span class="badge-status badge-active">Active</span></td>
                            <td>
                                <div class="d-flex gap-1"><button class="btn btn-sm"
                                        style="background:var(--surface2);border-radius:7px;padding:4px 8px;" title="Edit"><i
                                            class="bi bi-pencil" style="font-size:13px"></i></button><button class="btn btn-sm"
                                        style="background:#fee2e2;color:#dc2626;border-radius:7px;padding:4px 8px;" title="Delete"><i
                                            class="bi bi-trash" style="font-size:13px"></i></button></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center px-3 py-3 border-top flex-wrap gap-2">
                <span style="font-size:13px;color:var(--text-muted)">Showing 1–5 of 248 products</span>
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