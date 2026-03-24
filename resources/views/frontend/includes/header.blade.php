    <!-- Header -->
    <header>
        <div class="nav-inner">
            @guest
            <a href="{{route('home')}}" class="logo">
                <div class="logo-icon"><img src="{{ asset('./img/logo.png') }}" alt="" width="47"></div>
                <div class="logo-text">
                    <span class="brand">Rana Marble</span>
                    <br>
                    <span class="sub">Divine Craftsmanship</span>
                </div>
            </a>
            @endguest
            @auth
            <a href="{{route('customer.home')}}" class="logo">
                <div class="logo-icon"><img src="{{ asset('./img/logo.png') }}" alt="" width="47"></div>
                <div class="logo-text">
                    <span class="brand">Rana Marble</span>
                    <br>
                    <span class="sub">Divine Craftsmanship</span>
                </div>
            </a>
            @endauth

            <nav>
                <ul class="nav-links">
                    @guest
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
                    @endguest
                    @auth
                    <li><a href="{{route('customer.home')}}" class="{{ request()->routeIs('customer.home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{route('customer.product.all')}}" class="{{ request()->routeIs('customer.product.*') ? 'active' : '' }}">All Products</a></li>
                    <li>
                        <div class="nav-dropdown">
                            <a href="#" class="dropdown-toggle">Categories <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                @foreach ($categories as $category)
                                <li><a href="{{route('customer.product.all.category', $category->slug)}}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li><a href="{{route('customer.about')}}" class="{{ request()->routeIs('customer.about') ? 'active' : '' }}">About Us</a></li>
                    <li><a href="{{route('customer.contact')}}" class="{{ request()->routeIs('customer.contact') ? 'active' : '' }}">Contact</a></li>
                    @endauth
                    <li>
                        <div class="nav-dropdown">
                            <a href="#" class="dropdown-toggle {{ request()->routeIs('customer.profile', 'customer.wishlist', 'customer.orders', 'customer.cart') ? 'active' : '' }}">Profile <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('customer.profile')}}" class="{{ request()->routeIs('customer.profile') ? 'active' : '' }}">My Profile</a></li>
                                <li><a href="{{route('customer.wishlist')}}" class="{{ request()->routeIs('customer.wishlist') ? 'active' : '' }}">Wishlist</a></li>
                                <li><a href="{{route('customer.orders')}}" class="{{ request()->routeIs('customer.orders') ? 'active' : '' }}">Orders</a></li>
                                <li><a href="{{route('customer.cart')}}" class="{{ request()->routeIs('cart') ? 'active' : '' }}">Cart Items</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="nav-actions">
                @guest
                <a href="{{route('login')}}" class="nav-icon-btn" title="User"><i class="fas fa-user"></i></a>
                @endguest
                @auth
                <a href="{{route('customer.profile')}}" class="nav-icon-btn" title="User"><i class="fas fa-user"></i></a>
                @endauth
                <a href="{{route('customer.cart')}}" class="nav-icon-btn" title="cart"><i class="fas fa-cart-plus"></i><span
                        class="badge">{{ $cartCount ?? 0 }}</span></a>
                @guest
                <a href="{{route('contact')}}" class="btn-enquire-nav"><i class="fas fa-paper-plane"></i> Enquire Now</a>
                @endguest
                @auth
                <a href="{{route('customer.contact')}}" class="btn-enquire-nav"><i class="fas fa-paper-plane"></i> Enquire Now</a>
                @endauth
                <button class="hamburger" onclick="toggleMobileNav()" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>

        <!-- Mobile Nav -->
        <nav class="mobile-nav" id="mobileNav">
            @guest
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
            @endguest
            @auth
            <a href="{{route('customer.home')}}">Home</a>
            <a href="{{route('customer.product.all')}}">All Products</a>
            <div class="mobile-dropdown">
                <button class="mobile-dropdown-btn" onclick="this.parentElement.classList.toggle('active')">
                    Categories <i class="fas fa-chevron-down"></i>
                </button>
                <div class="mobile-dropdown-content">
                    @foreach ($categories as $category)
                    <a href="{{route('customer.product.all.category', $category->slug)}}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
            <a href="{{route('customer.about')}}">About Us</a>
            <a href="{{route('customer.contact')}}">Contact</a>
            @endauth
            <div class="mobile-dropdown">
                <button class="mobile-dropdown-btn" onclick="this.parentElement.classList.toggle('active')">
                    Profile <i class="fas fa-chevron-down"></i>
                </button>
                <div class="mobile-dropdown-content">
                    <a href="{{route('customer.profile')}}">My Profile</a>
                    <a href="{{route('customer.wishlist')}}">Wishlist</a>
                    <a href="{{route('customer.orders')}}">Orders</a>
                    <a href="{{route('customer.cart')}}">Cart Items</a>
                </div>
            </div>
        </nav>
    </header>