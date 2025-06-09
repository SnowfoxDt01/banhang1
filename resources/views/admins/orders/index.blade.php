@extends('admins.layouts.default')

@section('title')
    @parent
    Danh sách đơn hàng
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
                        <h6 class="text-white text-capitalize">Danh sách đơn hàng</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Mã đơn</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Khách hàng</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Số điện thoại</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Tổng tiền</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Trạng thái</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Ngày tạo</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="text-center">{{ $order->id }}</td>
                                        <td class="text-center">{{ $order->address->name ?? $order->user->name ?? 'N/A' }}</td>
                                        <td class="text-center">{{ $order->address->phone ?? 'N/A' }}</td>
                                        <td class="text-center">{{ number_format($order->total_price, 0, ',', '.') }}₫</td>
                                        <td class="text-center">
                                            <span class="badge 
                                                @switch($order->payment_status)
                                                    @case('confirming') bg-gradient-secondary @break
                                                    @case('confirmed') bg-gradient-info @break
                                                    @case('preparing') bg-gradient-primary @break
                                                    @case('shipping') bg-gradient-warning @break
                                                    @case('delivered') bg-gradient-success @break
                                                    @case('completed') bg-gradient-success @break
                                                    @case('canceled') bg-gradient-danger @break
                                                    @case('pending') bg-gradient-dark @break
                                                    @default bg-gradient-secondary
                                                @endswitch
                                            ">
                                                {{ [
                                                    'confirming' => 'Chờ xác nhận',
                                                    'confirmed' => 'Đã xác nhận',
                                                    'preparing' => 'Đang chuẩn bị',
                                                    'shipping' => 'Đang giao hàng',
                                                    'delivered' => 'Đã giao hàng',
                                                    'completed' => 'Hoàn thành',
                                                    'canceled' => 'Đã hủy',
                                                    'pending' => 'Chờ xử lý',
                                                ][$order->payment_status] ?? ucfirst($order->payment_status) }}
                                            </span>
                                        </td>
                                        <td class="text-center">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-center">
                                            <div class="d-inline-flex flex-wrap justify-content-center">
                                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm me-1">Chi tiết</a>
                                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links('pagination::bootstrap-5') }}
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
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const confirmDelete = confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');
                if (confirmDelete) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
