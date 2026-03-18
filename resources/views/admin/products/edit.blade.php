@extends('admin.layout.app')

@section('title', 'Edit — ' . $product->name)

@section('content')
<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Edit Product</h1>
            <p class="page-subtitle">Update the details for <strong>{{ $product->name }}</strong>.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" name="status_action" value="draft" class="btn btn-outline-custom">
                Save as Draft
            </button>
            <button type="submit" name="status_action" value="active" class="btn btn-primary-custom">
                <i class="bi bi-cloud-upload me-1"></i>Update Product
            </button>
        </div>
    </div>

    <div class="row g-3">

        {{-- ── LEFT COLUMN ── --}}
        <div class="col-12 col-md-8">

            {{-- Basic Information --}}
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Basic Information</h6>

                    <div class="mb-3">
                        <label class="form-label-custom">Product Name *</label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $product->name) }}"
                            placeholder="e.g. Marble Tile Pro">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Description</label>
                        <textarea name="description" rows="5"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Product description…">{{ old('description', $product->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-0">
                        <label class="form-label-custom">Tags</label>
                        <input type="text" name="tags"
                            class="form-control @error('tags') is-invalid @enderror"
                            value="{{ old('tags', $product->tags) }}"
                            placeholder="e.g. marble, flooring, premium (comma separated)">
                        @error('tags') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- Inventory --}}
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Inventory</h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label-custom">SKU *</label>
                            <input type="text" name="sku"
                                class="form-control @error('sku') is-invalid @enderror"
                                value="{{ old('sku', $product->sku) }}"
                                placeholder="e.g. MRB-001">
                            @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label-custom">Stock Quantity</label>
                            <input type="number" name="stock" min="0"
                                class="form-control @error('stock') is-invalid @enderror"
                                value="{{ old('stock', $product->stock) }}">
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Variants --}}
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="card-title-sm mb-0">Product Variants</h6>
                        <select id="variantCountSelect" class="form-select form-select-sm"
                            style="width:auto;min-width:160px">
                            <option value="0">No variants</option>
                            @for($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}"
                                {{ $product->variants->count() === $i ? 'selected' : '' }}>
                                {{ $i }} variant{{ $i > 1 ? 's' : '' }}
                                </option>
                                @endfor
                        </select>
                    </div>

                    <div id="variantsWrapper"
                        class="{{ $product->variants->count() ? '' : 'd-none' }}">
                        <p style="font-size:12px;color:var(--text-muted)" class="mb-3">
                            Fill in size, color and price for each variant below.
                        </p>

                        <div class="d-none d-md-grid mb-2"
                            style="grid-template-columns:1fr 1fr 120px 36px;gap:8px;padding:0 4px">
                            <span style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px">Size</span>
                            <span style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px">Color</span>
                            <span style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px">Price</span>
                            <span></span>
                        </div>

                        <div id="variantRows"></div>

                        <button type="button" id="addVariantRowBtn"
                            class="btn btn-sm btn-outline-custom mt-2" style="font-size:12px">
                            <i class="bi bi-plus-lg me-1"></i>Add Another
                        </button>
                    </div>
                </div>
            </div>

        </div>

        {{-- ── RIGHT COLUMN ── --}}
        <div class="col-12 col-md-4">

            {{-- Organisation --}}
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Organisation</h6>

                    <div class="mb-3">
                        <label class="form-label-custom">Category *</label>
                        <select name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-0">
                        <label class="form-label-custom">Status</label>
                        <select name="status"
                            class="form-select @error('status') is-invalid @enderror">
                            @foreach(['active' => 'Active', 'draft' => 'Draft', 'inactive' => 'Inactive'] as $val => $label)
                            <option value="{{ $val }}"
                                {{ old('status', $product->status) === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- Main Image --}}
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Main Image</h6>

                    {{-- Show existing image --}}
                    <div id="mainImagePreview"
                        class="{{ $product->main_image ? '' : 'd-none' }} position-relative mb-2"
                        style="border-radius:10px;overflow:hidden;border:1.5px solid var(--border)">
                        <img id="mainImageImg"
                            src="{{ $product->main_image ? Storage::url($product->main_image) : '' }}"
                            alt="Main"
                            style="width:100%;height:180px;object-fit:cover;display:block">
                        <button type="button" id="removeMainImage"
                            style="position:absolute;top:6px;right:6px;width:26px;height:26px;border-radius:50%;background:rgba(0,0,0,.55);border:none;color:#fff;font-size:13px;display:flex;align-items:center;justify-content:center;cursor:pointer;line-height:1">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>

                    {{-- Hidden flag: tell controller to remove existing image --}}
                    <input type="hidden" name="remove_main_image" id="removeMainImageFlag" value="0">

                    <label id="mainImageZone"
                        class="upload-zone d-flex flex-column align-items-center justify-content-center {{ $product->main_image ? 'd-none' : '' }}"
                        style="cursor:pointer;padding:24px">
                        <i class="bi bi-image" style="font-size:28px;color:var(--text-muted)"></i>
                        <p style="font-size:12px;color:var(--text-muted);margin:8px 0 0">Click to upload main image</p>
                        <input type="file" name="main_image" id="mainImageInput" accept="image/*" class="d-none">
                    </label>
                </div>
            </div>

            {{-- Gallery --}}
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title-sm mb-3">Gallery Images & Video</h6>

                    {{-- Existing gallery items --}}
                    <div id="galleryGrid" class="d-flex flex-wrap gap-2 mb-2">
                        @foreach($product->images as $img)
                        <div class="position-relative existing-gallery-tile"
                            data-id="{{ $img->id }}"
                            style="width:70px;height:70px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border)">

                            @if($img->type === 'video')
                            <video src="{{ Storage::url($img->image) }}"
                                style="width:100%;height:100%;object-fit:cover;display:block" muted></video>
                            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.3)">
                                <i class="bi bi-play-circle-fill" style="color:#fff;font-size:22px"></i>
                            </div>
                            @else
                            <img src="{{ Storage::url($img->image) }}"
                                style="width:100%;height:100%;object-fit:cover;display:block">
                            @endif

                            <button type="button" class="existing-remove-btn"
                                style="position:absolute;top:3px;right:3px;width:20px;height:20px;border-radius:50%;background:rgba(0,0,0,.6);border:none;color:#fff;font-size:11px;display:flex;align-items:center;justify-content:center;cursor:pointer;padding:0;line-height:1">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>

                    {{-- Hidden inputs for images to delete --}}
                    <div id="deleteImagesContainer"></div>

                    {{-- New uploads --}}
                    <div id="galleryInputsContainer"></div>

                    <label class="upload-zone d-flex flex-column align-items-center justify-content-center"
                        style="cursor:pointer;padding:20px;margin-top:8px">
                        <i class="bi bi-images" style="font-size:26px;color:var(--text-muted)"></i>
                        <p style="font-size:12px;color:var(--text-muted);margin:8px 0 0">
                            Click to add more images or video
                        </p>
                        <input type="file" id="galleryInput"
                            accept="image/*,video/mp4,video/webm,video/ogg"
                            multiple class="d-none">
                    </label>
                </div>
            </div>

        </div>
    </div>

    {{-- ── SEO ── --}}
    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="card-title-sm mb-0">SEO</h6>
                <span style="font-size:11px;color:var(--text-muted)">Optional — improves search visibility</span>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Meta Title</label>
                <input type="text" name="meta_title" id="seoMetaTitle"
                    class="form-control @error('meta_title') is-invalid @enderror"
                    value="{{ old('meta_title', $product->meta_title ?? '') }}"
                    placeholder="e.g. Buy Red Marble Mandir Online — Rana Marble"
                    maxlength="60">
                @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <p style="font-size:11px;color:var(--text-muted);margin-top:4px">
                    Recommended: 50–60 characters.
                    <span id="metaTitleCount" style="font-weight:600">0</span> / 60
                </p>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Meta Description</label>
                <textarea name="meta_description" id="seoMetaDesc" rows="3"
                    class="form-control @error('meta_description') is-invalid @enderror"
                    placeholder="Brief description shown in Google search results…"
                    maxlength="160">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <p style="font-size:11px;color:var(--text-muted);margin-top:4px">
                    Recommended: 150–160 characters.
                    <span id="metaDescCount" style="font-weight:600">0</span> / 160
                </p>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Keywords</label>
                <input type="text" name="meta_keywords"
                    class="form-control"
                    value="{{ old('meta_keywords', $product->meta_keywords ?? '') }}"
                    placeholder="marble, mandir, handcraft (comma separated)">
            </div>

            <div class="mb-3">
                <label class="form-label-custom">OG Image URL
                    <span style="font-size:11px;font-weight:400;color:var(--text-muted)">
                        — shown when shared on WhatsApp, Facebook etc.
                    </span>
                </label>
                <input type="text" name="og_image"
                    class="form-control @error('og_image') is-invalid @enderror"
                    value="{{ old('og_image', $product->og_image ?? '') }}"
                    placeholder="https://ranamarble.info/img/product.jpg">
                @error('og_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Live SERP Preview --}}
            <label class="form-label-custom">Search Result Preview</label>
            <div style="border:1.5px solid var(--border);border-radius:12px;padding:16px;background:var(--surface)">
                <div id="serpTitle"
                    style="font-size:17px;color:#1a0dab;font-weight:400;margin-bottom:2px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis">
                    {{ old('meta_title', $product->meta_title ?? 'Your product title') }}
                </div>
                <div style="font-size:12px;color:#006621;margin-bottom:4px">
                    ranamarble.info/products/...
                </div>
                <div id="serpDesc"
                    style="font-size:12px;color:#4d5156;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                    {{ old('meta_description', $product->meta_description ?? 'Your meta description will appear here.') }}
                </div>
            </div>

        </div>
    </div>
</form>


<script>
    // ── DB data ───────────────────────────────────────────────────────────────────
    const SIZES = @json($sizes -> map(fn($s) => ['id' => $s -> id, 'name' => $s -> name]));
    const COLORS = @json($colors -> map(fn($c) => ['id' => $c -> id, 'name' => $c -> name, 'hex' => $c -> hex]));

    // Existing variants pre-filled from DB
    const EXISTING_VARIANTS = @json($existingVariants);

    // ── Variant helpers ───────────────────────────────────────────────────────────
    function sizeOptions(selected = '') {
        return `<option value="">Select Size</option>` +
            SIZES.map(s => `<option value="${s.id}" ${s.id == selected ? 'selected' : ''}>${s.name}</option>`).join('');
    }

    function colorOptions(selected = '') {
        return `<option value="">Select Color</option>` +
            COLORS.map(c => `<option value="${c.id}" ${c.id == selected ? 'selected' : ''}>${c.name}</option>`).join('');
    }

    function buildVariantRow(index, data = {}) {
        const row = document.createElement('div');
        row.className = 'variant-row d-grid align-items-center gap-2 mb-2';
        row.style.cssText = 'grid-template-columns:1fr 1fr 120px 36px';
        row.innerHTML = `
        <select class="form-select form-select-sm" name="variants[${index}][size_id]">
            ${sizeOptions(data.size_id ?? '')}
        </select>
        <select class="form-select form-select-sm" name="variants[${index}][color_id]">
            ${colorOptions(data.color_id ?? '')}
        </select>
        <input type="number" class="form-control form-control-sm"
            name="variants[${index}][price]"
            value="${data.price ?? ''}"
            placeholder="0.00" min="0" step="0.01">
        <button type="button" class="btn btn-sm remove-variant-row d-flex align-items-center justify-content-center"
            style="background:#fee2e2;color:#dc2626;border-radius:7px;width:34px;height:34px;padding:0;border:none">
            <i class="bi bi-x" style="font-size:16px"></i>
        </button>`;
        row.querySelector('.remove-variant-row').addEventListener('click', () => {
            row.remove();
            reindexVariants();
        });
        return row;
    }

    function reindexVariants() {
        document.querySelectorAll('.variant-row').forEach((row, i) => {
            row.querySelectorAll('[name]').forEach(el => {
                el.name = el.name.replace(/variants\[\d+\]/, `variants[${i}]`);
            });
        });
    }

    function renderVariants(count, prefill = []) {
        const wrapper = document.getElementById('variantsWrapper');
        const rows = document.getElementById('variantRows');
        rows.innerHTML = '';
        if (count === 0) {
            wrapper.classList.add('d-none');
            return;
        }
        wrapper.classList.remove('d-none');
        for (let i = 0; i < count; i++) {
            rows.appendChild(buildVariantRow(i, prefill[i] ?? {}));
        }
    }

    // Pre-fill existing variants on page load
    renderVariants(EXISTING_VARIANTS.length, EXISTING_VARIANTS);

    document.getElementById('variantCountSelect').addEventListener('change', function() {
        renderVariants(parseInt(this.value));
    });

    document.getElementById('addVariantRowBtn').addEventListener('click', function() {
        const rows = document.getElementById('variantRows');
        rows.appendChild(buildVariantRow(rows.children.length));
        reindexVariants();
    });


    // ── Main Image ────────────────────────────────────────────────────────────────
    const mainImageInput = document.getElementById('mainImageInput');
    const mainImagePreview = document.getElementById('mainImagePreview');
    const mainImageImg = document.getElementById('mainImageImg');
    const mainImageZone = document.getElementById('mainImageZone');
    const removeFlag = document.getElementById('removeMainImageFlag');

    mainImageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;
        mainImageImg.src = URL.createObjectURL(file);
        mainImagePreview.classList.remove('d-none');
        mainImageZone.classList.add('d-none');
        removeFlag.value = '0';
    });

    document.getElementById('removeMainImage').addEventListener('click', function() {
        mainImageInput.value = '';
        mainImageImg.src = '';
        mainImagePreview.classList.add('d-none');
        mainImageZone.classList.remove('d-none');
        removeFlag.value = '1'; // tell controller to delete existing
    });


    // ── Existing gallery — delete on X click ─────────────────────────────────────
    document.querySelectorAll('.existing-remove-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tile = this.closest('.existing-gallery-tile');
            const id = tile.dataset.id;

            // Add hidden input so controller knows to delete this image
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'delete_images[]';
            hidden.value = id;
            document.getElementById('deleteImagesContainer').appendChild(hidden);

            tile.remove();
        });
    });


    // ── New gallery uploads ───────────────────────────────────────────────────────
    const galleryInput = document.getElementById('galleryInput');
    const galleryGrid = document.getElementById('galleryGrid');
    const galleryInputsContainer = document.getElementById('galleryInputsContainer');
    let galleryFiles = [];

    galleryInput.addEventListener('change', function() {
        Array.from(this.files).forEach(file => {
            const isVideo = file.type.startsWith('video/');

            const existingVideos = [...document.querySelectorAll('.existing-gallery-tile')]
                .filter(t => t.querySelector('video'));
            const newVideos = galleryFiles.filter(f => f && f.type.startsWith('video/'));

            if (isVideo && (existingVideos.length + newVideos.length) >= 1) {
                showToast('error', 'Only one video is allowed in the gallery.');
                return;
            }

            const index = galleryFiles.length;
            galleryFiles.push(file);

            const wrap = document.createElement('div');
            wrap.className = 'position-relative gallery-tile';
            wrap.dataset.index = index;
            wrap.style.cssText = 'width:70px;height:70px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border)';

            if (isVideo) {
                wrap.innerHTML = `
                <video src="${URL.createObjectURL(file)}"
                    style="width:100%;height:100%;object-fit:cover;display:block" muted></video>
                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.3)">
                    <i class="bi bi-play-circle-fill" style="color:#fff;font-size:22px"></i>
                </div>
                <button type="button" class="gallery-remove-btn"
                    style="position:absolute;top:3px;right:3px;width:20px;height:20px;border-radius:50%;background:rgba(0,0,0,.6);border:none;color:#fff;font-size:11px;display:flex;align-items:center;justify-content:center;cursor:pointer;padding:0;line-height:1">
                    <i class="bi bi-x"></i>
                </button>`;
            } else {
                wrap.innerHTML = `
                <img src="${URL.createObjectURL(file)}"
                    style="width:100%;height:100%;object-fit:cover;display:block">
                <button type="button" class="gallery-remove-btn"
                    style="position:absolute;top:3px;right:3px;width:20px;height:20px;border-radius:50%;background:rgba(0,0,0,.6);border:none;color:#fff;font-size:11px;display:flex;align-items:center;justify-content:center;cursor:pointer;padding:0;line-height:1">
                    <i class="bi bi-x"></i>
                </button>`;
            }

            wrap.querySelector('.gallery-remove-btn').addEventListener('click', () => {
                galleryFiles[index] = null;
                wrap.remove();
                rebuildGalleryInputs();
            });

            galleryGrid.appendChild(wrap);
            rebuildGalleryInputs();
        });
        this.value = '';
    });

    function rebuildGalleryInputs() {
        galleryInputsContainer.innerHTML = '';
        const dt = new DataTransfer();
        galleryFiles.filter(Boolean).forEach(file => dt.items.add(file));
        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'gallery[]';
        input.multiple = true;
        input.classList.add('d-none');
        input.files = dt.files;
        galleryInputsContainer.appendChild(input);
    }


    // ── SEO counters + live SERP preview ─────────────────────────────────────────
    const seoTitleInput = document.getElementById('seoMetaTitle');
    const seoDescInput = document.getElementById('seoMetaDesc');

    function updateSeoCounters() {
        if (seoTitleInput) {
            const len = seoTitleInput.value.length;
            document.getElementById('metaTitleCount').textContent = len;
            document.getElementById('metaTitleCount').style.color = len > 60 ? '#dc2626' : len >= 50 ? '#16a34a' : 'inherit';
            document.getElementById('serpTitle').textContent = seoTitleInput.value || 'Your product title';
        }
        if (seoDescInput) {
            const len = seoDescInput.value.length;
            document.getElementById('metaDescCount').textContent = len;
            document.getElementById('metaDescCount').style.color = len > 160 ? '#dc2626' : len >= 150 ? '#16a34a' : 'inherit';
            document.getElementById('serpDesc').textContent = seoDescInput.value || 'Your meta description will appear here.';
        }
    }

    seoTitleInput?.addEventListener('input', updateSeoCounters);
    seoDescInput?.addEventListener('input', updateSeoCounters);
    updateSeoCounters(); // run on load to populate counts for edit page


    // ── Draft / Publish ───────────────────────────────────────────────────────────
    document.querySelectorAll('[name="status_action"]').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelector('[name="status"]').value = this.value;
        });
    });
</script>

@endsection