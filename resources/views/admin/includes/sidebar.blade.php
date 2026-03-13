  <!-- SIDEBAR OVERLAY (mobile) -->
  <div id="sidebar-overlay"></div>

  <!-- ══════════════════ SIDEBAR ══════════════════ -->
  <nav id="sidebar">
      <a class="sidebar-brand" href="#" onclick="navigate('dashboard')">
          <div class="brand-icon"><i class="bi bi-bag-heart-fill"></i></div>
          <span class="brand-name nav-text">Shop<span>Nest</span></span>
      </a>

      <div class="sidebar-scroll">
          <div class="nav-section-label">Main</div>
          <button class="nav-link-item active" onclick="navigate('dashboard')"><i class="bi bi-grid-1x2"></i><span
                  class="nav-text">Dashboard</span></button>
          <button class="nav-link-item" onclick="navigate('analytics')"><i class="bi bi-bar-chart-line"></i><span
                  class="nav-text">Analytics</span></button>

          <div class="nav-section-label">Catalog</div>
          <button class="nav-link-item" onclick="navigate('products')"><i class="bi bi-box-seam"></i><span
                  class="nav-text">Products</span></button>
          <button class="nav-link-item" onclick="navigate('categories')"><i class="bi bi-grid"></i><span
                  class="nav-text">Categories</span></button>
          <button class="nav-link-item" onclick="navigate('inventory')"><i class="bi bi-archive"></i><span
                  class="nav-text">Inventory</span></button>
          <button class="nav-link-item" onclick="navigate('coupons')"><i class="bi bi-ticket-perforated"></i><span
                  class="nav-text">Coupons</span></button>
          <button class="nav-link-item" onclick="navigate('reviews')"><i class="bi bi-star"></i><span
                  class="nav-text">Reviews</span></button>

          <div class="nav-section-label">Sales</div>
          <button class="nav-link-item" onclick="navigate('orders')"><i class="bi bi-receipt"></i><span
                  class="nav-text">Orders <span class="badge-count">14</span></span></button>
          <button class="nav-link-item" onclick="navigate('returns')"><i class="bi bi-arrow-return-left"></i><span
                  class="nav-text">Returns <span class="badge-count">3</span></span></button>
          <button class="nav-link-item" onclick="navigate('shipping')"><i class="bi bi-truck"></i><span
                  class="nav-text">Shipping</span></button>
          <button class="nav-link-item" onclick="navigate('payments')"><i class="bi bi-credit-card"></i><span
                  class="nav-text">Payments</span></button>

          <div class="nav-section-label">People</div>
          <button class="nav-link-item" onclick="navigate('customers')"><i class="bi bi-people"></i><span
                  class="nav-text">Customers</span></button>
          <button class="nav-link-item" onclick="navigate('staff')"><i class="bi bi-person-badge"></i><span
                  class="nav-text">Staff</span></button>
          <button class="nav-link-item" onclick="navigate('vendors')"><i class="bi bi-shop"></i><span
                  class="nav-text">Vendors</span></button>

          <div class="nav-section-label">Content</div>
          <button class="nav-link-item" onclick="navigate('pages')"><i class="bi bi-file-earmark-text"></i><span
                  class="nav-text">Pages</span></button>
          <button class="nav-link-item" onclick="navigate('banners')"><i class="bi bi-image"></i><span
                  class="nav-text">Banners</span></button>
          <button class="nav-link-item" onclick="navigate('blog')"><i class="bi bi-newspaper"></i><span
                  class="nav-text">Blog</span></button>
          <button class="nav-link-item" onclick="navigate('emails')"><i class="bi bi-envelope"></i><span
                  class="nav-text">Emails</span></button>

          <div class="nav-section-label">Support</div>
          <button class="nav-link-item" onclick="navigate('support')"><i class="bi bi-headset"></i><span
                  class="nav-text">Support <span class="badge-count">7</span></span></button>
          <button class="nav-link-item" onclick="navigate('reports')"><i class="bi bi-file-bar-graph"></i><span
                  class="nav-text">Reports</span></button>
          <button class="nav-link-item" onclick="navigate('settings')"><i class="bi bi-gear"></i><span
                  class="nav-text">Settings</span></button>
      </div>

      <div class="sidebar-footer">
          <div class="sidebar-user-avatar">A</div>
          <div class="sidebar-user-info">
              <div class="sidebar-user-name">Admin User</div>
              <div class="sidebar-user-role">Super Admin</div>
          </div>
          <i class="bi bi-three-dots-vertical" style="color:rgba(255,255,255,.3);cursor:pointer;flex-shrink:0;"></i>
      </div>
  </nav>