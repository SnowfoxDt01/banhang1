@extends('admins.layouts.default')

@section('title')
    @parent
    Chi tiết kích cỡ
@endsection

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-7">
            <h3 class="fw-bold">{{ $size->name }}</h3>
            <p class="text-success fw-bold">Ngày tạo: {{ $size->created_at->format('d/m/Y H:i') }}</p>
            <div class="mb-3">
                <a href="{{ route('admin.sizes.listSize') }}" class="btn btn-primary">Quay lại danh sách</a>
                <a href="{{ route('admin.sizes.updateSize', $size->id) }}" class="btn btn-warning">Chỉnh sửa kích cỡ</a>
            </div>
        </div>
    </div>
</div>
@endsection
