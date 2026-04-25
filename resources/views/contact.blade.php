@extends('frontend.layout.app')

@section('title', 'Contact Us - Rana Marble | Get Your Custom Marble Mandir')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('./css/contact.css') }}">
</head>


<!-- ═══════════════════════════════════ CONTACT HERO ═══════════════════════════════════ -->
<section class="contact-hero">
    <div class="container">
        <h1 class="contact-hero-title">Connect With Us</h1>
        <p class="contact-hero-sub">Whether you seek a custom design or wish to visit our workshop in Rajasthan, we
            are here to guide you in bringing the divine into your home.</p>
    </div>
</section>

<!-- ═══════════════════════════════════ CONTACT FORM & INFO ═══════════════════════════════════ -->
<section class="contact-section">
    <div class="container contact-container">

        <!-- Contact Info -->
        <div class="contact-info">
            <div class="contact-card">
                <div class="contact-icon-wrap"><i class="fas fa-map-marker-alt"></i></div>
                <div class="contact-details">
                    <h3>Our Workshop</h3>
                    <p>{{ \App\Models\Setting::get('store_address') }}</p>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-icon-wrap"><i class="fab fa-whatsapp"></i></div>
                <div class="contact-details">
                    <h3>WhatsApp Us</h3>
                    <p>Get instant quotes, share designs, or schedule a video call tour.</p>
                    <a href="https://wa.me/{{ \App\Models\Setting::get('store_phone') }}"><strong>{{ \App\Models\Setting::get('store_phone') }}</strong></a>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-icon-wrap"><i class="fas fa-envelope"></i></div>
                <div class="contact-details">
                    <h3>Email Enquiries</h3>
                    <p>For custom proposals and B2B requirements.</p>
                    <a href="mailto:{{ \App\Models\Setting::get('store_email') }}"><strong>{{ \App\Models\Setting::get('store_email') }}</strong></a>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-icon-wrap"><i class="fas fa-clock"></i></div>
                <div class="contact-details">
                    <h3>Working Hours</h3>
                    <p>Monday – Sunday:<br>24/7 Open</p>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form-wrap">
            <h2 class="contact-form-heading">Send an Enquiry</h2>
            <p class="contact-form-sub">Share your requirements (size, design preferences) and our team will get
                back to you with details.</p>
            {{-- Success Message --}}
            @if(session('contact_success'))
            <div style="background:rgba(39,174,96,0.1);border:1px solid #27ae60;color:#27ae60;
        border-radius:6px;padding:14px 18px;margin-bottom:24px;
        font-family:'Crimson Pro',serif;font-size:0.95rem;
        display:flex;align-items:center;gap:8px;">
                <i class="fas fa-check-circle"></i> {{ session('contact_success') }}
            </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
            <div style="background:rgba(231,76,60,0.08);border:1px solid #e74c3c;color:#e74c3c;
        border-radius:6px;padding:14px 18px;margin-bottom:24px;
        font-family:'Crimson Pro',serif;font-size:0.95rem;
        display:flex;align-items:center;gap:8px;">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
            @endif

            @guest('customer')
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                @endguest

                @auth('customer')
                <form action="{{ route('customer.contact.store') }}" method="POST">
                    @csrf
                    @endauth

                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="E.g. Rahul Sharma"
                            value="{{ old('name', Auth::guard('customer')->user()->name ?? '') }}"
                            required>
                    </div>

                    <div class="form-row">
                        <div class="form-group" style="flex:1;">
                            <label for="phone">Phone / WhatsApp *</label>
                            <input type="tel" id="phone" name="phone" class="form-control"
                                placeholder="+91 00000 00000"
                                value="{{ old('phone', Auth::guard('customer')->user()->phone ?? '') }}"
                                required>
                        </div>
                        <div class="form-group" style="flex:1;">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="your@email.com"
                                value="{{ old('email', Auth::guard('customer')->user()->email ?? '') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inquiry_about">Inquiry About *</label>
                        <select id="inquiry_about" name="inquiry_about" class="form-control" required>
                            <option value="" selected>Choose Inquiry About</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->name }}"
                                {{ old('inquiry_about') === $category->name ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                            <option value="Others" {{ old('inquiry_about') === 'Others' ? 'selected' : '' }}>
                                Others
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority *</label>
                        <select id="priority" name="priority" class="form-control" required>
                            <option value="" selected>Choose priority</option>
                            
                            <option value="High" {{ old('priority') === 'Hight' ? 'selected' : '' }}>
                                High
                            </option>

                            <option value="Medium" {{ old('priority') === 'Medium' ? 'selected' : '' }}>
                                Medium
                            </option>

                            <option value="Low" {{ old('priority') === 'Low' ? 'selected' : '' }}>
                                Low
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Message / Details *</label>
                        <textarea id="message" name="message" class="form-control"
                            placeholder="Please mention approximate size, preferred style, or any specific questions..."
                            required>{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Send Enquiry
                    </button>

                    <p style="text-align:center;margin-top:15px;font-size:0.9rem;color:#777;">
                        We'll respond within 24 hours.
                    </p>
                </form>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════ GOOGLE MAP (IFRAME) ═══════════════════════════════════ -->
<section class="map-section">
    <div class="container">
        <div class="section-header" style="text-align: center; margin-bottom: 40px;">
            <h2 class="section-title">Visit Our Mandi</h2>
            <div class="gold-line" style="margin: 20px auto;"></div>
        </div>
        <div class="map-container">
            <!-- Using Makrana, Rajasthan coordinates as embed -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d4374.417580887512!2d87.97176737529654!3d22.437919279587867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjLCsDI2JzE2LjUiTiA4N8KwNTgnMjcuNiJF!5e1!3m2!1sen!2sin!4v1777094480746!5m2!1sen!2sin" width="100%" height="100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<!-- Ornament Divider -->
<div class="ornament-divider" style="margin: 0 0 40px; text-align: center; color: var(--saffron);"><i class="fas fa-om"></i></div>

@endsection