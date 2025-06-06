@extends('client.layout.default')

@section('title')
    @parent
    Chi tiết sản phẩm
@endsection

@push('style')

    
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
                {{-- Ảnh lớn (ảnh đầu tiên) --}}
                @if($product->images->count() > 0)
                    <img id="mainImage" src="{{ asset($product->images->first()->image) }}" class="product-detail-img" alt="{{ $product->images->first()->alt ?? 'Ảnh sản phẩm' }}" style="width: 100% !important;
                        max-width: 350px !important;
                        height: 350px !important;
                        object-fit: cover !important;
                        border-radius: 8px !important;
                        display: block !important;
                        margin-left: auto !important;
                        margin-right: auto !important;">
                    {{-- Ảnh nhỏ bên dưới --}}
                    <div class="d-flex gap-2 justify-content-center mt-2" style="max-width: 350px; margin: 0 auto;">
                        @foreach($product->images as $img)
                            <img src="{{ asset($img->image) }}" alt="{{ $img->alt ?? 'Ảnh sản phẩm' }}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 6px; border: 1px solid #eee; cursor: pointer;" onclick="changeMainImage(this)">
                        @endforeach
                    </div>
                @else
                    <img src="{{ asset('client/img/default.png') }}" class="product-detail-img mb-3" alt="No image">
                @endif
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-7">
                <div class="product-name"><h2>{{ $product->name }}</h2></div>

                <div class="product-ratting">
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star low-star"></i>
                    <i class="far fa-star low-star"></i>
                </div>

                <div class="d-flex align-items-end gap-3 mb-2">
                    <div style="color: #ee4d2d; text-decoration: line-through; font-size: 20px; font-weight: 500;">
                        {{ number_format($product->base_price, 0, ',', '.') }}₫
                    </div>
                    <div style="font-size: 28px; font-weight: bold; color: #222;">
                        {{ number_format($product->sale_price, 0, ',', '.') }}₫
                    </div>
                    
                </div>

                <!-- Biến thể sản phẩm: Màu sắc và Kích thước -->
 
                <form action="{{ route('client.cart.add') }}" method="POST" id="addToCartForm" style="margin-top: 16px;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="variant_id" id="variant_id" value="{{ $product->variantProducts->first()->id ?? '' }}">
                    <div class="mb-3">
                        <div class="d-flex flex-wrap py-3 align-items-center">
                            <h5 class="pe-3 mb-0">Màu sắc:</h5>
                            <div class="variant-colors d-flex gap-2 flex-wrap">
                                @foreach ($product->variantProducts->unique('color_id') as $variant)
                                    <div class="color-option" data-color-id="{{ $variant->color_id }}"
                                        style="padding: 5px 10px; border: 1.5px solid #e0e0e0; cursor: pointer; display: flex; 
                                        align-items: center; position: relative; border-radius: 2px; min-width: 70px; background: #fff;" tabindex="0">
                                        @if ($variant->images)
                                            <img src="{{ asset($variant->images->image) }}"
                                                alt="{{ $variant->images->alt}}"
                                                style="width: 32px; height: 32px; object-fit: cover; margin-right: 7px; border-radius: 3px; border: 1px solid #eee;">
                                        @endif
                                        <span>{{ $variant->color->name }}</span>
                                        <span class="selected-mark"
                                            style="display: none; position: absolute; top: 5px; right: 5px; background-color: #ee4d2d; color: white; padding: 2px 5px; border-radius: 50%; font-size: 13px;">✓</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex flex-wrap py-3 bor-bottom">
                            <h4 class="pe-3">Kích thước:</h4>
                            <div class="variant-sizes d-flex gap-2">
                                @foreach ($product->variantProducts->unique('size_id') as $variant)
                                    <div class="size-option"
                                        data-size-id="{{ $variant->size_id }}"
                                        style="padding: 5px 10px; border: 1px solid #ccc; cursor: pointer; position: relative;"
                                        tabindex="0">
                                        {{ $variant->size->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div style="font-size: 15px; color: #888; margin-left: 18px;">
                            Tổng số lượng các biến thể: <b>{{ $product->variantProducts->sum('quantity') }}</b>
                        </div>
                    </div>
                    <hr>
                    
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <button type="button" class="btn border quantity-btn" id="btnMinus">-</button>
                        <input type="number" name="quantity" id="quantityInput" value="1" min="1" max="10"
                            style="width: 60px; text-align: center; border: 1px solid #ccc; border-radius: 4px; padding: 4px 8px;">
                        <button type="button" class="btn border quantity-btn" id="btnPlus">+</button>
                        <button type="submit" class="btn btn-danger btn-lg">Thêm vào giỏ hàng</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- thông số sản phẩm --}}
        <div style="background: #f8f8f8; border-radius: 8px; padding: 24px 24px 12px 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; margin-bottom: 32px; margin-top: 30px;">
            <h5 class="mb-3" style="font-size: 20px; color: #ee4d2d; font-weight: 700; margin-bottom: 18px;">Thông số sản phẩm</h5>
            <ul class="list-unstyled ms-2">
                <li style="font-size: 16px; padding: 7px 0; border-bottom: 1px dashed #e0e0e0; color: #333;"><strong style="min-width: 120px; display: inline-block; color: #555;">Danh mục:</strong> {{ $product->productCategory->name ?? 'Không xác định' }}</li>
                <li style="font-size: 16px; padding: 7px 0; border-bottom: 1px dashed #e0e0e0; color: #333;"><strong style="min-width: 120px; display: inline-block; color: #555;">Giá gốc:</strong> {{ number_format($product->base_price, 0, ',', '.') }}₫</li>
                <li style="font-size: 16px; padding: 7px 0; border-bottom: 1px dashed #e0e0e0; color: #333;"><strong style="min-width: 120px; display: inline-block; color: #555;">Giá khuyến mãi:</strong> {{ number_format($product->sale_price, 0, ',', '.') }}₫</li>
                <li style="font-size: 16px; padding: 7px 0; border-bottom: none; color: #333;"><strong style="min-width: 120px; display: inline-block; color: #555;">Trạng thái:</strong> 
                    @if ($product->is_new == 0)
                        Hàng mới
                    @elseif ($product->is_new == 1)
                        Hàng trong kho
                    @else
                        Không xác định
                    @endif
                </li>
                <li style="font-size: 16px; padding: 7px 0; border-bottom: none; color: #333;"><strong style="min-width: 120px; display: inline-block; color: #555;">Lượt xem:</strong> {{ $product->view }}</li>
            </ul>
        </div>
        {{-- Mô tả sản phẩm --}}
        <div class="product-description mt-4" style="background: #fff7f2; border-radius: 8px; padding: 24px; border: 1px solid #ffe1d2; box-shadow: 0 2px 8px rgba(238,77,45,0.04);">
            <h5 class="mb-3" style="font-size: 20px; color: #ee4d2d; font-weight: 700; margin-bottom: 18px;">Mô tả sản phẩm</h5>
            <div style="white-space: pre-line; font-size: 16px; color: #444; line-height: 1.7;">{{ $product->description }}</div>
        </div>
    </div>

    <div>
        
    </div>

