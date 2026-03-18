@extends('admin.layout.app')

@section('title', 'Add Product')

@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Add New Product</h1>
            <p class="page-subtitle">Fill in the details below to create a new product.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" name="status_action" value="draft" class="btn btn-outline-custom">
                Save as Draft
            </button>
            <button type="submit" name="status_action" value="active" class="btn btn-primary-custom">
                <i class="bi bi-cloud-upload me-1"></i>Publish Product
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
                            value="{{ old('name') }}"
                            placeholder="e.g. Marble Tile Pro">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Description</label>
                        <textarea name="description" rows="5"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Product description…">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-0">
                        <label class="form-label-custom">Tags</label>
                        <input type="text" name="tags"
                            class="form-control @error('tags') is-invalid @enderror"
                            value="{{ old('tags') }}"
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
                                value="{{ old('sku') }}"
                                placeholder="e.g. MRB-001">
                            @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label-custom">Stock Quantity</label>
                            <input type="number" name="stock" min="0"
                                class="form-control @error('stock') is-invalid @enderror"
                                value="{{ old('stock', 0) }}">
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
                        <select id="variantCountSelect" class="form-select form-select-sm" style="width:auto;min-width:160px">
                            <option value="0">No variants</option>
                            @for($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}">{{ $i }} variant{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                        </select>
                    </div>

                    <div id="variantsWrapper" class="d-none">
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
                            class="btn btn-sm btn-outline-custom mt-2"
                            style="font-size:12px">
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
                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-0">
                        <label class="form-label-custom">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            @foreach(['active' => 'Active', 'draft' => 'Draft', 'inactive' => 'Inactive'] as $val => $label)
                            <option value="{{ $val }}" {{ old('status', 'active') === $val ? 'selected' : '' }}>
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

                    <div id="mainImagePreview" class="d-none position-relative mb-2"
                        style="border-radius:10px;overflow:hidden;border:1.5px solid var(--border)">
                        <img id="mainImageImg" src="" alt="Main"
                            style="width:100%;height:180px;object-fit:cover;display:block">
                        <button type="button" id="removeMainImage"
                            style="position:absolute;top:6px;right:6px;width:26px;height:26px;border-radius:50%;background:rgba(0,0,0,.55);border:none;color:#fff;font-size:13px;display:flex;align-items:center;justify-content:center;cursor:pointer;line-height:1">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>

                    <label id="mainImageZone"
                        class="upload-zone d-flex flex-column align-items-center justify-content-center"
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

                    <div id="galleryGrid" class="d-flex flex-wrap gap-2 mb-2"></div>

                    {{-- Hidden inputs container — actual files submitted here --}}
                    <div id="galleryInputsContainer"></div>

                    <label class="upload-zone d-flex flex-column align-items-center justify-content-center"
                        style="cursor:pointer;padding:20px">
                        <i class="bi bi-images" style="font-size:26px;color:var(--text-muted)"></i>
                        <p style="font-size:12px;color:var(--text-muted);margin:8px 0 0">
                            Click to add images or one video (mp4)
                        </p>
                        <input type="file" id="galleryInput"
                            accept="image/*,video/mp4,video/webm,video/ogg"
                            multiple class="d-none">
                    </label>
                </div>
            </div>

        </div>
    </div>
</form>


<script>
    // ── Data from DB ──────────────────────────────────────────────────────────────
    const SIZES = @json($sizes -> map(fn($s) => ['id' => $s -> id, 'name' => $s -> name]));
    const COLORS = @json($colors -> map(fn($c) => ['id' => $c -> id, 'name' => $c -> name, 'hex' => $c -> hex]));

    // ── Variant helpers ───────────────────────────────────────────────────────────
    function sizeOptions(selected = '') {
        return `<option value="">Select Size</option>` +
            SIZES.map(s => `<option value="${s.id}" ${s.id == selected ? 'selected' : ''}>${s.name}</option>`).join('');
    }

    function colorOptions(selected = '') {
        return `<option value="">Select Color</option>` +
            COLORS.map(c => `<option value="${c.id}" ${c.id == selected ? 'selected' : ''}>${c.name}</option>`).join('');
    }

    function buildVariantRow(index) {
        const row = document.createElement('div');
        row.className = 'variant-row d-grid align-items-center gap-2 mb-2';
        row.style.cssText = 'grid-template-columns:1fr 1fr 120px 36px';
        row.innerHTML = `
        <select class="form-select form-select-sm" name="variants[${index}][size_id]">
            ${sizeOptions()}
        </select>
        <select class="form-select form-select-sm" name="variants[${index}][color_id]">
            ${colorOptions()}
        </select>
        <input type="number" class="form-control form-control-sm"
            name="variants[${index}][price]"
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

    function renderVariants(count) {
        const wrapper = document.getElementById('variantsWrapper');
        const rows = document.getElementById('variantRows');
        rows.innerHTML = '';
        if (count === 0) {
            wrapper.classList.add('d-none');
            return;
        }
        wrapper.classList.remove('d-none');
        for (let i = 0; i < count; i++) {
            rows.appendChild(buildVariantRow(i));
        }
    }

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

    mainImageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;
        mainImageImg.src = URL.createObjectURL(file);
        mainImagePreview.classList.remove('d-none');
        mainImageZone.classList.add('d-none');
    });

    document.getElementById('removeMainImage').addEventListener('click', function() {
        mainImageInput.value = '';
        mainImageImg.src = '';
        mainImagePreview.classList.add('d-none');
        mainImageZone.classList.remove('d-none');
    });


    // ── Gallery Images + Video ────────────────────────────────────────────────────
    const galleryInput = document.getElementById('galleryInput');
    const galleryGrid = document.getElementById('galleryGrid');
    const galleryInputsContainer = document.getElementById('galleryInputsContainer');
    let galleryFiles = []; // track all added files

    galleryInput.addEventListener('change', function() {
        Array.from(this.files).forEach(file => {
            const isVideo = file.type.startsWith('video/');

            // Prevent more than 1 video
            if (isVideo && galleryFiles.some(f => f.type.startsWith('video/'))) {
                showToast('error', 'Only one video is allowed in the gallery.');
                return;
            }

            const index = galleryFiles.length;
            galleryFiles.push(file);

            // Preview tile
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
                galleryFiles[index] = null; // null out, keep indexes stable
                wrap.remove();
                rebuildGalleryInputs();
            });

            galleryGrid.appendChild(wrap);
            rebuildGalleryInputs();
        });

        this.value = ''; // reset picker so same file can be re-selected
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


    // ── Draft / Publish buttons set the status field ─────────────────────────────
    document.querySelectorAll('[name="status_action"]').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelector('[name="status"]').value = this.value;
        });
    });
</script>

@endsection