@extends('admin.layout.app')

@section('title', 'Add Sizes')

@section('content')
<!-- ══ 4. Sizes ══ -->
<section class="page-section active" id="page-Sizes">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Sizes</h1>
            <p class="page-subtitle">Organize products into Sizes.</p>
        </div>
        <button class="btn btn-sm btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addSizeModal">
            <i class="bi bi-plus-lg me-1"></i>Add Size
        </button>
    </div>

    <!-- Full Width Table Card -->
    <div class="card">
        <div class="card-body p-0">
            <div class="px-3 py-3 border-bottom">
                <h6 class="card-title-sm mb-0">All Sizes</h6>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-custom table-hover mb-0">
                    <thead style="background:var(--surface2)">
                        <tr>
                            <th style="padding-left:16px">Size</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sizes as $size)
                        <tr>
                            <td style="padding-left:16px">
                                <div class="d-flex align-items-center gap-2">
                                    <span style="font-size:22px">📱</span>
                                    <div>
                                        <div style="font-weight:600;font-size:13px">{{ $size->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>84</td>
                            <td><span class="badge-status badge-active">Active</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <!-- {{-- Edit --}} -->
                                    <button
                                        data-bs-toggle="modal"
                                        data-bs-target="#addSizeModal"
                                        data-id="{{ $size->id }}"
                                        data-name="{{ $size->name }}"
                                        class="btn btn-sm btn-outline-custom">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <!-- {{-- Delete --}} -->
                                    <button
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteSizeModal"
                                        data-id="{{ $size->id }}"
                                        data-name="{{ $size->name }}"
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
     ADD / EDIT SIZE MODAL
════════════════════════════════════════════ -->
<div class="modal fade" id="addSizeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" class="modal-content" id="size-form">
            @csrf

            <div class="modal-header">
                <h6 class="modal-title fw-semibold" id="addSizeModalLabel">Add Size</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label-custom">Size Name</label>
                    <input type="text" name="name" id="modal-size-name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="e.g. Small">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="modal-footer gap-2">
                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary-custom">Save Size</button>
            </div>
        </form>
    </div>
</div>


<!-- ═══════════════════════════════════════════
     DELETE CONFIRM MODAL
════════════════════════════════════════════ -->
<div class="modal fade" id="deleteSizeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form method="POST" class="modal-content" id="delete-size-form">
            @csrf

            <div class="modal-body text-center py-4">
                <div style="width:52px;height:52px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                    <i class="bi bi-trash" style="font-size:22px;color:#dc2626;"></i>
                </div>
                <h6 class="fw-semibold mb-1">Delete Size</h6>
                <p style="font-size:13px;color:var(--text-muted);margin-bottom:0">
                    Are you sure you want to delete <strong id="delete-size-name"></strong>?
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
    const sizeModal = document.getElementById('addSizeModal');
    const sizeForm = document.getElementById('size-form');
    const storeSizeUrl = "{{ route('admin.sizes.store') }}";

    // ── Add / Edit modal ──────────────────────────────────────────────────────
    sizeModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        const id = btn?.dataset.id ?? null;
        const name = btn?.dataset.name ?? '';
        const isEdit = !!id;

        document.getElementById('addSizeModalLabel').textContent = isEdit ? 'Edit Size' : 'Add Size';
        document.getElementById('modal-size-name').value = name;

        sizeForm.action = isEdit ?
            `/admin/sizes/edit/${id}` :
            storeSizeUrl;
    });

    // Reset on close
    sizeModal.addEventListener('hidden.bs.modal', function() {
        document.getElementById('addSizeModalLabel').textContent = 'Add Size';
        document.getElementById('modal-size-name').value = '';
        sizeForm.action = storeSizeUrl;
    });

    // ── Delete modal ──────────────────────────────────────────────────────────
    const deleteSizeModal = document.getElementById('deleteSizeModal');
    const deleteSizeForm = document.getElementById('delete-size-form');

    deleteSizeModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        const id = btn?.dataset.id ?? '';
        const name = btn?.dataset.name ?? '';

        document.getElementById('delete-size-name').textContent = `"${name}"`;
        deleteSizeForm.action = `/admin/sizes/delete/${id}`;
    });
</script>
@endsection