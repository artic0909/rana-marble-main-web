    <!-- Header -->
    <header>
        <div class="nav-inner">
            <a href="index.html" class="logo">
                <div class="logo-icon"><img src="{{ asset('./img/logo.png') }}" alt="" width="47"></div>
                <div class="logo-text">
                    <span class="brand">Rana Marble</span>
                    <br>
                    <span class="sub">Divine Craftsmanship</span>
                </div>
            </a>

            <nav>
                <ul class="nav-links">
                    <li><a href="{{route('home')}}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{route('product.all')}}" class="{{ request()->routeIs('product.*') ? 'active' : '' }}">All Products</a></li>
                    <li>
                        <div class="nav-dropdown">
                            <a href="#" class="dropdown-toggle">Categories <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                @foreach ($categories as $category)
                                <li><a href="{{route('product.all.category', $category->slug)}}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li><a href="{{route('about')}}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
                    <li><a href="{{route('contact')}}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                    <li>
                        <div class="nav-dropdown">
                            <a href="#" class="dropdown-toggle {{ request()->routeIs('profile', 'wishlist', 'orders', 'cart') ? 'active' : '' }}">Profile <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('profile')}}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">My Profile</a></li>
                                <li><a href="{{route('wishlist')}}" class="{{ request()->routeIs('wishlist') ? 'active' : '' }}">Wishlist</a></li>
                                <li><a href="{{route('orders')}}" class="{{ request()->routeIs('orders') ? 'active' : '' }}">Orders</a></li>
                                <li><a href="{{route('cart')}}" class="{{ request()->routeIs('cart') ? 'active' : '' }}">Cart Items</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="nav-actions">
                <a href="{{route('login')}}" class="nav-icon-btn" title="User"><i class="fas fa-user"></i></a>
                <a href="{{route('cart')}}" class="nav-icon-btn" title="cart"><i class="fas fa-cart-plus"></i><span
                        class="badge">0</span></a>
                <a href="{{route('contact')}}" class="btn-enquire-nav"><i class="fas fa-paper-plane"></i> Enquire Now</a>
                <button class="hamburger" onclick="toggleMobileNav()" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>

        <!-- Mobile Nav -->
        <nav class="mobile-nav" id="mobileNav">
            <a href="{{route('home')}}">Home</a>
            <a href="{{route('product.all')}}">All Products</a>
            <div class="mobile-dropdown">
                <button class="mobile-dropdown-btn" onclick="this.parentElement.classList.toggle('active')">
                    Categories <i class="fas fa-chevron-down"></i>
                </button>
                <div class="mobile-dropdown-content">
                    @foreach ($categories as $category)
                    <a href="{{route('product.all.category', $category->slug)}}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
            <a href="{{route('about')}}">About Us</a>
            <a href="{{route('contact')}}">Contact</a>
            <div class="mobile-dropdown">
                <button class="mobile-dropdown-btn" onclick="this.parentElement.classList.toggle('active')">
                    Profile <i class="fas fa-chevron-down"></i>
                </button>
                <div class="mobile-dropdown-content">
                    <a href="{{route('profile')}}">My Profile</a>
                    <a href="{{route('wishlist')}}">Wishlist</a>
                    <a href="{{route('orders')}}">Orders</a>
                    <a href="{{route('cart')}}">Cart Items</a>
                </div>
            </div>
        </nav>
    </header>