@endsection

@push('scripts')
<script>
    function changeMainImage(thumbnail) {
        const mainImage = document.getElementById('mainImage');
        // Đổi src và alt cho ảnh chính
        mainImage.src = thumbnail.src;
        mainImage.alt = thumbnail.alt;
    }

    // Hiệu ứng chọn màu và chọn size
    document.addEventListener('DOMContentLoaded', function() {
        // Hiệu ứng chọn màu
        document.querySelectorAll('.color-option').forEach(function(el) {
            el.addEventListener('click', function() {
                document.querySelectorAll('.color-option').forEach(function(opt) {
                    opt.style.borderColor = '#e0e0e0';
                    opt.querySelector('.selected-mark').style.display = 'none';
                });
                el.style.borderColor = '#ee4d2d';
                el.querySelector('.selected-mark').style.display = 'block';
            });
        });
        // Hiệu ứng chọn size
        document.querySelectorAll('.size-option').forEach(function(el) {
            el.addEventListener('click', function() {
                document.querySelectorAll('.size-option').forEach(function(opt) {
                    opt.style.borderColor = '#ccc';
                    opt.style.background = '#fff';
                    opt.style.color = '#222';
                });
                el.style.borderColor = '#ee4d2d';
                el.style.background = '#fff7f2';
                el.style.color = '#ee4d2d';
            });
        });

        const input = document.getElementById('quantityInput');
        const btnMinus = document.getElementById('btnMinus');
        const btnPlus = document.getElementById('btnPlus');
        btnMinus.addEventListener('click', function() {
            let min = parseInt(input.min) || 1;
            let val = parseInt(input.value) || 1;
            if(val > min) input.value = val - 1;
        });
        btnPlus.addEventListener('click', function() {
            let max = parseInt(input.max) || 10;
            let val = parseInt(input.value) || 1;
            if(val < max) input.value = val + 1;
        });
    });

    // Cập nhật variant_id khi chọn màu hoặc size
    const variantMap = @json($product->variantProducts->mapWithKeys(function($v) {
        return [$v->color_id.'_'.$v->size_id => $v->id];
    }));

    function updateVariantId() {
        const color = document.querySelector('.color-option[style*="border-color: #ee4d2d"]');
        const size = document.querySelector('.size-option[style*="border-color: #ee4d2d"]');
        if (color && size) {
            const key = color.dataset.colorId + '_' + size.dataset.sizeId;
            if (variantMap[key]) {
                document.getElementById('variant_id').value = variantMap[key];
            }
        }
    }
    document.querySelectorAll('.color-option').forEach(el => {
        el.addEventListener('click', updateVariantId);
    });
    document.querySelectorAll('.size-option').forEach(el => {
        el.addEventListener('click', updateVariantId);
    });
</script>
@endpush
