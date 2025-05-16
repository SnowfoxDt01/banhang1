@extends('admins.layouts.default')

@section('title')
    @parent
     Chi tiết biến thể
@endsection

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Variant Image -->
        <div class="col-md-5">
            <div class="product-images">
                <img id="mainImage" src="{{ asset($variant->images->image ?? 'default-image.jpg') }}" alt="{{ $variant->name }}" class="img-fluid border rounded">
            </div>
        </div>
        <!-- Variant Details -->
        <div class="col-md-7">
            <h3 class="fw-bold">{{ $variant->name }}</h3>
            <p class="text-muted">Sản phẩm chính: {{ $variant->product->name }}</p>
            <p class="text-success fw-bold">Giá: {{ number_format($variant->variant_price, 0, ',', '.') }} VND</p>
            <p>Số lượng: {{ $variant->quantity }}</p>
            <p>Màu sắc: <span class="badge bg-secondary">{{ $variant->color->name ?? 'Không xác định' }}</span></p>
            <p>Kích thước: <span class="badge bg-secondary">{{ $variant->size->name ?? 'Không xác định' }}</span></p>
            <div class="mb-3">
                <a href="{{ route('admin.variants.listVariant') }}" class="btn btn-primary">Quay lại danh sách</a>
                <a href="{{ route('admin.variants.updateVariant', $variant->id) }}" class="btn btn-warning">Chỉnh sửa biến thể</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Nếu sau này có nhiều ảnh cho biến thể, có thể thêm chức năng đổi ảnh ở đây
</script>
@endpush
