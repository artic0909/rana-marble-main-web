@extends('admin.layout.app')

@section('title', 'Add Colors')

@section('content')
<!-- ══ 4. Colors ══ -->
<section class="page-section active" id="page-Colors">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Colors</h1>
            <p class="page-subtitle">Organize products into Colors.</p>
        </div>
        <button class="btn btn-sm btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addColorModal">
            <i class="bi bi-plus-lg me-1"></i>Add Color
        </button>
    </div>

    <!-- Full Width Table Card -->
    <div class="card">
        <div class="card-body p-0">
            <div class="px-3 py-3 border-bottom">
                <h6 class="card-title-sm mb-0">All Colors</h6>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-custom table-hover mb-0">
                    <thead style="background:var(--surface2)">
                        <tr>
                            <th style="padding-left:16px">Color</th>
                            <th>Products</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding-left:16px">
                                <div style="font-weight:600;font-size:13px">Red</div>
                            </td>
                            <td>84</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm" style="background:var(--surface2);border-radius:7px;padding:4px 8px;"
                                        data-bs-toggle="modal" data-bs-target="#addColorModal"
                                        data-name="Electronics" data-parent="None (Top Level)" data-desc="" data-slug="electronics">
                                        <i class="bi bi-pencil" style="font-size:12px"></i>
                                    </button>
                                    <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:7px;padding:4px 8px;"
                                        data-bs-toggle="modal" data-bs-target="#deleteColorModal"
                                        data-Color="Electronics">
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
     ADD / EDIT Color MODAL
════════════════════════════════════════════ -->
<div class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title fw-semibold" id="addColorModalLabel">Add Color</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label-custom">Color Name</label>
                    <input type="text" id="modal-cat-name" class="form-control" placeholder="e.g. Electronics">
                </div>
            </div>

            <div class="modal-footer gap-2">
                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary-custom">Save Color</button>
            </div>

        </div>
    </div>
</div>


<!-- ═══════════════════════════════════════════
     DELETE CONFIRM MODAL
════════════════════════════════════════════ -->
<div class="modal fade" id="deleteColorModal" tabindex="-1" aria-labelledby="deleteColorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <div class="modal-body text-center py-4">
                <div style="width:52px;height:52px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                    <i class="bi bi-trash" style="font-size:22px;color:#dc2626;"></i>
                </div>
                <h6 class="fw-semibold mb-1">Delete Color</h6>
                <p style="font-size:13px;color:var(--text-muted);margin-bottom:0">
                    Are you sure you want to delete <strong id="delete-Color-name"></strong>? This action cannot be undone.
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
    const ColorModal = document.getElementById('addColorModal');

    ColorModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        const name = btn?.dataset.name;
        const isEdit = !!name;

        // Update modal title
        document.getElementById('addColorModalLabel').textContent = isEdit ? 'Edit Color' : 'Add Color';

        // Populate or clear fields
        document.getElementById('modal-cat-name').value = name ?? '';
        document.getElementById('modal-cat-slug').value = btn?.dataset.slug ?? '';
        document.getElementById('modal-cat-desc').value = btn?.dataset.desc ?? '';

        const parentSelect = document.getElementById('modal-cat-parent');
        const parentValue = btn?.dataset.parent ?? 'None (Top Level)';
        [...parentSelect.options].forEach(o => o.selected = (o.text === parentValue));
    });

    // Reset title/fields when modal is hidden (so "Add" opens clean next time)
    ColorModal.addEventListener('hidden.bs.modal', function() {
        document.getElementById('addColorModalLabel').textContent = 'Add Color';
        document.getElementById('modal-cat-name').value = '';
        document.getElementById('modal-cat-slug').value = '';
        document.getElementById('modal-cat-desc').value = '';
        document.getElementById('modal-cat-parent').selectedIndex = 0;
    });

    // ── Delete modal: show Color name ─────────────────────────────────────
    document.getElementById('deleteColorModal').addEventListener('show.bs.modal', function(e) {
        const Color = e.relatedTarget?.dataset.Color ?? '';
        document.getElementById('delete-Color-name').textContent = `"${Color}"`;
    });
</script>
@endsection