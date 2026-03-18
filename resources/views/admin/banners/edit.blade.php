@extends('admin.layout.app')

@section('title', 'Edit Banner — ' . $banner->title)

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('admin.banners.index') }}" class="btn btn-sm btn-outline-custom">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h1 class="page-title mb-0">Edit Banner</h1>
        <p class="page-subtitle mb-0">{{ $banner->title }}</p>
    </div>
</div>

<div class="card" style="max-width:720px">
    <div class="card-body">
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">

                <div class="col-12 col-md-6">
                    <label class="form-label-custom">Banner Title</label>
                    <input type="text" name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $banner->title) }}">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label-custom">Placement</label>
                    <select name="placement"
                        class="form-select @error('placement') is-invalid @enderror">
                        @foreach(\App\Models\Banner::PLACEMENTS as $val => $label)
                        <option value="{{ $val }}"
                            {{ old('placement', $banner->placement) === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                    @error('placement') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label-custom">Status</label>
                    <select name="status"
                        class="form-select @error('status') is-invalid @enderror">
                        @foreach(['active' => 'Active', 'draft' => 'Draft', 'inactive' => 'Inactive'] as $val => $label)
                        <option value="{{ $val }}"
                            {{ old('status', $banner->status) === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label-custom">Banner Image</label>

                    {{-- Current image --}}
                    <div id="bannerPreview" class="mb-2"
                        style="border-radius:10px;overflow:hidden;border:1.5px solid var(--border);height:140px">
                        <img id="bannerPreviewImg"
                            src="{{ Storage::url($banner->image) }}"
                            style="width:100%;height:100%;object-fit:cover;display:block">
                    </div>

                    <label class="upload-zone" style="cursor:pointer;padding:16px">
                        <i class="bi bi-arrow-repeat" style="font-size:22px;color:var(--text-muted)"></i>
                        <div style="font-size:13px;color:var(--text-muted);margin-top:6px">
                            Click to replace image
                        </div>
                        <input type="file" name="image" id="bannerImageInput"
                            accept="image/*" class="d-none">
                    </label>
                    @error('image') <div class="text-danger mt-1" style="font-size:13px">{{ $message }}</div> @enderror
                </div>

                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-check-lg me-1"></i>Update Banner
                    </button>
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-custom">
                        Cancel
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>


<script>
    document.getElementById('bannerImageInput').addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;
        document.getElementById('bannerPreviewImg').src = URL.createObjectURL(file);
    });
</script>

@endsection