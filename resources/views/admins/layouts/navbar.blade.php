<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="dashboard-2.html" target="_blank">
        <img src="{{ asset('../admin/img/logo-ct-dark.png') }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Shop của cáo</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-dark" href="#">
            <i class="material-symbols-rounded opacity-5">supervisor_account</i>
            <span class="nav-link-text ms-1">Người dùng</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.categories.listCategory') }}">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Danh mục</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.products.listProduct') }}">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Sản phẩm</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.variants.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.variants.listVariant') }}">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Biến thể</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="#">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Hóa đơn</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.colors.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.colors.listColor') }}">
            <i class="material-symbols-rounded opacity-5">format_color_fill</i>
            <span class="nav-link-text ms-1">Màu sắc</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.sizes.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.sizes.listSize') }}">
            <i class="material-symbols-rounded opacity-5">square_foot</i>
            <span class="nav-link-text ms-1">Kích thước</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>