@extends('admin.layout.app')

@section('title', 'All Product Reviews')

@section('content')

<section class="page-section active" id="page-reviews">

    {{-- ── Header ── --}}
    <div class="d-flex align-items-start justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 class="page-title">Reviews</h1>
            <p class="page-subtitle">Monitor and manage customer reviews.</p>
        </div>

        {{-- Rating filter --}}
        <form method="GET" action="{{ route('admin.reviews.index') }}">
            <select class="form-select form-select-sm"
                name="rating"
                onchange="this.form.submit()"
                style="border-radius:10px;font-size:13px;width:auto">
                <option value="">All Ratings</option>
                @for ($s = 5; $s >= 1; $s--)
                <option value="{{ $s }}" {{ request('rating') == $s ? 'selected' : '' }}>
                    {{ str_repeat('★', $s) }}{{ str_repeat('☆', 5 - $s) }} {{ $s }} {{ $s === 1 ? 'Star' : 'Stars' }}
                </option>
                @endfor
            </select>
        </form>
    </div>

    {{-- ── Flash messages ── --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:10px;font-size:13px;">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column gap-3">

                @forelse ($reviews as $review)
                <div class="p-3 rounded-3" style="border:1.5px solid var(--border)">

                    {{-- ── Top row: reviewer info + rating + status badge ── --}}
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-sm"
                                style="background:var(--primary-light);color:var(--primary);
                                        display:flex;align-items:center;justify-content:center;
                                        width:36px;height:36px;border-radius:50%;font-weight:700;">
                                {{ strtoupper(substr($review->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-size:13px;font-weight:600">{{ $review->name }}</div>
                                <div style="font-size:11px;color:var(--text-muted)">
                                    {{ $review->product?->name ?? 'Unknown Product' }}
                                    &nbsp;·&nbsp;
                                    {{ $review->created_at->format('M d, Y') }}
                                    @if ($review->city || $review->state)
                                    &nbsp;·&nbsp;
                                    <i class="bi bi-geo-alt"></i>
                                    {{ implode(', ', array_filter([$review->city, $review->state])) }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            {{-- Star display --}}
                            <span class="stars" style="color:#f59e0b;">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <=$review->rating)
                                    ★
                                    @else
                                    <span style="color:#d1d5db;">★</span>
                                    @endif
                                    @endfor
                            </span>

                            {{-- Status badge --}}
                            @if ($review->status === 'approved')
                            <span class="badge-status badge-active">Approved</span>
                            @elseif ($review->status === 'rejected')
                            <span class="badge-status badge-inactive">Rejected</span>
                            @else
                            <span class="badge-status badge-pending">Pending</span>
                            @endif
                        </div>
                    </div>

                    {{-- ── Review text ── --}}
                    <p style="font-size:13px;color:var(--text-muted);margin:0 0 10px">
                        "{{ $review->review }}"
                    </p>

                    {{-- ── Media thumbnails (if any) ── --}}
                    @if (!empty($review->media) && count($review->media))
                    <div class="d-flex gap-2 flex-wrap mb-2">
                        @foreach ($review->media as $path)
                        @php
                        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                        $isVideo = in_array($ext, ['mp4', 'webm']);
                        $url = \Storage::url($path);
                        @endphp
                        @if ($isVideo)
                        <video src="{{ $url }}" style="width:60px;height:60px;object-fit:cover;border-radius:6px;border:1px solid var(--border);" muted></video>
                        @else
                        <img src="{{ $url }}" style="width:60px;height:60px;object-fit:cover;border-radius:6px;border:1px solid var(--border);" alt="review media">
                        @endif
                        @endforeach
                    </div>
                    @endif

                    {{-- ── Action buttons (vary by status) ── --}}
                    <div class="d-flex gap-2 flex-wrap">

                        {{-- Approve: show if pending or rejected --}}
                        @if ($review->status !== 'approved')
                        <form method="POST" action="{{ route('admin.reviews.approve', $review) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-sm"
                                style="background:#dcfce7;color:#16a34a;border-radius:8px;font-size:12px;padding:4px 12px;border:none;">
                                <i class="bi bi-check me-1"></i>Approve
                            </button>
                        </form>
                        @endif

                        {{-- Reject: show if pending or approved --}}
                        @if ($review->status !== 'rejected')
                        <form method="POST" action="{{ route('admin.reviews.reject', $review) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-sm"
                                style="background:#fef9c3;color:#854d0e;border-radius:8px;font-size:12px;padding:4px 12px;border:none;">
                                <i class="bi bi-x me-1"></i>Reject
                            </button>
                        </form>
                        @endif

                        {{-- Delete always shown --}}
                        <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}"
                            onsubmit="return confirm('Delete this review permanently?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm"
                                style="background:#fee2e2;color:#dc2626;border-radius:8px;font-size:12px;padding:4px 12px;border:none;">
                                <i class="bi bi-trash me-1"></i>Delete
                            </button>
                        </form>

                    </div>
                </div>

                @empty
                <div class="text-center py-5" style="color:var(--text-muted);">
                    <i class="bi bi-star" style="font-size:2rem;opacity:0.3;"></i>
                    <p class="mt-2" style="font-size:13px;">No reviews found.</p>
                </div>
                @endforelse

            </div>

            {{-- ── Pagination ── --}}
            @if ($reviews->hasPages())
            <div class="mt-4">
                {{ $reviews->appends(request()->query())->links() }}
            </div>
            @endif

        </div>
    </div>
</section>

@endsection