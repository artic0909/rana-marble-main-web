@extends('admin.layout.app')

@section('title', 'Banners')

@section('content')

<div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
    <div>
        <h1 class="page-title">Banners</h1>
        <p class="page-subtitle">Manage promotional banners and hero images.</p>
    </div>
</div>

<div class="row g-3">

    {{-- ── EXISTING BANNERS ── --}}
    @forelse($banners as $banner)
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-body">

                {{-- Preview --}}
                <div class="rounded-3 mb-3"
                    style="height:120px;overflow:hidden;border:1.5px solid var(--border);border-radius:10px">
                    <img src="{{ Storage::url($banner->image) }}"
                        alt="{{ $banner->title }}"
                        style="width:100%;height:100%;object-fit:cover;display:block">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div style="font-weight:600;font-size:13px">{{ $banner->title }}</div>
                        <div style="font-size:11px;color:var(--text-muted)">
                            {{ \App\Models\Banner::PLACEMENTS[$banner->placement] ?? $banner->placement }}
                        </div>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="badge-status badge-{{ $banner->status }}">
                            {{ ucfirst($banner->status) }}
                        </span>
                        <a href="{{ route('admin.banners.edit', $banner->id) }}"
                            class="btn btn-sm"
                            style="background:var(--surface2);border-radius:7px;padding:4px 8px">
                            <i class="bi bi-pencil" style="font-size:12px"></i>
                        </a>
                        <form action="{{ route('admin.banners.delete', $banner->id) }}" method="POST"
                            onsubmit="return confirm('Delete this banner?')">
                            @csrf
                            <button type="submit" class="btn btn-sm"
                                style="background:#fee2e2;color:#dc2626;border-radius:7px;padding:4px 8px;border:none">
                                <i class="bi bi-trash" style="font-size:12px"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-image" style="font-size:40px;color:var(--text-muted);display:block;margin-bottom:10px"></i>
                <p style="font-size:14px;color:var(--text-muted);margin:0">No banners yet. Add one below.</p>
            </div>
        </div>
    </div>
    @endforelse

    {{-- ── ADD NEW BANNER ── --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title-sm mb-3">Add New Banner</h6>

                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">

                        <div class="col-12 col-md-4">
                            <label class="form-label-custom">Banner Title</label>
                            <input type="text" name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                placeholder="e.g. Summer Sale">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label-custom">Placement</label>
                            <select name="placement"
                                class="form-select @error('placement') is-invalid @enderror">
                                @foreach(\App\Models\Banner::PLACEMENTS as $val => $label)
                                <option value="{{ $val }}" {{ old('placement') === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                            @error('placement') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label-custom">Status</label>
                            <select name="status"
                                class="form-select @error('status') is-invalid @enderror">
                                @foreach(['active' => 'Active', 'draft' => 'Draft', 'inactive' => 'Inactive'] as $val => $label)
                                <option value="{{ $val }}" {{ old('status', 'active') === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label-custom">Banner Image</label>

                            {{-- Preview --}}
                            <div id="bannerPreview" class="d-none mb-2"
                                style="border-radius:10px;overflow:hidden;border:1.5px solid var(--border);height:140px">
                                <img id="bannerPreviewImg" src=""
                                    style="width:100%;height:100%;object-fit:cover;display:block">
                            </div>

                            <label id="bannerUploadZone" class="upload-zone" style="cursor:pointer">
                                <i class="bi bi-cloud-upload" style="font-size:32px;color:var(--text-muted)"></i>
                                <div style="font-size:13px;color:var(--text-muted);margin-top:8px">
                                    Drag & drop or <span style="color:var(--primary);font-weight:600">browse</span>
                                </div>
                                <div style="font-size:11px;color:var(--text-muted);margin-top:4px">
                                    Recommended: 1920×600px · Max 5MB
                                </div>
                                <input type="file" name="image" id="bannerImageInput"
                                    accept="image/*" class="d-none">
                            </label>
                            @error('image') <div class="text-danger mt-1" style="font-size:13px">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="bi bi-cloud-upload me-1"></i>Publish Banner
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<script>
    const bannerInput = document.getElementById('bannerImageInput');
    const bannerPreview = document.getElementById('bannerPreview');
    const bannerImg = document.getElementById('bannerPreviewImg');
    const bannerZone = document.getElementById('bannerUploadZone');

    bannerInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;
        bannerImg.src = URL.createObjectURL(file);
        bannerPreview.classList.remove('d-none');
        bannerZone.style.display = 'none';
    });
</script>

@endsection