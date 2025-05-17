@extends('admins.layouts.default')

@section('title')
    @parent
    Chi tiết màu
@endsection

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-7">
            <h3 class="fw-bold">{{ $color->name }}</h3>
            <p class="text-success fw-bold">Ngày tạo: {{ $color->created_at->format('d/m/Y H:i') }}</p>
            <div class="mb-3">
                <a href="{{ route('admin.colors.listColor') }}" class="btn btn-primary">Quay lại danh sách</a>
                <a href="{{ route('admin.colors.updateColor', $color->id) }}" class="btn btn-warning">Chỉnh sửa màu</a>
            </div>
        </div>
    </div>
</div>
@endsection
