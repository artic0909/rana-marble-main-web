@extends('admin.layout.app')

@section('title', 'Shippings')

@section('content')

<div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="page-title">Shipping</h1>
        <p class="page-subtitle">Configure shipping zones, rates and carriers.</p>
    </div>
</div>

<div class="row g-3">


    <!-- ── Left ─────────────────────────────────────────── -->
    <div class="col-12 col-md-7">

        <!-- Pincode Shipping Rates -->
        <div class="card">
            <div class="card-body p-0">
                <div class="px-3 py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="card-title-sm mb-0">Pincode Shipping Rates</h6>
                    <button class="btn btn-sm btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addPincodeModal">
                        <i class="bi bi-plus-lg me-1"></i>Add Pincode
                    </button>
                </div>

                <div class="px-3 py-2 border-bottom">
                    <div class="topbar-search">
                        <i class="bi bi-search"></i>
                        <input type="text" id="pincodeSearch" placeholder="Search pincode or city…"
                            style="width:100%;border-radius:10px;padding:7px 14px 7px 36px;border:1.5px solid var(--border);font-size:13px;outline:none;">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-custom table-hover mb-0" id="pincodeTable">
                        <thead style="background:var(--surface2)">
                            <tr>
                                <th style="padding-left:16px">Pincode</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Fee ($)</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $pincodes = [
                            ['pin'=>'10001', 'city'=>'New York', 'state'=>'NY', 'fee'=>'4.99', 'active'=>true],
                            ['pin'=>'90001', 'city'=>'Los Angeles', 'state'=>'CA', 'fee'=>'4.99', 'active'=>true],
                            ];
                            @endphp

                            @foreach($pincodes as $p)
                            <tr>
                                <td style="padding-left:16px">
                                    <span style="font-family:monospace;font-weight:700;font-size:13px">{{ $p['pin'] }}</span>
                                </td>
                                <td style="font-size:13px;font-weight:600">{{ $p['city'] }}</td>
                                <td style="font-size:12px;color:var(--text-muted)">{{ $p['state'] }}</td>
                                <td style="font-weight:700;font-size:13px">${{ $p['fee'] }}</td>
                                <td>
                                    @if($p['active'])
                                    <span class="badge-status badge-active">Active</span>
                                    @else
                                    <span class="badge-status badge-draft">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm"
                                            style="background:var(--surface2);border-radius:7px;padding:4px 8px;"
                                            data-bs-toggle="modal" data-bs-target="#addPincodeModal"
                                            data-pin="{{ $p['pin'] }}"
                                            data-city="{{ $p['city'] }}"
                                            data-state="{{ $p['state'] }}"
                                            data-fee="{{ $p['fee'] }}"
                                            data-active="{{ $p['active'] ? '1' : '0' }}">
                                            <i class="bi bi-pencil" style="font-size:12px"></i>
                                        </button>
                                        <button class="btn btn-sm"
                                            style="background:#fee2e2;color:#dc2626;border-radius:7px;padding:4px 8px;border:none"
                                            data-bs-toggle="modal" data-bs-target="#deletePincodeModal"
                                            data-pin="{{ $p['pin'] }}" data-city="{{ $p['city'] }}">
                                            <i class="bi bi-trash" style="font-size:12px"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-3 py-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <span style="font-size:13px;color:var(--text-muted)" id="pincodeCount">Showing 10 pincodes</span>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link" href="#" style="background:var(--primary);border-color:var(--primary)">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>

    </div>


    <!-- ── Right ─────────────────────────────────────────── -->
    <div class="col-12 col-md-5">

        <!-- Tracking Overview -->
        <div class="card">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Tracking Overview</h6>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:13px">In Transit</span>
                        <span class="badge-status badge-processing">42 orders</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:13px">Out for Delivery</span>
                        <span class="badge-status badge-pending">12 orders</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:13px">Delivered Today</span>
                        <span class="badge-status badge-delivered">28 orders</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:13px">Exception</span>
                        <span class="badge-status badge-cancelled">2 orders</span>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>


<!-- ══ ADD / EDIT PINCODE MODAL ══ -->
<div class="modal fade" id="addPincodeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-semibold" id="pincodeModalLabel">Add Pincode</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label-custom">Pincode *</label>
                        <input type="text" id="m-pin" class="form-control" placeholder="e.g. 10001">
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">City *</label>
                        <input type="text" id="m-city" class="form-control" placeholder="e.g. New York">
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">State / Region</label>
                        <input type="text" id="m-state" class="form-control" placeholder="e.g. NY">
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Shipping Fee ($) *</label>
                        <input type="number" id="m-fee" class="form-control" placeholder="0.00" min="0" step="0.01">
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Status</label>
                        <select id="m-active" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer gap-2">
                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary-custom">Save Pincode</button>
            </div>
        </div>
    </div>
</div>


<!-- ══ DELETE PINCODE MODAL ══ -->
<div class="modal fade" id="deletePincodeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <div style="width:52px;height:52px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px">
                    <i class="bi bi-geo-alt" style="font-size:22px;color:#dc2626"></i>
                </div>
                <h6 class="fw-semibold mb-1">Delete Pincode</h6>
                <p style="font-size:13px;color:var(--text-muted);margin:0">
                    Remove pincode <strong id="delete-pin-label"></strong>? This cannot be undone.
                </p>
            </div>
            <div class="modal-footer justify-content-center gap-2 pt-0">
                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm" style="background:#dc2626;color:#fff;border-radius:8px;padding:6px 18px;border:none">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    // ── Add / Edit modal ──────────────────────────────────
    const pincodeModal = document.getElementById('addPincodeModal');

    pincodeModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        const pin = btn?.dataset.pin;
        const isEdit = !!pin;

        document.getElementById('pincodeModalLabel').textContent = isEdit ? 'Edit Pincode' : 'Add Pincode';
        document.getElementById('m-pin').value = pin ?? '';
        document.getElementById('m-city').value = btn?.dataset.city ?? '';
        document.getElementById('m-state').value = btn?.dataset.state ?? '';
        document.getElementById('m-fee').value = btn?.dataset.fee ?? '';

        const zoneSelect = document.getElementById('m-zone');
        [...zoneSelect.options].forEach(o => o.selected = (o.value === btn?.dataset.zone));

        const activeSelect = document.getElementById('m-active');
        [...activeSelect.options].forEach(o => o.selected = (o.value === (btn?.dataset.active ?? '1')));
    });

    pincodeModal.addEventListener('hidden.bs.modal', function() {
        document.getElementById('pincodeModalLabel').textContent = 'Add Pincode';
        ['m-pin', 'm-city', 'm-state', 'm-fee'].forEach(id => document.getElementById(id).value = '');
        document.getElementById('m-zone').selectedIndex = 0;
        document.getElementById('m-active').selectedIndex = 0;
    });

    // ── Delete modal ──────────────────────────────────────
    document.getElementById('deletePincodeModal').addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        document.getElementById('delete-pin-label').textContent =
            `"${btn?.dataset.pin} – ${btn?.dataset.city}"`;
    });

    // ── Live search ───────────────────────────────────────
    document.getElementById('pincodeSearch').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        const rows = document.querySelectorAll('#pincodeTable tbody tr');
        let visible = 0;
        rows.forEach(row => {
            const match = row.textContent.toLowerCase().includes(q);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        document.getElementById('pincodeCount').textContent =
            `Showing ${visible} pincode${visible !== 1 ? 's' : ''}`;
    });
</script>

@endsection