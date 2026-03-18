<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Rana Marble – Divine Marble Mandirs & Temple Crafts')</title>
    <meta name="description"
        content="Rana Marble crafts exquisite handcrafted marble mandirs, temple idols, and spiritual décor. Browse our divine collection and enquire directly via WhatsApp." />
    <meta name="keywords"
        content="marble mandir, white marble temple, home temple, pooja mandir, marble idol, handcrafted temple, Rana Marble" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Cinzel:wght@400;500;600;700&family=Crimson+Pro:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <link rel="stylesheet" href="{{asset('./css/style.css')}}">

    <!-- Ico favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('./img/favicon.ico')}}">


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
        <a href="tel:+919876543210"><i class="fas fa-phone-alt"></i> +91 98765 43210</a>
        <a href="/cdn-cgi/l/email-protection#523b3c343d1220333c333f3320303e37377c313d3f"><i class="fas fa-envelope"></i>
            <span class="__cf_email__"
                data-cfemail="41282f272e0133202f202c2033232d24246f222e2c">[email&#160;protected]</span></a>
        <a href="#"><i class="fab fa-whatsapp"></i> WhatsApp Us</a>
    </div>


    @include('frontend.includes.header')

    @yield('content')


    @include('frontend.includes.footer')
    @include('frontend.includes.scripts')

</body>

</html>