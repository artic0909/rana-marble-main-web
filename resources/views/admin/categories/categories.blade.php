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
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <span style="font-size:22px">📱</span>
                                    <div>
                                        <div style="font-weight:600;font-size:13px">Electronics</div>
                                        <div style="font-size:11px;color:var(--text-muted)">Top Level</div>
                                    </div>
                                </div>
                            </td>
                            <td>84</td>
                            <td><span class="badge-status badge-active">Active</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm" style="background:var(--surface2);border-radius:7px;padding:4px 8px;"
                                        data-bs-toggle="modal" data-bs-target="#addCategoryModal"
                                        data-name="Electronics" data-parent="None (Top Level)" data-desc="" data-slug="electronics">
                                        <i class="bi bi-pencil" style="font-size:12px"></i>
                                    </button>
                                    <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:7px;padding:4px 8px;"
                                        data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                                        data-category="Electronics">
                                        <i class="bi bi-trash" style="font-size:12px"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <span style="font-size:22px">👗</span>
                                    <div>
                                        <div style="font-weight:600;font-size:13px">Fashion</div>
                                        <div style="font-size:11px;color:var(--text-muted)">Top Level</div>
                                    </div>
                                </div>
                            </td>
                            <td>62</td>
                            <td><span class="badge-status badge-active">Active</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm" style="background:var(--surface2);border-radius:7px;padding:4px 8px;"
                                        data-bs-toggle="modal" data-bs-target="#addCategoryModal"
                                        data-name="Fashion" data-parent="None (Top Level)" data-desc="" data-slug="fashion">
                                        <i class="bi bi-pencil" style="font-size:12px"></i>
                                    </button>
                                    <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:7px;padding:4px 8px;"
                                        data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                                        data-category="Fashion">
                                        <i class="bi bi-trash" style="font-size:12px"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <span style="font-size:22px">🏠</span>
                                    <div>
                                        <div style="font-weight:600;font-size:13px">Home & Garden</div>
                                        <div style="font-size:11px;color:var(--text-muted)">Top Level</div>
                                    </div>
                                </div>
                            </td>
                            <td>48</td>
                            <td><span class="badge-status badge-active">Active</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm" style="background:var(--surface2);border-radius:7px;padding:4px 8px;"
                                        data-bs-toggle="modal" data-bs-target="#addCategoryModal"
                                        data-name="Home & Garden" data-parent="Home &amp; Garden" data-desc="" data-slug="home-garden">
                                        <i class="bi bi-pencil" style="font-size:12px"></i>
                                    </button>
                                    <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:7px;padding:4px 8px;"
                                        data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                                        data-category="Home & Garden">
                                        <i class="bi bi-trash" style="font-size:12px"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <span style="font-size:22px">⚽</span>
                                    <div>
                                        <div style="font-weight:600;font-size:13px">Sports</div>
                                        <div style="font-size:11px;color:var(--text-muted)">Top Level</div>
                                    </div>
                                </div>
                            </td>
                            <td>31</td>
                            <td><span class="badge-status badge-active">Active</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm" style="background:var(--surface2);border-radius:7px;padding:4px 8px;"
                                        data-bs-toggle="modal" data-bs-target="#addCategoryModal"
                                        data-name="Sports" data-parent="None (Top Level)" data-desc="" data-slug="sports">
                                        <i class="bi bi-pencil" style="font-size:12px"></i>
                                    </button>
                                    <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:7px;padding:4px 8px;"
                                        data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                                        data-category="Sports">
                                        <i class="bi bi-trash" style="font-size:12px"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <span style="font-size:22px">📚</span>
                                    <div>
                                        <div style="font-weight:600;font-size:13px">Books</div>
                                        <div style="font-size:11px;color:var(--text-muted)">Top Level</div>
                                    </div>
                                </div>
                            </td>
                            <td>23</td>
                            <td><span class="badge-status badge-draft">Draft</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm" style="background:var(--surface2);border-radius:7px;padding:4px 8px;"
                                        data-bs-toggle="modal" data-bs-target="#addCategoryModal"
                                        data-name="Books" data-parent="None (Top Level)" data-desc="" data-slug="books">
                                        <i class="bi bi-pencil" style="font-size:12px"></i>
                                    </button>
                                    <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:7px;padding:4px 8px;"
                                        data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                                        data-category="Books">
                                        <i class="bi bi-trash" style="font-size:12px"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════
     ADD / EDIT CATEGORY MODAL
