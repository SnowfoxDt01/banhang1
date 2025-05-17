@extends('admins.layouts.default')

@section('title')
    @parent
    Danh sách danh mục
@endsection

@push('styles')
    <style>
    .pagination .page-item.active .page-link {
        background-color: #000000;
        color: white;
        border-color: #000000;
    }
    .pagination .page-link:hover {
        background-color: #d0ebff;
        color: #0d6efd;
    }
    .pagination .page-link {
        color: #000000;
        border: 1px solid #dee2e6;
    }
    .pagination .page-link {
        border-radius: 0.375rem;
    }
    </style>
@endpush

@section('content')
<div class="container-fluid py-2">
    @if (session('message'))
        <div class="alert alert-success alert-dismissible text-white" role="alert">
            <span class="text-sm">{{ session('message') }}</span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                        <h6 class="text-white text-capitalize">Danh sách danh mục</h6>
                        <a href="{{ route('admin.categories.addCategory') }}" class="btn btn-light">Thêm danh mục</a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 15%; text-align:left;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên danh mục</th>
                                    <th style="width: 25%; text-align:center;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hình ảnh</th>
                                    <th style="width: 40%; text-align:left;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mô tả</th>
                                    <th style="width: 20%; text-align:center;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td style="text-align:left; vertical-align:middle;">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm" style="max-width: 200px; word-break: break-word; white-space: normal;">
                                                        {{ $category->name }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align:center; vertical-align:middle;">
                                            <div class="text-center mb-2">
                                                @if($category->image)
                                                    <img src="{{ asset($category->image) }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;" alt="{{ $category->name }}">
                                                @else
                                                    <img src="{{ asset('default-image.jpg') }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;" alt="No image">
                                                @endif
                                            </div>
                                        </td>
                                        <td style="text-align:left; vertical-align:middle;">
                                            <p class="text-xs font-weight-bold mb-0">{{ $category->description }}</p>
                                        </td>
                                        <td class="align-middle text-center" style="width: 20%; text-align:center; white-space: normal;">
                                            <div class="d-inline-flex flex-wrap justify-content-center">
                                                <form action="{{ route('admin.categories.deleteCategory', $category->id) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-delete-category" data-id="{{ $category->id }}">Xóa</button>
                                                </form>
                                            </div>
                                            
                                            <a href="{{ route('admin.categories.detailCategory', $category->id) }}" class="btn btn-info">Chi tiết</a>
                                            <a href="{{ route('admin.categories.updateCategory', $category->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete-category');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const confirmDelete = confirm('Bạn có chắc chắn muốn xóa danh mục này không?');
                if (confirmDelete) {
                    button.closest('form').submit();
                }
            });
        });
    });
</script>
@endpush
