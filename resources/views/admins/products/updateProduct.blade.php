@extends('admins.layouts.default')

@section('title')
    @parent
     Chỉnh sửa sản phẩm
@endsection

@push('styles')
    <style> 
    input.form-control,
    textarea.form-control {
        border: 1px solid #ced4da !important;
        padding: 0.5rem 0.75rem !important; /* lùi nội dung vào trong */
    }

    .input-group-text {
        border: 1px solid #ced4da !important;
        padding: 0.5rem 0.75rem !important; /* lùi chữ ₫ vào trong */
        background-color: #f8f9fa; /* tùy chọn: nền nhẹ giống Bootstrap */
    }
    select.form-select {
    border: 1px solid #ced4da !important;
    padding: 0.5rem 0.75rem !important;
}

    select.form-control {
        border: 1px solid #ced4da !important;
        padding: 0.5rem 0.75rem !important; /* Ensure consistent padding */
    }

    </style>        
@endpush


@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Card wrapper -->
            <div class="card bg-white shadow-sm border-radius-lg p-4" style="min-height: 800px;">
                <!-- Card header -->
                <div class="card-header pb-0 mb-3">
                    <h4 class="font-weight-bolder">Thêm sản phẩm mới</h4>
                    <p class="mb-0 text-sm">Sản phẩm chính</p>
                </div>
                <!-- Form body -->
                <form action="{{ route('admin.products.updatePatchProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
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

                    <!-- Sản phẩm chính -->
                    <div class="mb-3">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="nameSP" class="form-control" required value="{{ $product->name }}">
                    </div>
                    <div class="mb-3">
                        <label>Giá gốc</label>
                        <input type="number" name="base_price" class="form-control" required value="{{ $product->base_price }}">
                    </div>
                    <div class="mb-3">
                        <label>Giá khuyến mãi</label>
                        <input type="number" name="sale_price" class="form-control" required value="{{ $product->sale_price }}">
                    </div>
                    <div class="mb-3">
                        <label>Mô tả</label>
                        <textarea name="descriptionSP" class="form-control" required >{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Danh mục</label>
                        <select name="product_category_id" class="form-control" required>
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->product_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Hình ảnh sản phẩm</label>
                        <input type="file" name="product_images[]" class="form-control" multiple id="product-images-input">
                        <small class="text-muted">Bạn có thể chọn nhiều ảnh cùng lúc.</small>
                        <div id="selected-images" class="mt-2">
                            @foreach($product->images as $image)
                                <img src="{{ asset($image->image) }}" alt="{{ $image->alt }}" style="max-width: 100px; margin-right: 10px; margin-bottom: 10px;">
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="is_new">Loại sản phẩm</label>
                        <select name="is_new" class="form-control" id="is_new">
                            <option value="0" {{ $product->is_new == 0 ? 'selected' : '' }}>Hàng mới</option>
                            <option value="1" {{ $product->is_new == 1 ? 'selected' : '' }}>Hàng trong kho</option>
                            
                        </select>
                    </div>

                    <hr>
                    <h5>Biến thể sản phẩm</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="meta-box">
                                <div id="variant-container">
                                    @foreach($product->variantProducts as $variant)
                                        <div class="variant">
                                            <div class="meta-box-header">
                                                <h3>Biến thể: {{ $variant->name }}</h3>
                                            </div>
                                            <div class="row g-3">
                                                <input type="hidden" name="variant_id[]" value="{{ $variant->id }}">
                                                <div class="form-group col-md-4">
                                                    <label for="variant_name">Tên biến thể</label>
                                                    <input type="text" class="form-control" name="variant_name[]" value="{{ $variant->name }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="variant_quantity">Số lượng</label>
                                                    <input type="number" class="form-control" name="variant_quantity[]" value="{{ $variant->quantity }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="variant_price">Giá của biến thể</label>
                                                    <input type="number" class="form-control" name="variant_price[]" value="{{ $variant->variant_price }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="variant_size">Kích cỡ</label>
                                                    <select name="variant_size[]" class="form-control">
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size->id }}" {{ $size->id == $variant->size_id ? 'selected' : '' }}>{{ $size->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="variant_color">Màu</label>
                                                    <select name="variant_color[]" class="form-control">
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color->id }}" {{ $color->id == $variant->color_id ? 'selected' : '' }}>{{ $color->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="variant_image">Hình ảnh biến thể</label>
                                                    <input type="file" class="form-control" name="variant_image[]">
                                                    <div class="mt-2">
                                                        <img src="{{ asset($variant->images->image ?? 'default-image.jpg') }}" alt="{{ $variant->images->alt }}" style="max-width: 100px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="meta-box">
                                <div class="form-group">
                                    <label for="number-of-variants">Số lượng biến thể muốn thêm:</label>
                                    <input type="number" id="number-of-variants" min="1" value="1" class="form-control">
                                    <button type="button" id="add-variants" class="btn btn-success mt-2">Thêm biến thể</button>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary">Chỉnh sửa sản phẩm</button>
                                <a href="{{ route('admin.products.listProduct') }}" class="btn btn-secondary">Trở về</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

        

