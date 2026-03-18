@extends('admin.layout.app')

@section('title', 'All Products')

@section('content')

<div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="page-title">Products</h1>
        <p class="page-subtitle">Manage your product catalog.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary-custom">
        <i class="bi bi-plus-lg me-1"></i>Add Product
    </a>
</div>

{{-- ── FILTERS ── --}}
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.products.index') }}">
            <div class="row g-2">
                <div class="col-12 col-md-4">
                    <div class="topbar-search" style="max-width:100%">
                        <i class="bi bi-search"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search products…"
                            style="width:100%;border-radius:10px;padding:9px 14px 9px 38px;border:1.5px solid var(--border);font-size:14px;outline:none;background:var(--surface2);color:var(--text)">
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <select name="category" class="form-select" style="font-size:13px">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 col-md-2">
                    <select name="status" class="form-select" style="font-size:13px">
                        <option value="">All Status</option>
                        @foreach(['active' => 'Active', 'draft' => 'Draft', 'inactive' => 'Inactive'] as $val => $label)
                            <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 col-md-2">
                    <select name="sort" class="form-select" style="font-size:13px">
                        <option value="newest"     {{ request('sort','newest') === 'newest'     ? 'selected' : '' }}>Sort: Newest</option>
                        <option value="oldest"     {{ request('sort') === 'oldest'              ? 'selected' : '' }}>Sort: Oldest</option>
                        <option value="price_asc"  {{ request('sort') === 'price_asc'           ? 'selected' : '' }}>Price: Low–High</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc'          ? 'selected' : '' }}>Price: High–Low</option>
                        <option value="stock_asc"  {{ request('sort') === 'stock_asc'           ? 'selected' : '' }}>Stock: Low–High</option>
                    </select>
                </div>

                <div class="col-6 col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-outline-custom w-100">
                        <i class="bi bi-funnel me-1"></i>Filter
                    </button>
                    @if(request()->hasAny(['search','category','status','sort']))
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-custom px-2" title="Clear filters">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ── TABLE ── --}}
<div class="card">
    <div class="card-body p-0">
        <div class="overflow-x-auto">
            <table class="table table-custom table-hover mb-0">
                <thead style="background:var(--surface2)">
                    <tr>
                        <th style="padding-left:16px"><input type="checkbox" class="form-check-input" id="selectAll"></th>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Variants</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td style="padding-left:16px">
                            <input type="checkbox" class="form-check-input row-check" value="{{ $product->id }}">
                        </td>

                        {{-- Product name + image --}}
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($product->main_image)
                                    <img src="{{ Storage::url($product->main_image) }}"
                                        alt="{{ $product->name }}"
                                        class="product-img">
                                @else
                                    <div class="product-img-placeholder">
                                        <i class="bi bi-box"></i>
                                    </div>
                                @endif
                                <div>
                                    <div style="font-size:13px;font-weight:600">{{ $product->name }}</div>
                                    <div style="font-size:11px;color:var(--text-muted)">
                                        Added {{ $product->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- SKU --}}
                        <td style="font-size:13px">{{ $product->sku }}</td>

                        {{-- Category --}}
                        <td>
                            <span class="cat-pill">{{ $product->category->name ?? '—' }}</span>
                        </td>

                        {{-- Variants summary --}}
                        <td>
                            @if($product->variants->count())
                                <div style="font-size:12px;line-height:1.6">
                                    @foreach($product->variants->take(2) as $v)
                                        <span class="cat-pill" style="margin-bottom:2px">
                                            {{ $v->size->name ?? '—' }} /
                                            {{ $v->color->name ?? '—' }} —
                                            ${{ number_format($v->price, 2) }}
                                        </span><br>
                                    @endforeach
                                    @if($product->variants->count() > 2)
                                        <span style="font-size:11px;color:var(--text-muted)">
                                            +{{ $product->variants->count() - 2 }} more
                                        </span>
                                    @endif
                                </div>
                            @else
                                <span style="font-size:12px;color:var(--text-muted)">No variants</span>
                            @endif
                        </td>

                        {{-- Stock --}}
                        <td>
                            <span style="font-size:13px;font-weight:600;color:{{ $product->stock > 10 ? '#16a34a' : ($product->stock > 0 ? '#d97706' : '#dc2626') }}">
                                {{ $product->stock }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td>
                            <span class="badge-status badge-{{ $product->status }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.products.show', $product->id) }}"
                                    class="btn btn-sm"
                                    style="background:var(--surface2);border-radius:7px;padding:4px 8px;"
                                    title="View">
                                    <i class="bi bi-eye" style="font-size:13px"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                    class="btn btn-sm"
                                    style="background:var(--surface2);border-radius:7px;padding:4px 8px;"
                                    title="Edit">
                                    <i class="bi bi-pencil" style="font-size:13px"></i>
                                </a>
                                <form action="{{ route('admin.products.delete', $product->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete {{ addslashes($product->name) }}? This cannot be undone.')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm"
                                        style="background:#fee2e2;color:#dc2626;border-radius:7px;padding:4px 8px;"
                                        title="Delete">
                                        <i class="bi bi-trash" style="font-size:13px"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="bi bi-box-seam" style="font-size:36px;color:var(--text-muted);display:block;margin-bottom:10px"></i>
                            <span style="font-size:14px;color:var(--text-muted)">No products found.</span>
                            @if(request()->hasAny(['search','category','status']))
                                <div class="mt-2">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-custom">
                                        Clear filters
                                    </a>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ── PAGINATION ── --}}
        <div class="d-flex justify-content-between align-items-center px-3 py-3 border-top flex-wrap gap-2">
            <span style="font-size:13px;color:var(--text-muted)">
                Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}
                of {{ $products->total() }} products
            </span>
            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>


<script>
    // Select all checkbox
    document.getElementById('selectAll').addEventListener('change', function () {
        document.querySelectorAll('.row-check').forEach(cb => cb.checked = this.checked);
    });
</script>

@endsection