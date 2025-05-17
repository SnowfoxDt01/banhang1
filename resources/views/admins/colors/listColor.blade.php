@extends('admins.layouts.default')

@section('title')
    @parent
    Danh sách màu
@endsection

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
                        <h6 class="text-white text-capitalize">Danh sách màu</h6>
                        <a href="{{ route('admin.colors.addColor') }}" class="btn btn-light">Thêm màu</a>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 60%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên màu</th>
                                    <th style="width: 20%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày tạo</th>
                                    <th style="width: 20%" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($colors as $color)
                                    <tr>
                                        <td style="vertical-align:middle;">{{ $color->name }}</td>
                                        <td style="vertical-align:middle;">{{ $color->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="align-middle text-center" style="width: 20%; white-space: normal;">
                                            <div class="d-inline-flex flex-wrap justify-content-center">
                                                <form action="{{ route('admin.colors.deleteColor', $color->id) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-delete-color" data-id="{{ $color->id }}">Xóa</button>
                                                </form>
                                                <a href="{{ route('admin.colors.detailColor', $color->id) }}" class="btn btn-info mx-1">Chi tiết</a>
                                                <a href="{{ route('admin.colors.updateColor', $color->id) }}" class="btn btn-warning">Sửa</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $colors->links('pagination::bootstrap-5') }}
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
        const deleteButtons = document.querySelectorAll('.btn-delete-color');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const confirmDelete = confirm('Bạn có chắc chắn muốn xóa màu này không?');
                if (confirmDelete) {
                    button.closest('form').submit();
                }
            });
        });
    });
</script>
@endpush
