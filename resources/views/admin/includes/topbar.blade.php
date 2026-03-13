    <!-- TOPBAR -->
    <header id="topbar">
      <button id="sidebar-toggle" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
      <div class="topbar-search">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Search products, orders, customers…">
      </div>
      <div class="topbar-actions">
        <div class="topbar-icon-btn" onclick="navigate('support')" title="Support">
          <i class="bi bi-headset"></i>
          <div class="dot"></div>
        </div>
        <div class="topbar-icon-btn position-relative" data-bs-toggle="dropdown" title="Notifications">
          <i class="bi bi-bell"></i>
          <div class="dot"></div>
        </div>
        <ul class="dropdown-menu dropdown-menu-end p-0"
          style="width:320px;border-radius:14px;overflow:hidden;border:1.5px solid var(--border);box-shadow:var(--shadow-lg)">
          <li class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center">
            <strong style="font-family:'Syne',sans-serif">Notifications</strong>
            <span class="badge" style="background:var(--primary);border-radius:20px">7 new</span>
          </li>
          <li class="notif-item unread">
            <div class="fw-600" style="font-size:13px">New order #4521 placed</div>
            <div style="font-size:11px;color:var(--text-muted)">2 min ago · $149.00</div>
          </li>
          <li class="notif-item unread">
            <div class="fw-600" style="font-size:13px">Low stock: Nike Air Max</div>
            <div style="font-size:11px;color:var(--text-muted)">15 min ago · 3 units left</div>
          </li>
          <li class="notif-item">
            <div class="fw-600" style="font-size:13px">Payment received #4519</div>
            <div style="font-size:11px;color:var(--text-muted)">1 hr ago · $89.00</div>
          </li>
          <li class="notif-item">
            <div class="fw-600" style="font-size:13px">New review on iPhone Case</div>
            <div style="font-size:11px;color:var(--text-muted)">3 hr ago · ★★★★★</div>
          </li>
          <li class="notif-item">
            <div class="fw-600" style="font-size:13px">Return request #1029</div>
            <div style="font-size:11px;color:var(--text-muted)">5 hr ago</div>
          </li>
          <li class="p-3 text-center"><a href="#" class="text-primary-custom fw-600" style="font-size:13px"
              onclick="navigate('support')">View all notifications</a></li>
        </ul>
        <div class="topbar-avatar" data-bs-toggle="dropdown">A</div>
        <ul class="dropdown-menu dropdown-menu-end"
          style="border-radius:12px;border:1.5px solid var(--border);box-shadow:var(--shadow-lg);min-width:180px;">
          <li><a class="dropdown-item py-2" href="#" onclick="navigate('settings')"><i class="bi bi-person me-2"></i>My
              Profile</a></li>
          <li><a class="dropdown-item py-2" href="#" onclick="navigate('settings')"><i
                class="bi bi-gear me-2"></i>Settings</a></li>
          <li>
            <hr class="dropdown-divider my-1">
          </li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item py-2 text-danger">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </header>