════════════════════════════════════════════ -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title fw-semibold" id="addCategoryModalLabel">Add Category</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label-custom">Category Name</label>
                    <input type="text" id="modal-cat-name" class="form-control" placeholder="e.g. Electronics">
                </div>
                <div class="mb-3">
                    <label class="form-label-custom">Category Image</label>
                    <div class="upload-zone">
                        <i class="bi bi-cloud-upload" style="font-size:28px;color:var(--text-muted)"></i>
                        <p style="font-size:13px;color:var(--text-muted);margin:8px 0 0">Drag & drop or click to upload</p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label-custom">Slug</label>
                    <input type="text" id="modal-cat-slug" class="form-control" placeholder="electronics" readonly>
                </div>
            </div>

            <div class="modal-footer gap-2">
                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary-custom">Save Category</button>
            </div>

        </div>
    </div>
</div>


<!-- ═══════════════════════════════════════════
     DELETE CONFIRM MODAL
════════════════════════════════════════════ -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <div class="modal-body text-center py-4">
                <div style="width:52px;height:52px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                    <i class="bi bi-trash" style="font-size:22px;color:#dc2626;"></i>
                </div>
                <h6 class="fw-semibold mb-1">Delete Category</h6>
                <p style="font-size:13px;color:var(--text-muted);margin-bottom:0">
                    Are you sure you want to delete <strong id="delete-category-name"></strong>? This action cannot be undone.
                </p>
            </div>

            <div class="modal-footer justify-content-center gap-2 pt-0">
                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm" style="background:#dc2626;color:#fff;border-radius:8px;padding:6px 18px;">
                    Delete
                </button>
            </div>

        </div>
    </div>
</div>


<!-- ═══════════════════════════════════════════
     MODAL LOGIC
════════════════════════════════════════════ -->
<script>
    // ── Add/Edit modal: populate fields when editing ──────────────────────────
    const categoryModal = document.getElementById('addCategoryModal');

    categoryModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        const name = btn?.dataset.name;
        const isEdit = !!name;

        // Update modal title
        document.getElementById('addCategoryModalLabel').textContent = isEdit ? 'Edit Category' : 'Add Category';

        // Populate or clear fields
        document.getElementById('modal-cat-name').value = name ?? '';
        document.getElementById('modal-cat-slug').value = btn?.dataset.slug ?? '';
        document.getElementById('modal-cat-desc').value = btn?.dataset.desc ?? '';

        const parentSelect = document.getElementById('modal-cat-parent');
        const parentValue = btn?.dataset.parent ?? 'None (Top Level)';
        [...parentSelect.options].forEach(o => o.selected = (o.text === parentValue));
    });

    // Reset title/fields when modal is hidden (so "Add" opens clean next time)
    categoryModal.addEventListener('hidden.bs.modal', function() {
        document.getElementById('addCategoryModalLabel').textContent = 'Add Category';
        document.getElementById('modal-cat-name').value = '';
        document.getElementById('modal-cat-slug').value = '';
        document.getElementById('modal-cat-desc').value = '';
        document.getElementById('modal-cat-parent').selectedIndex = 0;
    });

    // ── Delete modal: show category name ─────────────────────────────────────
    document.getElementById('deleteCategoryModal').addEventListener('show.bs.modal', function(e) {
        const category = e.relatedTarget?.dataset.category ?? '';
        document.getElementById('delete-category-name').textContent = `"${category}"`;
    });
</script>
@endsection