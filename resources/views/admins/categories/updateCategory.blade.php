@extends('admins.layouts.default')

@section('title')
    @parent
    Chỉnh sửa danh mục
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
    </style>        
@endpush

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white shadow-sm border-radius-lg p-4">
                <form action="{{ route('admin.categories.updatePatchCategory', $category->id) }}" method="POST" enctype="multipart/form-data">
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
                        <label>Tên danh mục</label>
                        <input type="text" name="name" class="form-control" required value="{{ $category->name }}">
                    </div>
                    <div class="mb-3">
                        <label>Hình ảnh danh mục</label>
                        <input type="file" name="image" class="form-control">
                        <div class="mt-2">
                            <img src="{{ asset($category->image ?? 'default-image.jpg') }}" alt="{{ $category->name }}" style="max-width: 100px;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control" required rows="3">{{ $category->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
                    <a href="{{ route('admin.categories.listCategory') }}" class="btn btn-secondary">Trở về</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelector('input[name="image"]').addEventListener('change', function(event) {
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
