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
                            <th style="padding-left:16px">Hex</th>
                            <th>Products</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $color)
                        <tr>
                            <td style="padding-left:16px">
                                <div style="font-weight:600;font-size:13px; color:{{ $color->hex }}">{{ $color->name }}</div>
                            </td>

                            <td style="padding-left:16px">
                                <div style="font-weight:600;font-size:13px; background:{{ $color->hex }};">{{ $color->hex }}</div>
                            </td>
                            <td>84</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <!-- {{-- Edit --}} -->
                                    <button
                                        data-bs-toggle="modal"
                                        data-bs-target="#addColorModal"
                                        data-id="{{ $color->id }}"
                                        data-name="{{ $color->name }}"
                                        data-hex="{{ $color->hex }}"
                                        class="btn btn-sm btn-outline-custom">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <!-- {{-- Delete --}} -->
                                    <button
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteColorModal"
                                        data-id="{{ $color->id }}"
                                        data-name="{{ $color->name }}"
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
     ADD / EDIT COLOR MODAL
════════════════════════════════════════════ -->
<div class="modal fade" id="addColorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" class="modal-content" id="color-form">
            @csrf

            <div class="modal-header">
                <h6 class="modal-title fw-semibold" id="addColorModalLabel">Add Color</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label-custom">Color Name</label>
                    <input type="text" name="name" id="modal-color-name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="e.g. Red">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Color Hex</label>
                    <div class="d-flex gap-2 align-items-center">
                        <input type="color" name="hex" id="modal-color-picker"
                            class="form-control form-control-color"
                            value="{{ old('hex', '#000000') }}"
                            style="width:48px;height:40px;padding:4px;cursor:pointer;">
                        <input type="text" name="hex_text" id="modal-color-hex"
                            class="form-control @error('hex') is-invalid @enderror"
                            value="{{ old('hex', '#000000') }}"
                            placeholder="#000000" maxlength="7">
                        @error('hex')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="modal-footer gap-2">
                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary-custom">Save Color</button>
            </div>
        </form>
    </div>
</div>


<!-- ═══════════════════════════════════════════
     DELETE CONFIRM MODAL
════════════════════════════════════════════ -->
<div class="modal fade" id="deleteColorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form method="POST" class="modal-content" id="delete-color-form">
            @csrf

            <div class="modal-body text-center py-4">
                <div style="width:52px;height:52px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                    <i class="bi bi-trash" style="font-size:22px;color:#dc2626;"></i>
                </div>
                <h6 class="fw-semibold mb-1">Delete Color</h6>
                <p style="font-size:13px;color:var(--text-muted);margin-bottom:0">
                    Are you sure you want to delete <strong id="delete-color-name"></strong>?
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
    const colorModal = document.getElementById('addColorModal');
    const colorForm = document.getElementById('color-form');
    const storeColorUrl = "{{ route('admin.colors.store') }}";

    // ── Sync color picker <-> hex text input ──────────────────────────────────
    document.getElementById('modal-color-picker').addEventListener('input', function() {
        document.getElementById('modal-color-hex').value = this.value;
    });
    document.getElementById('modal-color-hex').addEventListener('input', function() {
        const val = this.value;
        if (/^#[0-9A-Fa-f]{6}$/.test(val)) {
            document.getElementById('modal-color-picker').value = val;
        }
    });

    // ── Add / Edit modal ──────────────────────────────────────────────────────
    colorModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        const id = btn?.dataset.id ?? null;
        const name = btn?.dataset.name ?? '';
        const hex = btn?.dataset.hex ?? '#000000';
        const isEdit = !!id;

        document.getElementById('addColorModalLabel').textContent = isEdit ? 'Edit Color' : 'Add Color';
        document.getElementById('modal-color-name').value = name;
        document.getElementById('modal-color-picker').value = hex;
        document.getElementById('modal-color-hex').value = hex;

        colorForm.action = isEdit ?
            `/admin/colors/edit/${id}` :
            storeColorUrl;
    });

    // Reset on close
    colorModal.addEventListener('hidden.bs.modal', function() {
        document.getElementById('addColorModalLabel').textContent = 'Add Color';
        document.getElementById('modal-color-name').value = '';
        document.getElementById('modal-color-picker').value = '#000000';
        document.getElementById('modal-color-hex').value = '#000000';
        colorForm.action = storeColorUrl;
    });

    // ── Delete modal ──────────────────────────────────────────────────────────
    const deleteColorModal = document.getElementById('deleteColorModal');
    const deleteColorForm = document.getElementById('delete-color-form');

    deleteColorModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        const id = btn?.dataset.id ?? '';
        const name = btn?.dataset.name ?? '';

        document.getElementById('delete-color-name').textContent = `"${name}"`;
        deleteColorForm.action = `/admin/colors/delete/${id}`;
    });
</script>
@endsection