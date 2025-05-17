@extends('admins.layouts.default')

@section('title')
    @parent
    Thêm danh mục
@endsection

@push('styles')
    <style>
    input.form-control,
    textarea.form-control {
        border: 1px solid #ced4da !important;
        padding: 0.5rem 0.75rem !important;
    }
    .input-group-text {
        border: 1px solid #ced4da !important;
        padding: 0.5rem 0.75rem !important;
        background-color: #f8f9fa;
    }
    select.form-select {
        border: 1px solid #ced4da !important;
        padding: 0.5rem 0.75rem !important;
    }
    select.form-control {
        border: 1px solid #ced4da !important;
        padding: 0.5rem 0.75rem !important;
    }
    </style>
@endpush

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white shadow-sm border-radius-lg p-4">
                <form action="{{ route('admin.categories.addPostCategory') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label>Tên danh mục</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label>Hình ảnh danh mục</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required id="category-image-input">
                        <small class="text-muted">Chỉ chọn 1 ảnh cho mỗi danh mục.</small>
                        <div id="selected-image" class="mt-2"></div>
                    </div>
                    <div class="mb-3">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                    <a href="{{ route('admin.categories.listCategory') }}" class="btn btn-secondary">Trở về</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('category-image-input').addEventListener('change', function(event) {
        const selectedImageContainer = document.getElementById('selected-image');
        selectedImageContainer.innerHTML = '';
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = event.target.files[0].name;
                img.style.maxWidth = '120px';
                img.style.marginRight = '10px';
                img.style.marginBottom = '10px';
                selectedImageContainer.appendChild(img);
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
@endpush
