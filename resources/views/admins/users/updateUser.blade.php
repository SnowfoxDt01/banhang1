@extends('admins.layouts.default')

@section('title')
    @parent
    Chỉnh sửa người dùng
@endsection

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white shadow-sm border-radius-lg p-4">
                <form action="{{ route('admin.users.updatePatchUser', $user->id) }}" method="POST">
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
                        <label>Tên người dùng</label>
                        <input type="text" name="name" class="form-control" required value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label>Chức vụ</label>
                        <select name="role" class="form-control" required>
                            <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Admin</option>
                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Người dùng thông thường</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật người dùng</button>
                    <a href="{{ route('admin.users.listUser') }}" class="btn btn-secondary">Trở về</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
