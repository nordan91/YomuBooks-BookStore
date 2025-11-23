<nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="/" style="color: white; text-decoration: none;">
            <div style="display: flex; flex-direction: column; align-items: center;">
                <div style="font-size: 1.5rem; font-weight: 800; letter-spacing: 0.5px;">YomuBooks</div>
                <div style="font-size: 0.65rem; font-weight: 400; opacity: 0.8; margin-top: -2px;">Discover Stories. Yomu Your Way</div>
            </div>
        </a>
        <a class="sidebar-brand brand-logo-mini" href="/" style="color: white; text-decoration: none; font-size: 1.5rem; font-weight: 800; display: none;">
            <i class="mdi mdi-book"></i>
        </a>
      </div>
      <ul class="nav">
          @role('admin')
          <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                  <i class="mdi mdi-view-dashboard menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
              </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}"
                href="{{ route('admin.categories.index') }}">
                <i class="mdi mdi-shape menu-icon"></i>
                <span class="menu-title">Categories</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/sliders*') ? 'active' : '' }}"
                href="{{ route('admin.sliders.index') }}">
                <i class="mdi mdi-image menu-icon"></i>
                <span class="menu-title">Sliders</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/books*') ? 'active' : '' }}"
                href="{{ route('admin.books.index') }}">
                <i class="mdi mdi-book-multiple menu-icon"></i>
                <span class="menu-title">Books</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/transactions') ? 'active text-primary' : '' }}"
                href="{{ route('admin.transactions.index') }}">
                <i class="mdi mdi-cart menu-icon"></i>
                <span class="menu-title">Transactions</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="mdi mdi-chart-line menu-icon"></i>
                <span class="menu-title">Reports</span>
            </a>
          </li>
          @endrole

          @role('customer')
          <li class="nav-item">
              <a class="nav-link {{ request()->is('customers/dashboard') ? 'active' : '' }}" 
                  href="{{ route('customers.dashboard') }}">
                  <i class="mdi mdi-view-dashboard menu-icon"></i>
                  <span class="menu-title">Dashboard Customer</span>
              </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->is('customers/transactions') ? 'active text-primary' : '' }}"
                href="{{ route('customers.transactions.index') }}">
                <i class="mdi mdi-cart menu-icon"></i>
                <span class="menu-title">Transactions</span>
            </a>
          </li>
          @endrole
      </ul>
  </nav>
