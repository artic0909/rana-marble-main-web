@extends('admin.layout.app')

@section('title', 'Product — ' . $product->name)

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h1 class="page-title mb-0">{{ $product->name }}</h1>
            <p class="page-subtitle mb-0">
                SKU: {{ $product->sku }}
                &nbsp;·&nbsp;
                Added {{ $product->created_at->format('d M Y') }}
            </p>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.products.edit', $product->id) }}"
            class="btn btn-sm btn-outline-custom">
            <i class="bi bi-pencil me-1"></i>Edit
        </a>
        <form action="{{ route('admin.products.delete', $product->id) }}" method="POST"
            onsubmit="return confirm('Delete {{ addslashes($product->name) }}? This cannot be undone.')">
            @csrf
            <button type="submit" class="btn btn-sm"
                style="background:#fee2e2;color:#dc2626;border-radius:8px;padding:5px 14px;border:none;font-size:13px;font-weight:500">
                <i class="bi bi-trash me-1"></i>Delete
            </button>
        </form>
    </div>
</div>

<div class="row g-3">

    {{-- ── LEFT ── --}}
    <div class="col-12 col-lg-8">

        {{-- Images --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Product Images</h6>
                <div class="d-flex gap-3 flex-wrap align-items-start">

                    {{-- Main image --}}
                    <div style="flex:1;min-width:220px;border-radius:12px;overflow:hidden;border:1.5px solid var(--border);background:var(--surface2)">
                        @if($product->main_image)
                            <img src="{{ Storage::url($product->main_image) }}"
                                alt="{{ $product->name }}"
                                style="width:100%;height:260px;object-fit:cover;display:block"
                                id="mainDisplay">
                        @else
                            <div style="width:100%;height:260px;display:flex;align-items:center;justify-content:center">
                                <i class="bi bi-box" style="font-size:48px;color:var(--text-muted)"></i>
                            </div>
                        @endif
                    </div>

                    {{-- Gallery thumbnails --}}
                    @if($product->images->count())
                    <div class="d-flex flex-column gap-2">
                        @foreach($product->images as $img)
                            <div style="width:72px;height:72px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:var(--surface2);cursor:pointer"
                                onclick="swapMain('{{ Storage::url($img->image) }}', {{ $img->type === 'video' ? 'true' : 'false' }})">

                                @if($img->type === 'video')
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#000;position:relative">
                                        <video src="{{ Storage::url($img->image) }}"
                                            style="width:100%;height:100%;object-fit:cover;display:block" muted></video>
                                        <i class="bi bi-play-circle-fill"
                                            style="position:absolute;color:#fff;font-size:20px"></i>
                                    </div>
                                @else
                                    <img src="{{ Storage::url($img->image) }}"
                                        style="width:100%;height:100%;object-fit:cover;display:block">
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- Basic Info --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Basic Information</h6>

                <div class="mb-3">
                    <p style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Product Name</p>
                    <p style="font-size:14px;font-weight:600;margin:0">{{ $product->name }}</p>
                </div>

                <div class="mb-3">
                    <p style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px">Description</p>
                    <p style="font-size:13px;line-height:1.7;color:var(--text-muted);margin:0">
                        {{ $product->description ?? '—' }}
                    </p>
                </div>

                @if($product->tags)
                <div>
                    <p style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">Tags</p>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach(explode(',', $product->tags) as $tag)
                            <span style="font-size:12px;font-weight:500;padding:3px 10px;border-radius:20px;background:var(--surface2);border:1.5px solid var(--border);color:var(--text-muted)">
                                {{ trim($tag) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Variants Table --}}
        <div class="card">
            <div class="card-body p-0">
                <div class="px-3 py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="card-title-sm mb-0">Variants</h6>
                    <span style="font-size:12px;color:var(--text-muted)">
                        {{ $product->variants->count() }} total
                    </span>
                </div>

                @if($product->variants->count())
                <div class="overflow-x-auto">
                    <table class="table table-custom table-hover mb-0">
                        <thead style="background:var(--surface2)">
                            <tr>
                                <th style="padding-left:16px">#</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->variants as $i => $variant)
                            <tr>
                                <td style="padding-left:16px;color:var(--text-muted);font-size:12px">
                                    {{ $i + 1 }}
                                </td>
                                <td>
                                    @if($variant->size)
                                        <span style="font-size:12px;font-weight:600;padding:2px 9px;border-radius:6px;background:var(--surface2);border:1.5px solid var(--border)">
                                            {{ $variant->size->name }}
                                        </span>
                                    @else
                                        <span style="color:var(--text-muted);font-size:12px">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($variant->color)
                                        <div class="d-flex align-items-center gap-2">
                                            <span style="width:13px;height:13px;border-radius:50%;display:inline-block;border:1.5px solid var(--border);background:{{ $variant->color->hex }}"></span>
                                            <span style="font-size:13px">{{ $variant->color->name }}</span>
                                        </div>
                                    @else
                                        <span style="color:var(--text-muted);font-size:12px">—</span>
                                    @endif
                                </td>
                                <td style="font-weight:600;font-size:13px">
                                    ${{ number_format($variant->price, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="text-center py-4">
                        <span style="font-size:13px;color:var(--text-muted)">No variants added.</span>
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- ── RIGHT ── --}}
    <div class="col-12 col-lg-4">

        {{-- Organisation --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Organisation</h6>
                <div class="d-flex flex-column gap-3">

                    <div class="d-flex align-items-center justify-content-between">
                        <span style="font-size:12px;color:var(--text-muted);font-weight:500">Status</span>
                        <span class="badge-status badge-{{ $product->status }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <span style="font-size:12px;color:var(--text-muted);font-weight:500">Category</span>
                        <span style="font-size:13px;font-weight:600">
                            {{ $product->category->name ?? '—' }}
                        </span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <span style="font-size:12px;color:var(--text-muted);font-weight:500">SKU</span>
                        <span style="font-size:13px;font-weight:600;font-family:monospace">
                            {{ $product->sku }}
                        </span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <span style="font-size:12px;color:var(--text-muted);font-weight:500">Stock</span>
                        <span style="font-size:13px;font-weight:700;color:{{ $product->stock > 10 ? '#16a34a' : ($product->stock > 0 ? '#d97706' : '#dc2626') }}">
                            {{ $product->stock }} units
                        </span>
                    </div>

                </div>
            </div>
        </div>

        {{-- Pricing --}}
        @if($product->variants->count())
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Pricing</h6>

                @php
                    $prices = $product->variants->pluck('price');
                    $minPrice = $prices->min();
                    $maxPrice = $prices->max();
                @endphp

                <div class="mb-2">
                    <span style="font-size:26px;font-weight:800;line-height:1">
                        ₹{{ number_format($minPrice, 2) }}
                    </span>
                    @if($minPrice != $maxPrice)
                        <span style="font-size:15px;color:var(--text-muted)">
                            — ₹{{ number_format($maxPrice, 2) }}
                        </span>
                    @endif
                </div>

                <p style="font-size:12px;color:var(--text-muted);margin:0">
                    {{ $product->variants->count() }} variant{{ $product->variants->count() > 1 ? 's' : '' }}
                    across
                    {{ $product->variants->pluck('size_id')->filter()->unique()->count() }} size(s),
                    {{ $product->variants->pluck('color_id')->filter()->unique()->count() }} color(s)
                </p>
            </div>
        </div>
        @endif

        {{-- Stock Summary --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Stock Summary</h6>

                <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                    <span style="color:var(--text-muted)">Total Stock</span>
                    <span style="font-weight:700">{{ $product->stock }} units</span>
                </div>

                <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                    <span style="color:var(--text-muted)">Total Variants</span>
                    <span style="font-weight:700">{{ $product->variants->count() }}</span>
                </div>

                <div class="d-flex justify-content-between mb-2" style="font-size:13px">
                    <span style="color:var(--text-muted)">Gallery Images</span>
                    <span style="font-weight:700">
                        {{ $product->images->where('type', 'image')->count() }}
                    </span>
                </div>

                <div class="d-flex justify-content-between mb-3" style="font-size:13px">
                    <span style="color:var(--text-muted)">Video</span>
                    <span style="font-weight:700">
                        {{ $product->images->where('type', 'video')->count() ? 'Yes' : 'No' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Meta --}}
        <div class="card">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Meta</h6>
                <div class="d-flex flex-column gap-2">

                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Created</span>
                        <span style="font-weight:600">{{ $product->created_at->format('d M Y') }}</span>
                    </div>

                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Last Updated</span>
                        <span style="font-weight:600">{{ $product->updated_at->format('d M Y') }}</span>
                    </div>

                    <div class="d-flex justify-content-between" style="font-size:12px">
                        <span style="color:var(--text-muted)">Product ID</span>
                        <span style="font-weight:600;font-family:monospace">#{{ $product->id }}</span>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


<script>
    // Swap main display when thumbnail clicked
    function swapMain(src, isVideo) {
        const container = document.getElementById('mainDisplay')?.parentElement;
        if (!container) return;

        if (isVideo) {
            container.innerHTML = `
                <video src="${src}" controls
                    style="width:100%;height:260px;object-fit:cover;display:block"
                    id="mainDisplay">
                </video>`;
        } else {
            container.innerHTML = `
                <img src="${src}" id="mainDisplay"
                    style="width:100%;height:260px;object-fit:cover;display:block">`;
        }
    }
</script>

@endsection