@endsection


@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#variant-container').on('click', '.meta-box-header', function() {
            $(this).next('.row.g-3').toggle();
        });

        $('#variant-container').on('click', '.delete-variant', function() {
            $(this).closest('.variant').remove();
        });

        $('#add-variants').click(function() {
            const numberOfVariants = $('#number-of-variants').val();
            const variantContainer = $('#variant-container');
            for (let i = 0; i < numberOfVariants; i++) {
                const newVariantHtml = `
                <div class="variant">
                    <div class="meta-box-header">
                        <h3>Biến thể mới ${i + 1} <i class="fas fa-angle-down"></i></h3>
                    </div>
                    <div class="row g-3">
                        <input type="hidden" name="variant_id[]" value="">
                        <div class="form-group col-md-4">
                            <label for="variant_name">Tên biến thể</label>
                            <input type="text" class="form-control" name="variant_name[]">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="variant_quantity">Số lượng</label>
                            <input type="number" class="form-control" name="variant_quantity[]">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="variant_price">Giá của biến thể</label>
                            <input type="number" class="form-control" name="variant_price[]" placeholder="Giá của biến thể">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="variant_size">Kích cỡ</label>
                            <select name="variant_size[]" class="form-control">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="variant_color">Màu</label>
                            <select name="variant_color[]" class="form-control">
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="variant_image">Hình ảnh biến thể</label>
                            <input type="file" class="form-control" id="variant_image" name="variant_image[]" onchange="previewVariantImage(this)">
                            <div id="variant-image-preview" class="mt-2">
                                <!-- Preview selected variant image will appear here -->
                            </div>
                        </div>
                        <hr>
                    </div>
                    <button type="button" class="btn btn-danger delete-variant">Xóa biến thể</button>
                </div>
                <hr>
                `;
                variantContainer.append(newVariantHtml);
            }
        });

        $('.variant .row.g-3').hide();
    });

    document.getElementById('product-images-input').addEventListener('change', function(event) {
        const selectedImagesContainer = document.getElementById('selected-images');
        selectedImagesContainer.innerHTML = ''; // Clear previous previews

        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = file.name;
                img.style.maxWidth = '100px';
                img.style.marginRight = '10px';
                img.style.marginBottom = '10px';
                selectedImagesContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });

    function previewVariantImage(input) {
        const previewContainer = input.nextElementSibling; // Get the preview container
        previewContainer.innerHTML = ''; // Clear previous preview

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = input.files[0].name;
                img.style.maxWidth = '100px';
                img.style.marginTop = '10px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.querySelectorAll('input[name="variant_image[]"]').forEach(input => {
        input.addEventListener('change', function() {
            previewVariantImage(this);
        });
    });
</script>
@endpush
