@extends('admins.layouts.default')

@section('title')
    @parent
    Chỉnh sửa biến thể
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
                <form action="{{ route('admin.variants.updatePatchVariant', $variant->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
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
                        <label>Tên biến thể</label>
                        <input type="text" name="variant_name" class="form-control" required value="{{ $variant->name }}">
                    </div>
                    <div class="mb-3">
                        <label>Hình ảnh biến thể</label>
                        <input type="file" name="variant_image" class="form-control">
                        <div class="mt-2">
                            <img src="{{ asset($variant->images->image ?? 'default-image.jpg') }}" alt="{{ $variant->images->alt }}" style="max-width: 100px;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Giá của biến thể</label>
                        <input type="number" name="variant_price" class="form-control" required value="{{ $variant->variant_price }}">
                    </div>
                    <div class="mb-3">
                        <label>Số lượng</label>
                        <input type="number" name="variant_quantity" class="form-control" required value="{{ $variant->quantity }}">
                    </div>
                    <div class="mb-3">
                        <label>Kích cỡ</label>
                        <select name="variant_size" class="form-control">
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}" {{ $size->id == $variant->size_id ? 'selected' : '' }}>{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Màu</label>
                        <select name="variant_color" class="form-control">
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}" {{ $color->id == $variant->color_id ? 'selected' : '' }}>{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Cập nhật biến thể</button>
                    <a href="{{ route('admin.variants.listVariant') }}" class="btn btn-secondary">Trở về</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>
    document.querySelector('input[name="variant_image"]').addEventListener('change', function(event) {
        const previewContainer = this.nextElementSibling;
        previewContainer.innerHTML = '';
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = event.target.files[0].name;
                img.style.maxWidth = '100px';
                img.style.marginTop = '10px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endpush
