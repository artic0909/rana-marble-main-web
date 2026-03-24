@extends('frontend.layout.app')

@section('title', 'About Us - Rana Marble | Divine Marble Mandirs & Temple Crafts')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('./css/about.css') }}">
</head>


<!-- ═══════════════════════════════════ ABOUT HERO ═══════════════════════════════════ -->
<section class="about-hero">
    <!-- Spiritual Animation Elements -->
    <div class="spiritual-mandala"></div>
    <div class="floating-symbol sym-1"><i class="fas fa-om"></i></div>
    <div class="floating-symbol sym-2"><i class="fas fa-dharmachakra"></i></div>
    <div class="floating-symbol sym-3"><i class="fas fa-spa"></i></div>

    <div class="container relative-container">
        <h1 class="about-hero-title">Crafting Divinity Since 2005</h1>
        <p class="about-hero-sub">Rooted in the heart of Rajasthan, we breathe life into pure Makrana marble,
            transforming it into sacred spaces of worship that honor centuries of spiritual tradition.</p>
    </div>
</section>

<!-- ═══════════════════════════════════ OUR STORY ═══════════════════════════════════ -->
<section class="about-story">
    <div class="container story-container">
        <div class="story-content">
            <h2>Our Journey of Faith</h2>
            <p>What began as a small workshop in Makrana over two decades ago has blossomed into India's most
                trusted name for handcrafted marble mandirs and divine architecture. At Rana Marble, our craft is
                more than a profession—it is an act of devotion.</p>
            <p>Every chisel stroke carries the legacy of Rajasthani artisans who have passed down their mystical
                skills through generations. We pride ourselves on using only authentic, Grade-A Makrana marble, the
                very same pristine stone that built the Taj Mahal, ensuring that your sacred sanctuary remains
                luminous and eternal.</p>
            <p>Guided by spiritual principles and Vastu Shastra, we meticulously design mandirs that invite positive
                energy, tranquility, and divine grace into your home.</p>
        </div>
        <div class="story-image">
            <img src="{{ asset('./img/hero.png') }}" alt="Artisan carving marble at Rana Marble" loading="lazy" />
        </div>
    </div>
</section>

<!-- Ornament Divider -->
<div class="ornament-divider" style="margin: 40px 0; text-align: center; color: var(--saffron);"><i class="fas fa-om"></i></div>

<!-- ═══════════════════════════════════ WHY US ═══════════════════════════════════ -->
<section class="section why-section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><i class="fas fa-award"></i> &nbsp; The Rana Edge</span>
            <h2 class="section-title">The Pillars of Our Craft</h2>
            <p class="section-sub">Why thousands of families trust us to create the spiritual center of their homes.
            </p>
            <div class="gold-line"></div>
        </div>

        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-gem"></i></div>
                <h3 class="why-title">Pure Makrana Marble</h3>
                <p class="why-desc">We source only the finest Grade-A white Makrana marble for unmatched luminosity
                    and durability.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-hands"></i></div>
                <h3 class="why-title">Master Artisan Carved</h3>
                <p class="why-desc">Each mandir is hand-carved by craftsmen with 20+ years of experience in
                    Rajasthani stone art.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-om"></i></div>
                <h3 class="why-title">Vastu Compliant</h3>
                <p class="why-desc">Our designs incorporate ancient Vastu principles to ensure optimal aura and
                    spiritual alignment.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-truck"></i></div>
                <h3 class="why-title">Safe Pan-India Delivery</h3>
                <p class="why-desc">Carefully packed in custom wooden crates and delivered with professional
                    handling across India.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════ ARTISANS ═══════════════════════════════════ -->
<section class="artisans-section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag"><i class="fas fa-hammer"></i> &nbsp; Master Hands</span>
            <h2 class="section-title">Meet Our Master Artisans</h2>
            <p class="section-sub">The devoted souls behind the mesmerizing beauty of our marble collection.</p>
            <div class="gold-line"></div>
        </div>

        <div class="artisans-grid">
            <div class="artisan-card">
                <div class="artisan-icon"><i class="fas fa-vihara"></i></div>
                <h3 class="artisan-name">The Sculptors</h3>
                <p class="artisan-desc">Experts in structure and form, bringing grand monolithic marble blocks to
                    life with intricate archways, pillars, and domes.</p>
            </div>
            <div class="artisan-card">
                <div class="artisan-icon"><i class="fas fa-paint-brush"></i></div>
                <h3 class="artisan-name">The Painters</h3>
                <p class="artisan-desc">Specialists in traditional Meenakari and 22K gold leaf techniques, adding
                    divine vibrancy and regal elegance to our carvings.</p>
            </div>
            <div class="artisan-card">
                <div class="artisan-icon"><i class="fas fa-border-all"></i></div>
                <h3 class="artisan-name">The Jaali Weavers</h3>
                <p class="artisan-desc">Masters of precision who carve breathtaking delicate latticework (jaali)
                    that allow light to dance gracefully within the mandir.</p>
            </div>
        </div>
    </div>
</section>

@endsection