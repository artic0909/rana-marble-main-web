@extends('admin.layout.app')

@section('title', 'Add Product')

@section('content')

<div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="page-title">Add New Product</h1>
        <p class="page-subtitle">Fill in the details below to create a new product.</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-outline-custom">Save as Draft</button>
        <button type="button" class="btn btn-primary-custom"><i class="bi bi-cloud-upload me-1"></i>Publish Product</button>
    </div>
</div>

<div class="row g-3">

    <!-- Left Column -->
    <div class="col-12 col-md-8">

        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Basic Information</h6>
                <div class="mb-3">
                    <label class="form-label-custom">Product Name *</label>
                    <input type="text" class="form-control" placeholder="e.g. iPhone 15 Case Pro">
                </div>
                <div class="mb-3">
                    <label class="form-label-custom">Description</label>
                    <textarea class="form-control" rows="5" placeholder="Product description…"></textarea>
                </div>
                <div class="mb-0">
                    <label class="form-label-custom">Tags</label>
                    <input type="text" class="form-control" placeholder="e.g. case, protection, apple (comma separated)">
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Pricing</h6>
                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label-custom">Regular Price ($) *</label>
                        <input type="number" class="form-control" placeholder="0.00">
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Sale Price ($)</label>
                        <input type="number" class="form-control" placeholder="0.00">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Inventory</h6>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label-custom">SKU *</label>
                        <input type="text" class="form-control" placeholder="e.g. IP15-001">
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Stock Quantity</label>
                        <input type="number" class="form-control" placeholder="0">
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 p-2 rounded-3" style="border:1.5px solid var(--border)">
                    <input class="form-check-input" type="checkbox" checked>
                    <label style="font-size:13px;font-weight:500">Track inventory</label>
                </div>
            </div>
        </div>

        <!-- ── VARIANTS CARD ─────────────────────────────────── -->
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

                    <!-- Header row (desktop) -->
                    <div class="d-none d-md-grid mb-2" style="grid-template-columns:1fr 1fr 120px 36px;gap:8px;padding:0 4px">
                        <span style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px">Size</span>
                        <span style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px">Color</span>
                        <span style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px">Price ($)</span>
                        <span></span>
                    </div>

                    <div id="variantRows"></div>

                    <button type="button" id="addVariantRowBtn"
                        class="btn btn-sm btn-outline-custom mt-2 d-none"
                        style="font-size:12px">
                        <i class="bi bi-plus-lg me-1"></i>Add Another
                    </button>
                </div>
            </div>
        </div>
        <!-- ── END VARIANTS CARD ─────────────────────────────── -->

    </div>

    <!-- Right Column -->
    <div class="col-12 col-md-4">

        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Organisation</h6>
                <div class="mb-3">
                    <label class="form-label-custom">Category *</label>
                    <select class="form-select">
                        <option>Select Category</option>
                        <option>Electronics</option>
                        <option>Fashion</option>
                        <option>Home</option>
                        <option>Sports</option>
                        <option>Books</option>
                    </select>
                </div>
                <div class="mb-0">
                    <label class="form-label-custom">Status</label>
                    <select class="form-select">
                        <option>Active</option>
                        <option>Draft</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- ── MAIN IMAGE ───────────────────────────────────── -->
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Main Image</h6>
                <div id="mainImagePreview" class="d-none position-relative mb-2" style="border-radius:10px;overflow:hidden;border:1.5px solid var(--border)">
                    <img id="mainImageImg" src="" alt="Main" style="width:100%;height:180px;object-fit:cover;display:block">
                    <button type="button" id="removeMainImage"
                        style="position:absolute;top:6px;right:6px;width:26px;height:26px;border-radius:50%;background:rgba(0,0,0,.55);border:none;color:#fff;font-size:13px;display:flex;align-items:center;justify-content:center;cursor:pointer;line-height:1">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
                <label id="mainImageZone" class="upload-zone d-flex flex-column align-items-center justify-content-center" style="cursor:pointer;padding:24px">
                    <i class="bi bi-image" style="font-size:28px;color:var(--text-muted)"></i>
                    <p style="font-size:12px;color:var(--text-muted);margin:8px 0 0">Click to upload main image</p>
                    <input type="file" id="mainImageInput" accept="image/*" class="d-none">
                </label>
            </div>
        </div>
        <!-- ── END MAIN IMAGE ───────────────────────────────── -->

        <!-- ── GALLERY IMAGES ──────────────────────────────── -->
        <div class="card">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Gallery Images</h6>

                <div id="galleryGrid" class="d-flex flex-wrap gap-2 mb-2"></div>

                <label class="upload-zone d-flex flex-column align-items-center justify-content-center" style="cursor:pointer;padding:20px">
                    <i class="bi bi-images" style="font-size:26px;color:var(--text-muted)"></i>
                    <p style="font-size:12px;color:var(--text-muted);margin:8px 0 0">Click to add gallery images</p>
                    <input type="file" id="galleryInput" accept="image/*" multiple class="d-none">
                </label>
            </div>
        </div>
        <!-- ── END GALLERY IMAGES ──────────────────────────── -->

    </div>
