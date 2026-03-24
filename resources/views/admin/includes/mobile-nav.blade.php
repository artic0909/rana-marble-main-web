  <!-- MOBILE BOTTOM NAV -->
  <nav id="mobile-bottom-nav">
      <a href="{{ route('admin.dashboard') }}" class="mob-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i
              class="bi bi-grid-1x2"></i><span>Home</span></a>
      <a href="{{ route('admin.orders.index') }}" class="mob-nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"><i class="bi bi-receipt"></i><span>Orders</span></a>
      <a href="{{ route('admin.products.index') }}" class="mob-nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"><i
              class="bi bi-box-seam"></i><span>Products</span></a>
      <a href="{{ route('admin.customers.index') }}" class="mob-nav-item {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}"><i
              class="bi bi-people"></i><span>Customers</span></a>
      <button class="mob-nav-item"
          onclick="document.getElementById('sidebar').classList.toggle('mobile-open');document.getElementById('sidebar-overlay').classList.toggle('show')"><i
              class="bi bi-list"></i><span>More</span></button>
  </nav>