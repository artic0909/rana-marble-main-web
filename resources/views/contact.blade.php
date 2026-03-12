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
                    <p>Near Makrana Marble Mandi,<br>Makrana, Nagaur,<br>Rajasthan – 341505</p>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-icon-wrap"><i class="fab fa-whatsapp"></i></div>
                <div class="contact-details">
                    <h3>WhatsApp Us</h3>
                    <p>Get instant quotes, share designs, or schedule a video call tour.</p>
                    <a href="https://wa.me/919876543210"><strong>+91 98765 43210</strong></a>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-icon-wrap"><i class="fas fa-envelope"></i></div>
                <div class="contact-details">
                    <h3>Email Enquiries</h3>
                    <p>For custom proposals and B2B requirements.</p>
                    <a href="mailto:info@ranamarble.com"><strong>info@ranamarble.com</strong></a>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-icon-wrap"><i class="fas fa-clock"></i></div>
                <div class="contact-details">
                    <h3>Working Hours</h3>
                    <p>Monday – Saturday:<br>9:00 AM – 7:00 PM IST</p>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form-wrap">
            <h2 class="contact-form-heading">Send an Enquiry</h2>
            <p class="contact-form-sub">Share your requirements (size, design preferences) and our team will get
                back to you with details.</p>

            <form action="#" method="POST"
                onsubmit="event.preventDefault(); alert('In a real site, this would submit the form!');">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" class="form-control" placeholder="E.g. Rahul Sharma" required>
                </div>

                <div class="form-row">
                    <div class="form-group" style="flex: 1;">
                        <label for="phone">Phone / WhatsApp *</label>
                        <input type="tel" id="phone" class="form-control" placeholder="+91 00000 00000" required>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" class="form-control" placeholder="your@email.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="interest">Interested In</label>
                    <select id="interest" class="form-control">
                        <option value="Home Mandir">Home Mandir</option>
                        <option value="Temple Project">Large Temple Project</option>
                        <option value="Custom Order">Custom Design Order</option>
                        <option value="Marble Idols">Marble Idols</option>
                        <option value="Other">Other Query</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Message / Details</label>
                    <textarea id="message" class="form-control"
                        placeholder="Please mention approximate size, preferred style, or any specific questions..."
                        required></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Send Enquiry
                </button>
                <p style="text-align: center; margin-top: 15px; font-size: 0.9rem; color: #777;">We'll respond
                    within 24 hours.</p>
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
            <iframe class="map-iframe"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d113642.50854406164!2d74.65431326490614!3d27.0396001257766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396bedbc1b29a27f%3A0xc3ab5d49e1a8e1df!2sMakrana%2C%20Rajasthan%20341505!5e0!3m2!1sen!2sin!4v1709722362453!5m2!1sen!2sin"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<!-- Ornament Divider -->
<div class="ornament-divider" style="margin: 0 0 40px; text-align: center; color: var(--saffron);"><i class="fas fa-om"></i></div>

@endsection