</div>


<script>
    // ══════════════════════════════════════════════════════
    //  VARIANTS
    // ══════════════════════════════════════════════════════
    const SIZES = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'One Size'];
    const COLORS = ['Red', 'Blue', 'Green', 'Black', 'White', 'Yellow', 'Pink', 'Purple', 'Orange', 'Gray'];

    const variantCountSelect = document.getElementById('variantCountSelect');
    const variantsWrapper = document.getElementById('variantsWrapper');
    const variantRows = document.getElementById('variantRows');

    function sizeOptions(selected = '') {
        return SIZES.map(s => `<option${s === selected ? ' selected' : ''}>${s}</option>`).join('');
    }

    function colorOptions(selected = '') {
        return COLORS.map(c => `<option${c === selected ? ' selected' : ''}>${c}</option>`).join('');
    }

    function buildVariantRow(index) {
        const row = document.createElement('div');
        row.className = 'variant-row d-grid align-items-center gap-2 mb-2';
        row.style.cssText = 'grid-template-columns:1fr 1fr 120px 36px';
        row.dataset.index = index;
        row.innerHTML = `
        <select class="form-select form-select-sm">
            <option value="" disabled selected>Size</option>
            ${sizeOptions()}
        </select>
        <select class="form-select form-select-sm">
            <option value="" disabled selected>Color</option>
            ${colorOptions()}
        </select>
        <input type="number" class="form-control form-control-sm" placeholder="0.00" min="0" step="0.01">
        <button type="button" class="btn btn-sm remove-variant-row d-flex align-items-center justify-content-center"
            style="background:#fee2e2;color:#dc2626;border-radius:7px;width:34px;height:34px;padding:0;border:none">
            <i class="bi bi-x" style="font-size:16px"></i>
        </button>`;
        row.querySelector('.remove-variant-row').addEventListener('click', () => row.remove());
        return row;
    }

    function renderVariants(count) {
        variantRows.innerHTML = '';
        if (count === 0) {
            variantsWrapper.classList.add('d-none');
            return;
        }
        variantsWrapper.classList.remove('d-none');
        for (let i = 0; i < count; i++) variantRows.appendChild(buildVariantRow(i));
    }

    variantCountSelect.addEventListener('change', function() {
        renderVariants(parseInt(this.value));
    });

    document.getElementById('addVariantRowBtn').addEventListener('click', function() {
        const newRow = buildVariantRow(variantRows.children.length);
        variantRows.appendChild(newRow);
    });


    // ══════════════════════════════════════════════════════
    //  MAIN IMAGE
    // ══════════════════════════════════════════════════════
    const mainImageInput = document.getElementById('mainImageInput');
    const mainImagePreview = document.getElementById('mainImagePreview');
    const mainImageImg = document.getElementById('mainImageImg');
    const mainImageZone = document.getElementById('mainImageZone');
    const removeMainImage = document.getElementById('removeMainImage');

    mainImageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;
        const url = URL.createObjectURL(file);
        mainImageImg.src = url;
        mainImagePreview.classList.remove('d-none');
        mainImageZone.classList.add('d-none');
    });

    removeMainImage.addEventListener('click', function() {
        mainImageInput.value = '';
        mainImageImg.src = '';
        mainImagePreview.classList.add('d-none');
        mainImageZone.classList.remove('d-none');
    });


    // ══════════════════════════════════════════════════════
    //  GALLERY IMAGES
    // ══════════════════════════════════════════════════════
    const galleryInput = document.getElementById('galleryInput');
    const galleryGrid = document.getElementById('galleryGrid');

    galleryInput.addEventListener('change', function() {
        Array.from(this.files).forEach(file => {
            const url = URL.createObjectURL(file);
            const wrap = document.createElement('div');
            wrap.className = 'position-relative';
            wrap.style.cssText = 'width:70px;height:70px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border)';
            wrap.innerHTML = `
            <img src="${url}" style="width:100%;height:100%;object-fit:cover;display:block">
            <button type="button"
                style="position:absolute;top:3px;right:3px;width:20px;height:20px;border-radius:50%;background:rgba(0,0,0,.6);border:none;color:#fff;font-size:11px;display:flex;align-items:center;justify-content:center;cursor:pointer;padding:0;line-height:1">
                <i class="bi bi-x"></i>
            </button>`;
            wrap.querySelector('button').addEventListener('click', () => wrap.remove());
            galleryGrid.appendChild(wrap);
        });
        this.value = ''; // reset so same file can be re-added if removed
    });
</script>

@endsection