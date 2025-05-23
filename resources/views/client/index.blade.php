@extends('client.layout.default')

@section('title')
    @parent
    Trang chủ
@endsection

@push('style')
    <style>
        .img-client,
        .single-product .product-img img.img-client {
            width: 360px !important;
            height: 360px !important;
            max-width: 100% !important;
            max-height: 100% !important;
            min-width: 0 !important;
            min-height: 0 !important;
            object-fit: cover !important;
            object-position: center !important;
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            background: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
    </style>
@endpush

@section('content')
        <!-- slider Area Start -->
        @include('client.layout.slider')
        <!-- slider Area End-->
        <!-- Category Area Start-->
        @include('client.layout.category')

        <!-- Sản phẩm nổi bật Start -->
        <section class="latest-product-area padding-bottom">
            <div class="container">
                <div class="row product-btn d-flex justify-content-end align-items-end">
                    <!-- Section Tittle -->
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="section-tittle mb-30">
                            <h2>Sản phẩm nổi bật</h2>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <div class="properties__button f-right">
                            <!--Nav Button  -->
                            <nav>                                                                                                
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Tất cả sản phẩm</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Sản phẩm mới</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Nổi bật</a>
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            @foreach ($listProductClient as $list)
                                <div class="col-xl-4 col-lg-4 col-md-6">
                                    <div class="single-product mb-60">
                                        <div class="product-img">
                                            {{-- Hiển thị ảnh đầu tiên --}}
                                            @if($list->images->count() > 0)
                                                <a href="{{ route('client.detail', $list->id) }}">
                                                    <img class="img-client" src="{{ $list->images->first()->image }}" alt="{{ $list->images->first()->alt }}">
                                                </a>
                                            @else
                                                <img src="/path/to/default-image.jpg" alt="No image">
                                            @endif

                                            {{-- Hiển thị chữ New nếu is_new == 0 --}}
                                            @if ($list->is_new == 0)
                                                <div class="new-product">
                                                    <span>New</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-ratting">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star low-star"></i>
                                                <i class="far fa-star low-star"></i>
                                            </div>
                                            <h4><a href="{{ route('client.detail', $list->id) }}">{{ $list->name }}</a></h4>
                                            <div class="price">
                                                <ul>
                                                    <li>{{ number_format($list->sale_price, 0, ',', '.') }}₫</li>
                                                    <li class="discount">{{ number_format($list->base_price, 0, ',', '.') }}₫</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Card two -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                            @foreach($listProductClient->where('is_new', 0) as $product)
                                <div class="col-xl-4 col-lg-4 col-md-6">
                                    <div class="single-product mb-60">
                                        <div class="product-img">
                                            <img src="{{ asset($product->images->first()->image ?? 'client/img/default.png') }}" alt="{{ $product->images->first()->alt ?? 'Product image' }}">
                                            {{-- Nếu muốn hiện "New" cho is_new = 1 thì không cần ở đây --}}
                                            <div class="new-product">
                                                <span>New</span>
                                            </div>
                                        </div>
                                        
                                        <div class="product-caption">
                                            <div class="product-ratting">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="far fa-star{{ $i < 3 ? '' : ' low-star' }}"></i>
                                                @endfor
                                            </div>
                                            <h4><a href="#">{{ $product->name }}</a></h4>
                                            <div class="price">
                                                <ul>
                                                    <li>${{ $product->price }}</li>
                                                    <li class="discount">${{ $product->original_price ?? $product->price + 20 }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Card three -->
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row">
                            @foreach($topViewedProducts as $product)
                                <div class="col-xl-4 col-lg-4 col-md-6">
                                    <div class="single-product mb-60">
                                        <div class="product-img">
                                            <img src="{{ asset($product->images->first()->image ?? 'client/img/default.png') }}" alt="{{ $product->images->first()->alt ?? 'Product image' }}">
                                            @if($product->is_new==0)
                                                <div class="new-product">
                                                    <span>New</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-ratting">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="far fa-star{{ $i < 3 ? '' : ' low-star' }}"></i>
                                                @endfor
                                            </div>
                                            <h4><a href="#">{{ $product->name }}</a></h4>
                                            <div class="price">
                                                <ul>
                                                    <li>${{ $product->price }}</li>
                                                    <li class="discount">${{ $product->original_price ?? $product->price + 20 }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <!-- End Nav Card -->
            </div>
        </section>
        <!-- Sản phẩm nổi bật End -->
        
        <!-- Hãy chọn sản phẩm Start -->
        <div class="best-product-area lf-padding" >
           <div class="product-wrapper bg-height" style="background-image: url('client/img/categori/card.png')">
                <div class="container position-relative">
                    <div class="row justify-content-between align-items-end">
                        <div class="product-man position-absolute  d-none d-lg-block">
                            <img src="{{ asset('client/img/categori/card-man.png') }}" alt=""> {{-- Chú ý: ở đây là cần đổi sang ảnh sp mẫu của mình --}}
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 d-none d-lg-block">
                            <div class="vertical-text">
                                <span>Manz</span>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="best-product-caption">
                                <h2>Hãy chọn sản phẩm bạn hài lòng nhất<br> từ shop chúng tôi</h2>
                                <p>Sản phẩm chất lượng, dịch vụ tận tâm</p>
                                <a href="#" class="black-btn">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           <!-- Shape -->
           <div class="shape bounce-animate d-none d-md-block">
               <img src="{{ asset('client/img/categori/card-shape.png') }}" alt="">
               {{-- ảnh ở góc dưới phải, thay bằng sản phẩm của mình --}}
           </div>
        </div>
        <!-- Hãy chọn sản phẩm End-->
        <!-- Sản phẩm thịnh hành Start -->
        <div class="best-collection-area section-padding2">
            <div class="container">
                <div class="row d-flex justify-content-between align-items-end">
                    <!-- Left content -->
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="best-left-cap">
                            <h2>Sản phẩm thịnh hành hàng tháng</h2>
                            <p>Phong cách thời trang độc đáo, và năng động</p>
                            <a href="#" class="btn shop1-btn">Mua ngay</a>
                        </div>
                        <div class="best-left-img mb-30 d-none d-sm-block">
                            <img src="{{ asset('client/img/collection/collection1.png') }}" alt="">
                        </div>
                    </div>
                    <!-- Mid Img -->
                     <div class="col-xl-2 col-lg-2 d-none d-lg-block">
                        <div class="best-mid-img mb-30 ">
                            <img src="{{ asset('client/img/collection/collection2.png') }}" alt="">
                        </div>
                    </div>
                    <!-- Riht Caption -->
                    {{-- đoạn này thêm 1 vài sản phẩm đẹp mắt là được --}}
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="best-right-cap ">
                           <div class="best-single mb-30">
                               <div class="single-cap">
                                   <h4>Menz Winter<br> Jacket</h4>
                               </div>
                               <div class="single-img">
                                  <img src="{{ asset('client/img/collection/collection3.png') }}" alt="">
                               </div>
                           </div>
                        </div>
                        <div class="best-right-cap">
                           <div class="best-single mb-30">
                               <div class="single-cap active">
                                   <h4>Menz Winter<br>Jacket</h4>
                               </div>
                               <div class="single-img">
                                  <img src="{{ asset('client/img/collection/collection4.png') }}" alt="">
                               </div>
                           </div>
                        </div>
                        <div class="best-right-cap">
                           <div class="best-single mb-30">
                               <div class="single-cap">
                                   <h4>Menz Winter<br> Jacket</h4>
                               </div>
                               <div class="single-img">
                                  <img src="{{ asset('client/img/collection/collection5.png') }}" alt="">
                               </div>
                           </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <!-- Sản phẩm thịnh hành End -->
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

@push('scripts')


@endpush