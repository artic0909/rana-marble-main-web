<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title', $seo['meta_title'] ?? $seo['store_name'] ?? 'Rana Marble')</title>
    <meta name="description" content="@yield('meta_description', $seo['meta_description'] ?? '')">
    <meta name="keywords" content="@yield('meta_keywords',    $seo['meta_keywords'] ?? '')">

    <meta property="og:title" content="@yield('title',            $seo['meta_title'] ?? '')">
    <meta property="og:description" content="@yield('meta_description', $seo['meta_description'] ?? '')">
    <meta property="og:image" content="@yield('og_image',         $seo['og_image'] ?? '')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title',            $seo['meta_title'] ?? '')">
    <meta name="twitter:description" content="@yield('meta_description', $seo['meta_description'] ?? '')">
    <meta name="twitter:image" content="@yield('og_image',         $seo['og_image'] ?? '')">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Cinzel:wght@400;500;600;700&family=Crimson+Pro:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <link rel="stylesheet" href="{{asset('./css/style.css')}}">

    <!-- Ico favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('./img/favicon.ico')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="https://www.ranamarble.info{{ request()->getPathInfo() }}" />


    <!-- {{-- Per-page SEO (set from any view using @section) --}} -->
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('meta_description', ''))">
    <meta name="keywords" content="@yield('meta_keywords',    \App\Models\Setting::get('meta_keywords', ''))">
    <meta property="og:title" content="@yield('og_title', \App\Models\Setting::get('meta_title', ''))">
    <meta property="og:description" content="@yield('meta_description', \App\Models\Setting::get('meta_description', ''))">
    <meta property="og:image" content="@yield('og_image', \App\Models\Setting::get('og_image', ''))">
    <meta name="robots" content="{{ \App\Models\Setting::get('robots', 'index,follow') }}">
    @if(\App\Models\Setting::get('google_verification'))
    <meta name="google-site-verification" content="{{ \App\Models\Setting::get('google_verification') }}">
    @endif

</head>

<body>
    <!-- Announcement Bar -->
    <div class="announce-bar">
        <div class="announce-track">
            <span>🪔 Handcrafted with Devotion</span>
            <span></span>
            <span>Free Delivery on Orders Above ₹25,000</span>
            <span></span>
            <span>Custom Size &amp; Design Available</span>
            <span>✦</span>
            <span>Premium White Makrana Marble</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span>🪔 Handcrafted with Devotion</span>
            <span></span>
            <span>Free Delivery on Orders Above ₹25,000</span>
            <span></span>
            <span>Custom Size &amp; Design Available</span>
            <span>✦</span>
            <span>Premium White Makrana Marble</span>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </div>
    </div>

    <!-- Topbar -->
    <div class="topbar">
        <a href="tel:+919876543210"><i class="fas fa-phone"></i> {{ \App\Models\Setting::get('store_phone') }}</a>
        <a href="mailto:{{ \App\Models\Setting::get('store_email') }}"><i class="fas fa-envelope"></i>
            <span class="__cf_email__"
                data-cfemail="{{ \App\Models\Setting::get('store_email') }}">{{ \App\Models\Setting::get('store_email') }}</span></a>
        @php
        $phone = \App\Models\Setting::get('store_phone');
        $message = urlencode('Hi! I visited your website(ranamarble.info) and would like to know more. / হ্যালো! আমি আপনার ওয়েবসাইট পরিদর্শন করেছি এবং আরও জানতে চাই।');
        @endphp

        <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank">
            <i class="fab fa-whatsapp"></i> WhatsApp Us
        </a>
    </div>


    @include('frontend.includes.header')

    @yield('content')


    @include('frontend.includes.footer')
    @include('frontend.includes.scripts')


    <script>
        function toggleWishlist(btn, productId) {
            fetch(`/customer/wishlist/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ??
                            "{{ csrf_token() }}",
                        'Accept': 'application/json',
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                        return;
                    }
                    if (data.success) {
                        // Toggle heart color
                        btn.style.color = data.added ? 'var(--saffron)' : '';
                        showWishlistToast(data.message, data.added);
                    }
                })
                .catch(() => alert('Something went wrong.'));
        }

        function showWishlistToast(msg, added) {
            let toast = document.getElementById('wishToast');
            if (!toast) {
                toast = document.createElement('div');
                toast.id = 'wishToast';
                toast.style.cssText = `
            position:fixed;bottom:30px;left:50%;transform:translateX(-50%);
            color:white;padding:14px 24px;border-radius:8px;
            font-family:'Cinzel',serif;font-size:0.85rem;letter-spacing:0.08em;
            box-shadow:0 8px 24px rgba(0,0,0,0.2);z-index:9999;
            display:flex;align-items:center;gap:10px;transition:opacity 0.4s;
        `;
                document.body.appendChild(toast);
            }
            toast.style.background = added ?
                'linear-gradient(135deg,#e74c3c,#c0392b)' :
                'linear-gradient(135deg,#7f8c8d,#636e72)';
            toast.style.opacity = '1';
            toast.innerHTML = `<i class="fas fa-heart"></i> ${msg}`;
            clearTimeout(toast._t);
            toast._t = setTimeout(() => {
                toast.style.opacity = '0';
            }, 3000);
        }
    </script>

</body>

</html>