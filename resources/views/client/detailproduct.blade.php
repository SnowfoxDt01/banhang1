@extends('client.layout.default')

@section('title')
    @parent
    Chi tiết sản phẩm
@endsection

@push('style')
    <style>
        .product-detail-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            margin-top: 30px;
        }
        .product-detail-img {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
        }
        .product-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .product-price {
            font-size: 22px;
            color: #ee4d2d;
            font-weight: bold;
            margin: 15px 0;
        }
        .product-description {
            font-size: 16px;
            color: #444;
            margin-top: 20px;
        }
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .quantity-control input {
            width: 60px;
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <!-- Banner -->
    <div class="slider-area">
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('client/img/hero/category.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Chi tiết sản phẩm</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chi tiết sản phẩm -->
    <div class="container product-detail-container">
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-5">
                <img src="{{ asset('assets/img/product/single_product.png') }}" class="product-detail-img" alt="Ảnh sản phẩm">
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-7">
                <div class="product-name">Foam filling cotton slow rebound pillows</div>

                <div class="product-price">500.000₫</div>

                <div class="product-description">
                    Seamlessly empower fully researched growth strategies and interoperable internal or “organic” sources.
                </div>

                <hr>

                <div class="mb-3">
                    <label>Số lượng</label>
                    <div class="quantity-control">
                        <button class="btn btn-light border px-3">-</button>
                        <input type="number" class="input" value="1" min="1" max="10">
                        <button class="btn btn-light border px-3">+</button>
                    </div>
                </div>

                <a href="#" class="btn btn-danger btn-lg mt-3">Thêm vào giỏ hàng</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
