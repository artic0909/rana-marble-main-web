@extends('admin.layout.app')

@section('title', 'Settings')

@section('content')

@php $activeTab = session('active_tab', 'store'); @endphp

<div class="mb-4">
    <h1 class="page-title">Settings</h1>
    <p class="page-subtitle">Configure your store preferences.</p>
</div>

<div class="row g-3">

    {{-- ── NAV ── --}}
    <div class="col-12 col-md-3">
        <div class="card">
            <div class="card-body p-2">
                <nav class="settings-nav nav flex-column gap-1">
                    <a class="nav-link {{ $activeTab === 'store'    ? 'active' : '' }}"
                        href="#" onclick="showSettingsTab('store', this); return false;">
                        <i class="bi bi-shop me-2"></i>Store Info
                    </a>
                    <a class="nav-link {{ $activeTab === 'security' ? 'active' : '' }}"
                        href="#" onclick="showSettingsTab('security', this); return false;">
                        <i class="bi bi-shield-lock me-2"></i>Security
                    </a>
                    <a class="nav-link {{ $activeTab === 'seo'      ? 'active' : '' }}"
                        href="#" onclick="showSettingsTab('seo', this); return false;">
                        <i class="bi bi-search me-2"></i>SEO
                    </a>
                </nav>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-9">

        {{-- ── STORE INFO ── --}}
        <div class="card settings-tab {{ $activeTab !== 'store' ? 'd-none' : '' }}" id="settab-store">
            <div class="card-body">
                <h6 class="card-title-sm mb-4">Store Information</h6>

                <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">

                        <div class="col-12 col-md-6">
                            <label class="form-label-custom">Store Name</label>
                            <input type="text" name="store_name"
                                class="form-control @error('store_name') is-invalid @enderror"
                                value="{{ old('store_name', $settings['store_name']) }}">
                            @error('store_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label-custom">Store Email</label>
                            <input type="email" name="store_email"
                                class="form-control @error('store_email') is-invalid @enderror"
                                value="{{ old('store_email', $settings['store_email']) }}">
                            @error('store_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label-custom">Phone</label>
                            <input type="text" name="store_phone"
                                class="form-control @error('store_phone') is-invalid @enderror"
                                value="{{ old('store_phone', $settings['store_phone']) }}">
                            @error('store_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label-custom">Website</label>
                            <input type="text" name="store_website"
                                class="form-control @error('store_website') is-invalid @enderror"
                                value="{{ old('store_website', $settings['store_website']) }}">
                            @error('store_website') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label-custom">Store Description</label>
                            <textarea name="store_description" rows="3"
                                class="form-control @error('store_description') is-invalid @enderror">{{ old('store_description', $settings['store_description']) }}</textarea>
                            @error('store_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label-custom">Address</label>
                            <textarea name="store_address" rows="2"
                                class="form-control @error('store_address') is-invalid @enderror">{{ old('store_address', $settings['store_address']) }}</textarea>
                            @error('store_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Maintenance Mode --}}
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                                style="border:1.5px solid var(--border)">
                                <div>
                                    <div style="font-weight:600;font-size:14px">Maintenance Mode</div>
                                    <div style="font-size:12px;color:var(--text-muted)">
                                        Put store in maintenance mode
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox"
                                        name="maintenance_mode" value="1"
                                        style="width:40px;height:20px"
                                        {{ old('maintenance_mode', $settings['maintenance_mode']) == '1' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        {{-- Logo --}}
                        <div class="col-12">
                            <label class="form-label-custom">Store Logo</label>
                            <div class="d-flex align-items-center gap-3">
                                @if($settings['store_logo'])
                                <img src="{{ Storage::url($settings['store_logo']) }}"
                                    id="logoPreview"
                                    style="width:64px;height:64px;border-radius:14px;object-fit:cover;border:1.5px solid var(--border)">
                                @else
                                <div id="logoPreview"
                                    style="width:64px;height:64px;border-radius:14px;background:var(--primary);display:flex;align-items:center;justify-content:center;color:#fff;font-size:24px">
                                    <i class="bi bi-bag-heart-fill"></i>
                                </div>
                                @endif
                                <label class="btn btn-outline-custom btn-sm" style="cursor:pointer;margin:0">
                                    Change Logo
                                    <input type="file" name="store_logo" id="logoInput"
                                        accept="image/*" class="d-none">
                                </label>
                            </div>
                            @error('store_logo') <div class="text-danger mt-1" style="font-size:13px">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary-custom">
                                Save Changes
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        {{-- ── SECURITY ── --}}
        <div class="card settings-tab {{ $activeTab !== 'security' ? 'd-none' : '' }}" id="settab-security">
            <div class="card-body">
                <h6 class="card-title-sm mb-4">Security Settings</h6>

                <form action="{{ route('admin.settings.password') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <h6 style="font-size:14px;font-weight:700">Change Password</h6>
                        </div>

                        <div class="col-12">
                            <label class="form-label-custom">Current Password</label>
                            <input type="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                placeholder="••••••••">
                            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label-custom">New Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="••••••••">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label-custom">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control" placeholder="••••••••">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary-custom">
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- ── SEO ── --}}
        <div class="card settings-tab {{ $activeTab !== 'seo' ? 'd-none' : '' }}" id="settab-seo">
            <div class="card-body">
                <h6 class="card-title-sm mb-4">SEO Settings</h6>

                <form action="{{ route('admin.settings.seo') }}" method="POST">
                    @csrf
                    <div class="row g-3">

                        <div class="col-12">
                            <label class="form-label-custom">Meta Title</label>
                            <input type="text" name="meta_title"
                                class="form-control @error('meta_title') is-invalid @enderror"
                                value="{{ old('meta_title', $settings['meta_title']) }}"
                                placeholder="e.g. Rana Marble — Premium Marble Store">
                            @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <p style="font-size:11px;color:var(--text-muted);margin-top:4px">
                                Recommended: 50–60 characters.
                                <span id="metaTitleCount" style="font-weight:600">
                                    {{ strlen($settings['meta_title'] ?? '') }}
                                </span> / 60
                            </p>
                        </div>

                        <div class="col-12">
                            <label class="form-label-custom">Meta Description</label>
                            <textarea name="meta_description" rows="3"
                                class="form-control @error('meta_description') is-invalid @enderror"
                                placeholder="Brief description shown in search results…">{{ old('meta_description', $settings['meta_description']) }}</textarea>
                            @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <p style="font-size:11px;color:var(--text-muted);margin-top:4px">
                                Recommended: 150–160 characters.
                                <span id="metaDescCount" style="font-weight:600">
                                    {{ strlen($settings['meta_description'] ?? '') }}
                                </span> / 160
                            </p>
                        </div>

                        <div class="col-12">
                            <label class="form-label-custom">Keywords</label>
                            <input type="text" name="meta_keywords"
                                class="form-control"
                                value="{{ old('meta_keywords', $settings['meta_keywords']) }}"
                                placeholder="marble, flooring, premium tiles (comma separated)">
                            <p style="font-size:11px;color:var(--text-muted);margin-top:4px">
                                Separate with commas. Not a major ranking factor but useful for internal search.
                            </p>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label-custom">OG Image URL</label>
                            <input type="text" name="og_image"
                                class="form-control @error('og_image') is-invalid @enderror"
                                value="{{ old('og_image', $settings['og_image']) }}"
                                placeholder="https://yoursite.com/og.jpg">
                            @error('og_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <p style="font-size:11px;color:var(--text-muted);margin-top:4px">
                                Shown when your site is shared on social media. Recommended: 1200×630px.
                            </p>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label-custom">Robots</label>
                            <select name="robots" class="form-select">
                                @foreach(['index_follow' => 'Index, Follow', 'no_index' => 'No Index', 'no_follow' => 'No Follow'] as $val => $label)
                                <option value="{{ $val }}"
                                    {{ old('robots', $settings['robots'] ?? 'index_follow') === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                            <p style="font-size:11px;color:var(--text-muted);margin-top:4px">
                                Controls how search engines crawl your site. Keep "Index, Follow" unless you have a reason to hide pages.
                            </p>
                        </div>

                        <div class="col-12">
                            <label class="form-label-custom">Google Search Console Verification</label>
                            <input type="text" name="google_verification"
                                class="form-control"
                                value="{{ old('google_verification', $settings['google_verification']) }}"
                                placeholder="google-site-verification=xxxxxxxxxx">
                            <p style="font-size:11px;color:var(--text-muted);margin-top:4px">
                                Paste the full meta tag content from
                                <a href="https://search.google.com/search-console" target="_blank"
                                    style="color:var(--primary)">Google Search Console</a>
                                to verify ownership.
                            </p>
                        </div>

                        {{-- Live SERP preview --}}
                        <div class="col-12">
                            <label class="form-label-custom">Search Result Preview</label>
                            <div style="border:1.5px solid var(--border);border-radius:12px;padding:16px;background:var(--surface)">
                                <div id="serpTitle"
                                    style="font-size:18px;color:#1a0dab;font-weight:400;margin-bottom:2px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis">
                                    {{ $settings['meta_title'] ?? 'Your page title' }}
                                </div>
                                <div style="font-size:13px;color:#006621;margin-bottom:4px">
                                    {{ $settings['store_website'] ?? 'https://yoursite.com' }}
                                </div>
                                <div id="serpDesc"
                                    style="font-size:13px;color:#4d5156;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                                    {{ $settings['meta_description'] ?? 'Your meta description will appear here.' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary-custom">
                                Save SEO Settings
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<script>
    // ── Tab switching ─────────────────────────────────────────────────────────
    function showSettingsTab(tab, el) {
        document.querySelectorAll('.settings-tab').forEach(t => t.classList.add('d-none'));
        document.getElementById('settab-' + tab).classList.remove('d-none');
        document.querySelectorAll('.settings-nav .nav-link').forEach(l => l.classList.remove('active'));
        if (el) el.classList.add('active');
        return false;
    }

    // ── Logo preview ──────────────────────────────────────────────────────────
    document.getElementById('logoInput')?.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;
        const url = URL.createObjectURL(file);
        const prev = document.getElementById('logoPreview');
        prev.outerHTML = `<img src="${url}" id="logoPreview"
            style="width:64px;height:64px;border-radius:14px;object-fit:cover;border:1.5px solid var(--border)">`;
    });

    // ── SEO character counters + live SERP preview ────────────────────────────
    const metaTitleInput = document.querySelector('[name="meta_title"]');
    const metaDescInput = document.querySelector('[name="meta_description"]');

    metaTitleInput?.addEventListener('input', function() {
        document.getElementById('metaTitleCount').textContent = this.value.length;
        document.getElementById('serpTitle').textContent = this.value || 'Your page title';
    });

    metaDescInput?.addEventListener('input', function() {
        document.getElementById('metaDescCount').textContent = this.value.length;
        document.getElementById('serpDesc').textContent = this.value || 'Your meta description will appear here.';
    });
</script>

@endsection