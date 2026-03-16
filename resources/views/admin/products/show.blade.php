@extends('admin.layout.app')

@section('title', 'Product Details')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div class="d-flex align-items-center gap-2">
        <a href="#" class="btn btn-sm btn-outline-custom"><i class="bi bi-arrow-left"></i></a>
        <div>
            <h1 class="page-title mb-0">iPhone 15 Case Pro</h1>
            <p class="page-subtitle mb-0">SKU: IP15-001 &nbsp;·&nbsp; Added 12 Mar 2025</p>
        </div>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-sm btn-outline-custom"><i class="bi bi-pencil me-1"></i>Edit</button>
        <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:8px;padding:5px 14px;border:none;font-size:13px;font-weight:500">
            <i class="bi bi-trash me-1"></i>Delete
        </button>
    </div>
</div>

<div class="row g-3">

    <!-- ── LEFT ──────────────────────────────────────────── -->
    <div class="col-12 col-lg-8">

        <!-- Images -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Product Images</h6>
                <div class="d-flex gap-3 flex-wrap align-items-start">
                    <!-- Main image -->
                    <div style="flex:1;min-width:220px;border-radius:12px;overflow:hidden;border:1.5px solid var(--border);background:var(--surface2)">
                        <img src="https://placehold.co/500x400/f1f5f9/94a3b8?text=Main+Image"
                            alt="Main" style="width:100%;height:260px;object-fit:cover;display:block">
                    </div>
                    <!-- Thumbnails -->
                    <div class="d-flex flex-column gap-2">
                        @foreach([1,2,3,4] as $i)
                        <div style="width:72px;height:72px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:var(--surface2)">
                            <img src="https://placehold.co/150/f1f5f9/94a3b8?text={{ $i }}"
                                alt="Thumb {{ $i }}" style="width:100%;height:100%;object-fit:cover;display:block">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Basic Info -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Basic Information</h6>
                <div class="mb-3">
                    <p style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Product Name</p>
                    <p style="font-size:14px;font-weight:600;margin:0">iPhone 15 Case Pro</p>
                </div>
                <div class="mb-3">
                    <p style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Description</p>
                    <p style="font-size:13px;line-height:1.7;color:var(--text-secondary);margin:0">
                        Premium protective case for iPhone 15 with military-grade drop protection. Features a slim profile design with precise cutouts for all ports and buttons. Available in multiple colors to match your style. The case provides 360-degree protection without adding unnecessary bulk.
                    </p>
                </div>
                <div>
                    <p style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">Tags</p>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach(['case','protection','apple','iphone-15','premium'] as $tag)
                        <span style="font-size:12px;font-weight:500;padding:3px 10px;border-radius:20px;background:var(--surface2);border:1.5px solid var(--border);color:var(--text-secondary)">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Variants Table -->
        <div class="card">
            <div class="card-body p-0">
                <div class="px-3 py-3 border-bottom">
                    <h6 class="card-title-sm mb-0">Variants</h6>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-custom table-hover mb-0">
                        <thead style="background:var(--surface2)">
                            <tr>
                                <th style="padding-left:16px">#</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $variants = [
                            ['size'=>'S', 'color'=>'Black', 'price'=>'$24.99','stock'=>42,'status'=>'In Stock'],
                            ['size'=>'M', 'color'=>'Black', 'price'=>'$24.99','stock'=>38,'status'=>'In Stock'],
                            ['size'=>'L', 'color'=>'Black', 'price'=>'$24.99','stock'=>15,'status'=>'In Stock'],
                            ['size'=>'S', 'color'=>'White', 'price'=>'$24.99','stock'=>20,'status'=>'In Stock'],
                            ['size'=>'M', 'color'=>'White', 'price'=>'$24.99','stock'=>5, 'status'=>'Low Stock'],
                            ['size'=>'L', 'color'=>'White', 'price'=>'$24.99','stock'=>0, 'status'=>'Out of Stock'],
                            ['size'=>'XL', 'color'=>'Blue', 'price'=>'$26.99','stock'=>30,'status'=>'In Stock'],
                            ['size'=>'XL', 'color'=>'Red', 'price'=>'$26.99','stock'=>18,'status'=>'In Stock'],
                            ];
                            @endphp
                            @foreach($variants as $i => $v)
                            <tr>
                                <td style="padding-left:16px;color:var(--text-muted);font-size:12px">{{ $i + 1 }}</td>
                                <td>
                                    <span style="font-size:12px;font-weight:600;padding:2px 9px;border-radius:6px;background:var(--surface2);border:1.5px solid var(--border)">{{ $v['size'] }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span style="width:13px;height:13px;border-radius:50%;display:inline-block;border:1.5px solid var(--border);background:{{ strtolower($v['color']) }}"></span>
                                        <span style="font-size:13px">{{ $v['color'] }}</span>
                                    </div>
                                </td>
                                <td style="font-weight:600;font-size:13px">{{ $v['price'] }}</td>
                                <td style="font-size:13px">{{ $v['stock'] }}</td>
                                <td>
                                    @if($v['status'] === 'In Stock')
                                    <span class="badge-status badge-active">In Stock</span>
                                    @elseif($v['status'] === 'Low Stock')
                                    <span class="badge-status" style="background:#fef9c3;color:#854d0e">Low Stock</span>
                                    @else
                                    <span class="badge-status badge-draft">Out of Stock</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- ── RIGHT ─────────────────────────────────────────── -->
    <div class="col-12 col-lg-4">

        <!-- Status & Org -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Organisation</h6>
                <div class="d-flex flex-column gap-3">

                    <div class="d-flex align-items-center justify-content-between">
                        <span style="font-size:12px;color:var(--text-muted);font-weight:500">Status</span>
                        <span class="badge-status badge-active">Active</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <span style="font-size:12px;color:var(--text-muted);font-weight:500">Category</span>
                        <span style="font-size:13px;font-weight:600">Electronics</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <span style="font-size:12px;color:var(--text-muted);font-weight:500">Vendor</span>
                        <span style="font-size:13px;font-weight:600">TechWorld Ltd</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <span style="font-size:12px;color:var(--text-muted);font-weight:500">SKU</span>
                        <span style="font-size:13px;font-weight:600;font-family:monospace">IP15-001</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <span style="font-size:12px;color:var(--text-muted);font-weight:500">Track Inventory</span>
                        <span style="font-size:13px;font-weight:600">Yes</span>
                    </div>

                </div>
            </div>
        </div>

        <!-- Pricing -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Pricing</h6>
                <div class="d-flex align-items-end gap-2 mb-3">
                    <span style="font-size:28px;font-weight:800;line-height:1">$19.99</span>
                    <span style="font-size:15px;color:var(--text-muted);text-decoration:line-through;margin-bottom:3px">$24.99</span>
                    <span style="font-size:11px;font-weight:700;padding:2px 7px;border-radius:5px;background:#dcfce7;color:#15803d;margin-bottom:4px">-20%</span>
                </div>
                <div class="d-flex justify-content-between" style="font-size:12px;color:var(--text-muted)">
                    <span>Regular price</span><span style="font-weight:600;color:var(--text-primary)">$24.99</span>
                </div>
                <hr style="border-color:var(--border);margin:8px 0">
                <div class="d-flex justify-content-between" style="font-size:12px;color:var(--text-muted)">
                    <span>Sale price</span><span style="font-weight:600;color:var(--text-primary)">$19.99</span>
                </div>
            </div>
        </div>

        <!-- Stock Summary -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Stock Summary</h6>
                <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                    <span style="color:var(--text-muted)">Total Stock</span>
                    <span style="font-weight:700">168 units</span>
                </div>
                <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                    <span style="color:var(--text-muted)">Total Variants</span>
                    <span style="font-weight:700">8</span>
                </div>
                <div class="d-flex justify-content-between mb-3" style="font-size:13px">
                    <span style="color:var(--text-muted)">Out of Stock</span>
                    <span style="font-weight:700;color:#dc2626">1 variant</span>
                </div>
                <!-- Stock bar -->
                <div style="background:var(--surface2);border-radius:99px;height:7px;overflow:hidden">
                    <div style="width:82%;height:100%;border-radius:99px;background:linear-gradient(90deg,#22c55e,#86efac)"></div>
                </div>
                <p style="font-size:11px;color:var(--text-muted);margin:5px 0 0">82% in stock across all variants</p>
            </div>
        </div>

        <!-- Meta -->
        <div class="card">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Meta</h6>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Created</span>
                        <span style="font-weight:600">12 Mar 2025</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Last Updated</span>
                        <span style="font-weight:600">15 Mar 2025</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Total Orders</span>
                        <span style="font-weight:600">247</span>
                    </div>
                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Total Revenue</span>
                        <span style="font-weight:600">$4,928.53</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection