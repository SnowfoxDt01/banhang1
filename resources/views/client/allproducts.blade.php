@extends('client.layout.default')

@section('title')
    @parent
    Tất cả sản phẩm
@endsection

@push('style')
<style>
    .img-client {
        width: 360px;
        height: 360px;
        object-fit: cover;
        object-position: center;
        display: block;
        margin-left: auto;
        margin-right: auto;
        background: #f5f5f5;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .category-filter {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        padding: 24px 16px;
        margin-bottom: 32px;
    }
    .category-filter label {
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
    }
    .category-filter ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .category-filter li {
        margin-bottom: 8px;
    }
    .category-filter a {
        color: #222 !important;
        background: none;
        border-radius: 4px;
        padding: 2px 8px;
        display: inline-block;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .category-filter a.active {
        color: #fff !important;
        background: #007bff;
        border-radius: 4px;
        padding: 2px 8px;
    }
</style>
@endpush

@section('content')
    <!-- slider Area Start-->
        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('client/img/hero/category.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Danh mục sản phẩm</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- slider Area End-->

        <!-- Latest Products Start -->
        <section class="latest-product-area latest-padding">
            <div class="container">
                <div class="row product-btn d-flex justify-content-between">
                        
                        <div class="select-this d-flex">
                            <div class="featured">
                                <span>Lọc theo danh mục: </span>
                            </div>
                            <form action="{{ route('client.allproducts') }}" method="get">
                                <div class="select-itms">
                                    <select name="category" id="select1" onchange="this.form.submit()">
                                        <option value="">Tất cả</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                </div>
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            @forelse($products as $product)
                                <div class="col-xl-4 col-lg-4 col-md-6">
                                    <div class="single-product mb-60">
                                        <div class="product-img">
                                            <a href="{{ route('client.detail', $product->id) }}">
                                                <img class="img-client"
                                                    src="{{ optional($product->images->first())->image ? asset($product->images->first()->image) : asset('client/img/default.png') }}"
                                                    alt="{{ optional($product->images->first())->alt ?? 'No image' }}">
                                            </a>
                                            <div class="new-product">
                                                <span>New</span>
                                            </div>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-ratting">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star low-star"></i>
                                                <i class="far fa-star low-star"></i>
                                            </div>
                                            <h4><a href="{{ route('client.detail', $product->id) }}">{{ $product->name }}</a></h4>
                                            <div class="price">
                                                <ul>
                                                    <li>{{ number_format($product->sale_price, 0, ',', '.') }}₫</li>
                                                    <li class="discount">{{ number_format($product->base_price, 0, ',', '.') }}₫</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p>Không có sản phẩm nào.</p>
                                </div>
                            @endforelse
                        </div>

                        {{-- Phân trang --}}
                        @if($products->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $products->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- End Nav Card -->
            </div>
        </section>
        <!-- Latest Products End -->

        <!-- Latest Offers Start -->
        <div class="latest-wrapper lf-padding">
            <div class="latest-area latest-height d-flex align-items-center" data-background="{{ asset('client/img/collection/latest-offer.png') }}">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-5 col-lg-5 col-md-6 offset-xl-1 offset-lg-1">
                            <div class="latest-caption">
                                <h2>Nhận tin tức<br>giảm giá mới nhất</h2>
                                <p>Subscribe news latter</p>
                            </div>
                        </div>
                            <div class="col-xl-5 col-lg-5 col-md-6 ">
                            <div class="latest-subscribe">
                                <form action="#">
                                    <input type="email" placeholder="Nhập email của bạn tại đây">
                                    <button>Gửi ngay</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- man Shape -->
                <div class="man-shape">
                    <img src="{{ asset('client/img/collection/latest-man.png') }}" alt="">
                </div>
            </div>
        </div>
        <!-- Latest Offers End -->
        <!-- Shop Method Start-->
        <div class="shop-method-area section-padding30">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-package"></i>
                            <h6>Giao hàng miễn phí</h6>
                            <p>Giao hàng 0đ, mua sắm thả ga.</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-unlock"></i>
                            <h6>Hệ thống thanh toán an toàn</h6>
                            <p>Bảo mật thông tin người dùng toàn vẹn.</p>
                        </div>
                    </div> 
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-reload"></i>
                            <h6>Hoàn trả 100% nếu đổi trả</h6>
                            <p>Nếu bạn không hài lòng với sản phẩm, đừng lo chúng tôi có hỗ trợ hoàn trả lại tiền.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Method End-->
        <!-- Gallery Start-->
        <div class="gallery-wrapper lf-padding">
            <div class="gallery-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="gallery-items">
                            <img src="{{ asset('client/img/gallery/gallery1.jpg') }}" alt="">
                        </div> 
                        <div class="gallery-items">
                            <img src="{{ asset('client/img/gallery/gallery2.jpg') }}" alt="">
                        </div>
                        <div class="gallery-items">
                            <img src="{{ asset('client/img/gallery/gallery3.jpg') }}" alt="">
                        </div>
                        <div class="gallery-items">
                            <img src="{{ asset('client/img/gallery/gallery4.jpg') }}" alt="">
                        </div>
                        <div class="gallery-items">
                            <img src="{{ asset('client/img/gallery/gallery5.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery End-->
@endsection