@extends('admins.layouts.default')

@section('title')
    @parent
    Chi tiết danh mục
@endsection

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Category Image -->
        <div class="col-md-5">
            <div class="product-images">
                <img id="mainImage" src="{{ asset($category->image ?? 'default-image.jpg') }}" alt="{{ $category->name }}" class="img-fluid border rounded">
            </div>
        </div>
        <!-- Category Details -->
        <div class="col-md-7">
            <h3 class="fw-bold">{{ $category->name }}</h3>
            <p class="text-success fw-bold">Ngày tạo: {{ $category->created_at->format('d/m/Y H:i') }}</p>
            <p class="text-muted">Mô tả:</p>
            <p>{{ $category->description }}</p>
            <div class="mb-3">
                <a href="{{ route('admin.categories.listCategory') }}" class="btn btn-primary">Quay lại danh sách</a>
                <a href="{{ route('admin.categories.updateCategory', $category->id) }}" class="btn btn-warning">Chỉnh sửa danh mục</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Nếu sau này có nhiều ảnh cho danh mục, có thể thêm chức năng đổi ảnh ở đây
</script>
@endpush
