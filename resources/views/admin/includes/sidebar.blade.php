  <!-- SIDEBAR OVERLAY (mobile) -->
  <div id="sidebar-overlay"></div>

  <!-- ══════════════════ SIDEBAR ══════════════════ -->
  <nav id="sidebar">
          <a href="" class="sidebar-brand" href="{{ route('admin.dashboard') }}">
                  <div class="brand-icon"><img src="{{asset('./img/logo.png')}}" alt="" width="50"></div>
                  <span class="brand-name nav-text">Rana<span>MRBL</span></span>
          </a>

          <div class="sidebar-scroll">
                  <div class="nav-section-label">Main</div>
                  <a href="{{ route('admin.dashboard') }}"
                          class="nav-link-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                          <i class="bi bi-grid-1x2"></i>
                          <span class="nav-text">Dashboard</span>
                  </a>

                  <div class="nav-section-label">Catalog</div>
                  <a href="{{ route('admin.products.index') }}" class="nav-link-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"><i class="bi bi-box-seam"></i><span
                                  class="nav-text">Products</span></a>

                  <a href="{{ route('admin.categories') }}" class="nav-link-item {{ request()->routeIs('admin.categories') ? 'active' : '' }}"><i class="bi bi-grid"></i><span
                                  class="nav-text">Categories</span></a>

                  <a href="{{ route('admin.sizes') }}" class="nav-link-item {{ request()->routeIs('admin.sizes') ? 'active' : '' }}"><i class="bi bi-archive"></i><span
                                  class="nav-text">Sizes</span></a>

                  <a href="{{ route('admin.colors') }}" class="nav-link-item {{ request()->routeIs('admin.colors') ? 'active' : '' }}"><i class="bi bi-ticket-perforated"></i><span
                                  class="nav-text">Colors</span></a>

                  <a href="{{ route('admin.pincode') }}" class="nav-link-item {{ request()->routeIs('admin.pincode') ? 'active' : '' }}"><i class="bi bi-ticket-perforated"></i><span
                                  class="nav-text">Pincode</span></a>

                  <a href="{{ route('admin.reviews') }}" class="nav-link-item {{ request()->routeIs('admin.reviews') ? 'active' : '' }}"><i class="bi bi-star"></i><span
                                  class="nav-text">Reviews</span></a>

                  <div class="nav-section-label">Sales</div>

                  <a href="{{ route('admin.orders.index') }}" class="nav-link-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"><i class="bi bi-receipt"></i><span
                                  class="nav-text">Orders <span class="badge-count">14</span></span></a>

                  <!-- <a href="{{ route('admin.returns.index') }}" class="nav-link-item {{ request()->routeIs('admin.returns.*') ? 'active' : '' }}"><i class="bi bi-arrow-return-left"></i><span
                                  class="nav-text">Returns <span class="badge-count">3</span></span></a>

                  <a href="{{ route('admin.shippings') }}" class="nav-link-item {{ request()->routeIs('admin.shippings') ? 'active' : '' }}"><i class="bi bi-truck"></i><span
                                  class="nav-text">Shipping</span></a>
                                  
                  <a href="{{ route('admin.payments') }}" class="nav-link-item {{ request()->routeIs('admin.payments') ? 'active' : '' }}"><i class="bi bi-credit-card"></i><span
                                  class="nav-text">Payments</span></a> -->

                  <div class="nav-section-label">People</div>

                  <a href="{{ route('admin.customers.index') }}" class="nav-link-item {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}"><i class="bi bi-people"></i><span
                                  class="nav-text">Customers</span></a>

                  <!-- <a href="" class="nav-link-item" onclick="navigate('staff')"><i class="bi bi-person-badge"></i><span
                                  class="nav-text">Staff</span></a>

                  <a href="" class="nav-link-item" onclick="navigate('vendors')"><i class="bi bi-shop"></i><span
                                  class="nav-text">Vendors</span></a> -->

                  <div class="nav-section-label">Content</div>

                  <!-- <a href="" class="nav-link-item" onclick="navigate('pages')"><i class="bi bi-file-earmark-text"></i><span
                                  class="nav-text">Pages</span></a> -->

                  <a href="{{ route('admin.banners.index') }}" class="nav-link-item {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}"><i class="bi bi-image"></i><span
                                  class="nav-text">Banners</span></a>

                  <!-- <a href="" class="nav-link-item" onclick="navigate('blog')"><i class="bi bi-newspaper"></i><span
                                  class="nav-text">Blog</span></a> -->

                  <!-- <a href="" class="nav-link-item" onclick="navigate('emails')"><i class="bi bi-envelope"></i><span
                                  class="nav-text">Emails</span></a> -->

                  <div class="nav-section-label">Support</div>

                  <a href="{{ route('admin.support') }}" class="nav-link-item {{ request()->routeIs('admin.support') ? 'active' : '' }}"><i class="bi bi-headset"></i><span
                                  class="nav-text">Support <span class="badge-count">7</span></span></a>

                  <!-- <a href="{{ route('admin.reports') }}" class="nav-link-item {{ request()->routeIs('admin.reports') ? 'active' : '' }}"><i class="bi bi-file-bar-graph"></i><span
                                  class="nav-text">Reports</span></a> -->

                  <a href="{{ route('admin.settings.index') }}" class="nav-link-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><i class="bi bi-gear"></i><span
                                  class="nav-text">Settings</span></a>
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