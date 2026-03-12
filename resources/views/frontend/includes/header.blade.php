    <!-- Header -->
    <header>
        <div class="nav-inner">
            <a href="index.html" class="logo">
                <div class="logo-icon"><img src="{{ asset('./img/logo.png') }}" alt="" width="45"></div>
                <div class="logo-text">
                    <span class="brand">Rana Marble</span>
                    <br>
                    <span class="sub">Divine Craftsmanship</span>
                </div>
            </a>

            <nav>
                <ul class="nav-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="products.html">All Products</a></li>
                    <li>
                        <div class="nav-dropdown">
                            <a href="#" class="dropdown-toggle">Categories <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="mandirs.html">Home Mandirs</a></li>
                                <li><a href="idols.html">Marble Idols</a></li>
                                <li><a href="pillars.html">Pillars & Columns</a></li>
                                <li><a href="wall-panels.html">Jaali Panels</a></li>
                                <li><a href="fountains.html">Marble Fountains</a></li>
                                <li><a href="custom.html">Custom Orders</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li>
                        <div class="nav-dropdown">
                            <a href="#" class="dropdown-toggle">Profile <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="profile.html">My Profile</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                                <li><a href="orders.html">Orders</a></li>
                                <li><a href="cart.html">Cart Items</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="nav-actions">
                <!-- <a href="search.html" class="nav-icon-btn" title="Search"><i class="fas fa-search"></i></a> -->
                <a href="login.html" class="nav-icon-btn" title="User"><i class="fas fa-user"></i></a>
                <a href="cart.html" class="nav-icon-btn" title="cart"><i class="fas fa-cart-plus"></i><span
                        class="badge">0</span></a>
                <a href="contact.html" class="btn-enquire-nav"><i class="fas fa-paper-plane"></i> Enquire Now</a>
                <button class="hamburger" onclick="toggleMobileNav()" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>

        <!-- Mobile Nav -->
        <nav class="mobile-nav" id="mobileNav">
            <a href="index.html">Home</a>
            <a href="products.html">All Products</a>
            <div class="mobile-dropdown">
                <button class="mobile-dropdown-btn" onclick="this.parentElement.classList.toggle('active')">
                    Categories <i class="fas fa-chevron-down"></i>
                </button>
                <div class="mobile-dropdown-content">
                    <a href="mandirs.html">Home Mandirs</a>
                    <a href="idols.html">Marble Idols</a>
                    <a href="pillars.html">Pillars & Columns</a>
                    <a href="wall-panels.html">Jaali Panels</a>
                    <a href="fountains.html">Marble Fountains</a>
                    <a href="custom.html">Custom Orders</a>
                </div>
            </div>
            <a href="about.html">About Us</a>
            <a href="contact.html">Contact</a>
            <div class="mobile-dropdown">
                <button class="mobile-dropdown-btn" onclick="this.parentElement.classList.toggle('active')">
                    Profile <i class="fas fa-chevron-down"></i>
                </button>
                <div class="mobile-dropdown-content">
                    <a href="profile.html">My Profile</a>
                    <a href="wishlist.html">Wishlist</a>
                    <a href="orders.html">Orders</a>
                    <a href="cart.html">Cart Items</a>
                </div>
            </div>
        </nav>
    </header>