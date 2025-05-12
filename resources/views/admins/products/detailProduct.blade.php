@extends('admins.layouts.default')

@section('title')
    @parent
     Chi tiết sản phẩm
@endsection

@push('styles')


@endpush

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-5">
            <div class="product-images">
                <img id="mainImage" src="{{ asset($product->images->first()->image ?? 'default-image.jpg') }}" alt="{{ $product->name }}" class="img-fluid border rounded">
                <div class="mt-3 d-flex">
                    @foreach($product->images as $image)
                        <img src="{{ asset($image->image) }}" alt="{{ $product->name }}" class="img-thumbnail me-2" style="width: 60px; height: 60px; cursor: pointer;" onclick="changeMainImage(this)">
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-7">
            <h3 class="fw-bold">{{ $product->name }}</h3>
            <p class="text-muted">Danh mục: {{ $product->productCategory->name }}</p>
            <p class="text-success fw-bold">Giá: {{ number_format($product->sale_price, 0, ',', '.') }} VND</p>
            <p class="text-decoration-line-through text-muted">Giá gốc: {{ number_format($product->base_price, 0, ',', '.') }} VND</p>
            <p>{{ $product->description }}</p>

            <!-- Variants -->
            <div class="variants mt-4">
                <h6>Chọn màu sắc:</h6>
                <div class="d-flex">
                    @foreach($product->variantProducts->unique('color.name') as $variant)
                        <span class="badge bg-secondary me-2">{{ $variant->color->name }}</span>
                    @endforeach
                </div>

                <h6 class="mt-3">Chọn kích thước:</h6>
                <div class="d-flex">
                    @foreach($product->variantProducts->unique('size.name') as $variant)
                        <span class="badge bg-secondary me-2">{{ $variant->size->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function changeMainImage(thumbnail) {
        const mainImage = document.getElementById('mainImage');
        mainImage.src = thumbnail.src;
    }
</script>
@endpush