@extends('admins.layouts.default')

@section('title')
    @parent
    Chi tiết người dùng
@endsection

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-7">
            <h3 class="fw-bold">{{ $user->name }}</h3>
            <p>Email: <span class="fw-bold">{{ $user->email }}</span></p>
            <p>Chức vụ: 
                @if($user->role == 0)
                    <span class="badge bg-primary">Admin</span>
                @elseif($user->role == 1)
                    <span class="badge bg-secondary">Người dùng thông thường</span>
                @else
                    <span class="badge bg-light text-dark">Không xác định</span>
                @endif
            </p>
            <p class="text-success fw-bold">Ngày tạo: {{ $user->created_at->format('d/m/Y H:i') }}</p>
            <div class="mb-3">
                <a href="{{ route('admin.users.listUser') }}" class="btn btn-primary">Quay lại danh sách</a>
                <a href="{{ route('admin.users.updateUser', $user->id) }}" class="btn btn-warning">Chỉnh sửa người dùng</a>
            </div>
        </div>
    </div>
</div>
@endsection
