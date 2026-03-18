@extends('admin.layout.app')

@section('title', 'Add Categories')

@section('content')
<!-- ══ 4. CATEGORIES ══ -->
<section class="page-section active" id="page-categories">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Categories</h1>
            <p class="page-subtitle">Organize products into categories.</p>
        </div>
        <button class="btn btn-sm btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="bi bi-plus-lg me-1"></i>Add Category
        </button>
    </div>

    <!-- Full Width Table Card -->
    <div class="card">
        <div class="card-body p-0">
            <div class="px-3 py-3 border-bottom">
                <h6 class="card-title-sm mb-0">All Categories</h6>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-custom table-hover mb-0">
                    <thead style="background:var(--surface2)">
                        <tr>
                            <th style="padding-left:16px">Category</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <span style="font-size:22px">🛕</span>
                                    <div>
                                        <div style="font-weight:600;font-size:13px">{{ $category->name }}</div>
                                        <div style="font-size:11px;color:var(--text-muted)">{{ $category->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>84</td>
                            <td><span class="badge-status badge-active">Active</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <!-- {{-- Edit button --}} -->
                                    <button
                                        data-bs-toggle="modal"
                                        data-bs-target="#addCategoryModal"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        class="btn btn-sm btn-outline-custom">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <!-- {{-- Delete button --}} -->
                                    <button
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteCategoryModal"
                                        data-id="{{ $category->id }}"
                                        data-category="{{ $category->name }}"
                                        class="btn btn-sm"
                                        style="background:#fee2e2;color:#dc2626;border-radius:8px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════
     ADD / EDIT CATEGORY MODAL
════════════════════════════════════════════ -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="modal-content" id="category-form">
            @csrf

            <div class="modal-header">
                <h6 class="modal-title fw-semibold" id="addCategoryModalLabel">Add Category</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label-custom">Category Name</label>
                    <input type="text" name="name" id="modal-cat-name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="modal-footer gap-2">
                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary-custom">Save Category</button>
            </div>
        </form>
    </div>
</div>


<!-- ═══════════════════════════════════════════
     DELETE CONFIRM MODAL
════════════════════════════════════════════ -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form method="POST" class="modal-content" id="delete-category-form">
            @csrf

            <div class="modal-body text-center py-4">
                <div style="width:52px;height:52px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                    <i class="bi bi-trash" style="font-size:22px;color:#dc2626;"></i>
                </div>
                <h6 class="fw-semibold mb-1">Delete Category</h6>
                <p style="font-size:13px;color:var(--text-muted);margin-bottom:0">
                    Are you sure you want to delete <strong id="delete-category-name"></strong>?
                    This action cannot be undone.
                </p>
            </div>

            <div class="modal-footer justify-content-center gap-2 pt-0">
                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-sm"
                    style="background:#dc2626;color:#fff;border-radius:8px;padding:6px 18px;">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>


<!-- ═══════════════════════════════════════════
     MODAL LOGIC
════════════════════════════════════════════ -->
<script>
    const categoryModal = document.getElementById('addCategoryModal');
    const categoryForm = document.getElementById('category-form');
    const storeUrl = "{{ route('admin.categories.store') }}";

    // ── Add / Edit modal ──────────────────────────────────────────────────────
    categoryModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        const id = btn?.dataset.id ?? null;
        const name = btn?.dataset.name ?? '';
        const isEdit = !!id;

        document.getElementById('addCategoryModalLabel').textContent = isEdit ? 'Edit Category' : 'Add Category';
        document.getElementById('modal-cat-name').value = name;

        // Switch form action between store and edit
        categoryForm.action = isEdit ?
            `/admin/categories/edit/${id}` :
            storeUrl;
    });

    // Reset on close
    categoryModal.addEventListener('hidden.bs.modal', function() {
        document.getElementById('addCategoryModalLabel').textContent = 'Add Category';
        document.getElementById('modal-cat-name').value = '';
        categoryForm.action = storeUrl;
    });

    // ── Delete modal ──────────────────────────────────────────────────────────
    const deleteModal = document.getElementById('deleteCategoryModal');
    const deleteForm = document.getElementById('delete-category-form');

    deleteModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        const id = btn?.dataset.id ?? '';
        const name = btn?.dataset.category ?? '';

        document.getElementById('delete-category-name').textContent = `"${name}"`;
        deleteForm.action = `/admin/categories/delete/${id}`;
    });
</script>
@endsection