    <!-- ═══════════════════════════════════ CTA BAND ═══════════════════════════════════ -->
    <div class="cta-band">
        <h2>Ready to Bring the Divine Home?</h2>
        <p>Speak directly with our artisans — describe your vision and get a personalised quote.</p>
        <div class="cta-buttons">
            @php
            $phone = \App\Models\Setting::get('store_phone');
            $message = urlencode('Hi! I visited your website(ranamarble.info) and would like to know more. / হ্যালো! আমি আপনার ওয়েবসাইট পরিদর্শন করেছি এবং আরও জানতে চাই।');
            @endphp
            <a href="https://wa.me/{{ $phone }}?text={{ $message }}"
                class="btn-whatsapp" target="_blank">
                <i class="fab fa-whatsapp fa-lg"></i> Chat on WhatsApp
            </a>
            <a href="mailto:{{ \App\Models\Setting::get('store_email') }}" class="btn-white">
                <i class="fas fa-envelope"></i> Send Email Enquiry
            </a>
        </div>
    </div>

    <!-- ═══════════════════════════════════ FOOTER ═══════════════════════════════════ -->
    <footer>
        <div class="footer-grid">
            <!-- Brand -->
            <div class="footer-brand">
                <div class="logo">
                    <div class="logo-icon" style="background:linear-gradient(135deg,var(--saffron),var(--maroon));">
                        <img src="{{ asset('./img/logo.png') }}" alt="" width="50">
                    </div>
                    <div class="logo-text">
                        <span class="brand">Rana Marble</span>
                        <span class="sub">Divine Craftsmanship</span>
                    </div>
                </div>
                <p class="footer-about">
                    {{ \App\Models\Setting::get('meta_description') }}
                </p>
                <div class="footer-social">
                    <a href="#" class="social-btn" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-btn" title="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-btn" title="Pinterest"><i class="fab fa-pinterest-p"></i></a>
                    <a href="https://wa.me/{{ $phone }}?text={{ $message }}" class="social-btn" title="WhatsApp" target="_blank"><i
                            class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            @guest
            <!-- Quick Links -->
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"
                                style="font-size:0.7rem;color:var(--saffron);margin-right:6px;"></i> Home</a></li>
                    <li><a href="{{ route('product.all') }}"><i class="fas fa-chevron-right"
                                style="font-size:0.7rem;color:var(--saffron);margin-right:6px;"></i> All Products</a>
                    </li>
                    <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right"
                                style="font-size:0.7rem;color:var(--saffron);margin-right:6px;"></i> About Us</a></li>
                    <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right"
                                style="font-size:0.7rem;color:var(--saffron);margin-right:6px;"></i> Contact Us</a>
                    </li>
                    <li><a href="{{ route('login') }}"><i class="fas fa-chevron-right"
                                style="font-size:0.7rem;color:var(--saffron);margin-right:6px;"></i>Orders</a>
                    </li>
                    <li><a href="{{ route('login') }}"><i class="fas fa-chevron-right"
                                style="font-size:0.7rem;color:var(--saffron);margin-right:6px;"></i> My Wishlist</a>
                    </li>
                </ul>
            </div>

            <!-- Categories -->
            <div class="footer-col">
                <h4>Categories</h4>
                <ul>
                    @foreach ($categories as $category)
                    <li><a href="{{ route('product.all.category', $category->slug) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endguest

            @auth
            <!-- Quick Links -->
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('customer.home') }}"><i class="fas fa-chevron-right"
                                style="font-size:0.7rem;color:var(--saffron);margin-right:6px;"></i> Home</a></li>
                    <li><a href="{{ route('customer.product.all') }}"><i class="fas fa-chevron-right"
                                style="font-size:0.7rem;color:var(--saffron);margin-right:6px;"></i> All Products</a>
                    </li>
                    <li><a href="{{ route('customer.about') }}"><i class="fas fa-chevron-right"
                                style="font-size:0.7rem;color:var(--saffron);margin-right:6px;"></i> About Us</a></li>
                    <li><a href="{{ route('customer.contact') }}"><i class="fas fa-chevron-right"
                                style="font-size:0.7rem;color:var(--saffron);margin-right:6px;"></i> Contact Us</a>
                    </li>
                    <li><a href="{{ route('customer.orders') }}"><i class="fas fa-chevron-right"
                                style="font-size:0.7rem;color:var(--saffron);margin-right:6px;"></i>Orders</a>
                    </li>
                    <li><a href="{{ route('customer.wishlist') }}"><i class="fas fa-chevron-right"
                                style="font-size:0.7rem;color:var(--saffron);margin-right:6px;"></i> My Wishlist</a>
                    </li>
                </ul>
            </div>

            <!-- Categories -->
            <div class="footer-col">
                <h4>Categories</h4>
                <ul>
                    @foreach ($categories as $category)
                    <li><a href="{{ route('customer.product.all.category', $category->slug) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endauth

            <!-- Contact -->
            <div class="footer-col">
                <h4>Contact Us</h4>
                <div class="footer-contact">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ \App\Models\Setting::get('store_address') }}</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <a href="tel:{{ \App\Models\Setting::get('store_phone') }}">{{ \App\Models\Setting::get('store_phone') }}</a>
                    </div>
                    <div class="contact-item">
                        <i class="fab fa-whatsapp"></i>
                        <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank">WhatsApp Now</a>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{ \App\Models\Setting::get('store_email') }}"><span
                                class="__cf_email__"
                                data-cfemail="{{ \App\Models\Setting::get('store_email') }}">{{ \App\Models\Setting::get('store_email') }}</span></a>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <span>Mon – Sun: 24/7 Open</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <span>© 2026 Rana Marble. All Rights Reserved.</span>
            <span>Made with 🙏 in West Bengal, India</span>
        </div>
    </footer>

    <!-- Floating Contact Menu -->
    <div class="contact-floater-wrap">
        <a href="tel:{{ $phone }}" class="floater-contact-item tel" title="Call Us">
            <i class="fas fa-phone"></i>
            <span class="floater-contact-label">Call Now</span>
        </a>
        <a href="https://wa.me/{{ $phone }}?text={{ $message }}" 
            class="floater-contact-item wa" 
            target="_blank" 
            title="Chat on WhatsApp">
            <i class="fab fa-whatsapp"></i>
            <span class="floater-contact-label">WhatsApp</span>
        </a>
    </div>

    <!-- Scroll to Top -->
    <!-- <a href="#" class="scroll-top" id="scrollTop" title="Back to Top">
        <i class="fas fa-chevron-up"></i>
    </a> -->