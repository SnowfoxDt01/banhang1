<div class="header-area">    
            <div class="main-header ">
               <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                  <a href="{{ route('index') }}"><img class="img-logo" src="{{ asset('client/img/logo/logo-cao-tuyet.png') }}" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>                                                
                                        <ul id="navigation">                                                                                                                                     
                                            <li><a href="{{ route('index') }}">Trang chủ</a></li>
                                            <li><a href="{{ route('client.allproducts') }}">Danh mục</a>
                                                <ul class="submenu">
                                                    <li><a href="#">Danh mục 1</a></li>
                                                    <li><a href="#">Danh mục 2</a></li>
                                                </ul>
                                            </li>
                                            <li class="hot"><a href="#">Sản phẩm nổi bật</a>
                                                <ul class="submenu">
                                                    <li><a href="#">Sản phẩm thuộc danh mục 1</a></li>
                                                    <li><a href="#">Sản phẩm thuộc danh mục 2</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="blog.html">Tin tức</a></li>
                                            <li><a href="#">Trang</a>
                                                <ul class="submenu">
                                                    <li><a href="#">Giới thiệu</a></li>
                                                    <li><a href="#">Hướng dẫn</a></li>
                                                    <li><a href="#">Liên hệ</a></li>
                                                    <li><a href="#">Chăm sóc khách hàng</a></li>
                                                    <li><a href="#">Hoàn tiền sản phẩm</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Liên hệ</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div> 
                            <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                                <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">
                                    <li class="d-none d-xl-block">
                                        <div class="form-box f-right ">
                                            <input type="text" name="Search" placeholder="tìm kiếm ...">
                                            <div class="search-icon">
                                                <i class="fas fa-search special-tag"></i>
                                            </div>
                                        </div>
                                     </li>
                                    <li class=" d-none d-xl-block">
                                        <div class="favorit-items">
                                            <i class="far fa-heart"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shopping-card">
                                            <a href="cart.html"><i class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </li>
                                   <li class="d-none d-lg-block">
                                        @if(Auth::check())
                                            <div class="dropdown">
                                                <a href="#" class="btn header-btn dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                                    <li><a class="dropdown-item" href="#">Tài khoản của tôi</a></li>
                                                    <li><a class="dropdown-item" href="#">Đơn hàng</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>
                                                </ul>
                                                
                                            </div>
                                        @else
                                            <a href="{{ route('login') }}" class="btn header-btn">Đăng nhập</a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>