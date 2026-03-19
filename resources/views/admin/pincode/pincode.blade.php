@extends('admin.layout.app')

@section('title', 'Add Pincodes')

@section('content')
<section class="page-section active" id="page-Pincodes">
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Pincodes</h1>
            <p class="page-subtitle">Manage delivery pincodes and their fees.</p>
        </div>
        <button class="btn btn-sm btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addPincodeModal">
            <i class="bi bi-plus-lg me-1"></i>Add Pincode
        </button>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="px-3 py-3 border-bottom">
                <h6 class="card-title-sm mb-0">All Pincodes</h6>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-custom table-hover mb-0">
                    <thead style="background:var(--surface2)">
                        <tr>
                            <th style="padding-left:16px">Pincode</th>
                            <th style="padding-left:16px">Delivery Fees</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pincodes as $pincode)
                        <tr>
                            <td style="padding-left:16px">
                                <div style="font-weight:600;font-size:13px;">{{ $pincode->name }}</div>
                            </td>
                            <td style="padding-left:16px">
                                <div style="font-weight:600;font-size:13px;">₹ {{ $pincode->fees }}</div>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button
                                        class="btn btn-sm btn-outline-custom"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addPincodeModal"
                                        data-id="{{ $pincode->id }}"
                                        data-name="{{ $pincode->name }}"
                                        data-fees="{{ $pincode->fees }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button
                                        class="btn btn-sm"
                                        style="background:#fee2e2;color:#dc2626;border-radius:8px;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deletePincodeModal"
                                        data-id="{{ $pincode->id }}"
                                        data-name="{{ $pincode->name }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4" style="color:var(--text-muted);font-size:13px;">
                                No pincodes added yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- ── ADD / EDIT MODAL ── -->
<div class="modal fade" id="addPincodeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" class="modal-content" id="pincode-form">
            @csrf
            <div class="modal-header">
                <h6 class="modal-title fw-semibold" id="addPincodeModalLabel">Add Pincode</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label-custom">Pincode</label>
                    <input type="text" name="name" id="modal-pincode-name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="e.g. 711302">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label-custom">Delivery Fees (₹)</label>
                    <input type="number" name="fees" id="modal-pincode-fees"
                        class="form-control @error('fees') is-invalid @enderror"
                        value="{{ old('fees') }}"
                        placeholder="e.g. 40"
                        min="0">
                    @error('fees')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer gap-2">
                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary-custom">Save Pincode</button>
            </div>
        </form>
    </div>
</div>

<!-- ── DELETE MODAL ── -->
<div class="modal fade" id="deletePincodeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form method="POST" class="modal-content" id="delete-pincode-form">
            @csrf
            <div class="modal-body text-center py-4">
                <div style="width:52px;height:52px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                    <i class="bi bi-trash" style="font-size:22px;color:#dc2626;"></i>
                </div>
                <h6 class="fw-semibold mb-1">Delete Pincode</h6>
                <p style="font-size:13px;color:var(--text-muted);margin-bottom:0;">
                    Are you sure you want to delete <strong id="delete-pincode-name"></strong>?
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

<script>
    const pincodeModal = document.getElementById('addPincodeModal');
    const pincodeForm = document.getElementById('pincode-form');
    const storePincodeUrl = "{{ route('admin.pincodes.store') }}";

    // ── Add / Edit ──
    pincodeModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        const id = btn?.dataset.id ?? null;
        const name = btn?.dataset.name ?? '';
        const fees = btn?.dataset.fees ?? '';
        const isEdit = !!id;

        document.getElementById('addPincodeModalLabel').textContent = isEdit ? 'Edit Pincode' : 'Add Pincode';
        document.getElementById('modal-pincode-name').value = name;
        document.getElementById('modal-pincode-fees').value = fees;

        pincodeForm.action = isEdit ?
            `/admin/pincode/edit/${id}` :
            storePincodeUrl;
    });

    // ── Reset on close ──
    pincodeModal.addEventListener('hidden.bs.modal', function() {
        document.getElementById('addPincodeModalLabel').textContent = 'Add Pincode';
        document.getElementById('modal-pincode-name').value = '';
        document.getElementById('modal-pincode-fees').value = '';
        pincodeForm.action = storePincodeUrl;
    });

    // ── Delete ──
    const deletePincodeModal = document.getElementById('deletePincodeModal');
    const deletePincodeForm = document.getElementById('delete-pincode-form');

    deletePincodeModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        const id = btn?.dataset.id ?? '';
        const name = btn?.dataset.name ?? '';

        document.getElementById('delete-pincode-name').textContent = `"${name}"`;
        deletePincodeForm.action = `/admin/pincode/delete/${id}`;
    });
</script>
@endsection