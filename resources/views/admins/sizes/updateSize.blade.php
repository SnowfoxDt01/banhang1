@extends('admins.layouts.default')

@section('title')
    @parent
    Chỉnh sửa kích cỡ
@endsection

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white shadow-sm border-radius-lg p-4">
                <form action="{{ route('admin.sizes.updatePatchSize', $size->id) }}" method="POST">
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
                        <label>Tên kích cỡ</label>
                        <input type="text" name="name" class="form-control" required value="{{ $size->name }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật kích cỡ</button>
                    <a href="{{ route('admin.sizes.listSize') }}" class="btn btn-secondary">Trở về</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
