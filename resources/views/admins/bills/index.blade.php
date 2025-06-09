@extends('admins.layouts.default')

@section('title')
    @parent
    Danh sách hóa đơn
@endsection

@push('styles')
    <style>
    /* Thay đổi màu nền nút đang active */
    .pagination .page-item.active .page-link {
        background-color: #000000; 
        color: white;
        border-color: #000000;
    }

    /* Hover khi di chuột vào các nút */
    .pagination .page-link:hover {
        background-color: #d0ebff;
        color: #0d6efd;
    }

    /* Nút mặc định */
    .pagination .page-link {
        color: #000000;
        border: 1px solid #dee2e6;
    }

    /* Tùy chọn: bo tròn các nút */
    .pagination .page-link {
        border-radius: 0.375rem;
    }
</style>

@endpush

@section('content')
<div class="container-fluid py-2">
    <div class="card my-4">
        <div class="card-header bg-gradient-dark text-white">
            <h5 class="text-white text-capitalize">Danh sách hóa đơn</h5>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-middle text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">Mã Hóa Đơn</th>
                                <th class="text-center">Tên Khách Hàng</th>
                                <th class="text-center">Tổng Tiền</th>
                                <th class="text-center">Ngày Thanh Toán</th>
                                <th class="text-center">Chi Tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bills as $bill)
                                <tr>
                                    <td class="text-center">{{ $bill->id }}</td>
                                    <td class="text-center">{{ $bill->address->name ?? $bill->user->name ?? 'Không có' }}</td>
                                    <td class="text-center">{{ number_format($bill->order->total_price, 0, ',', '.') }} VNĐ</td>
                                    <td class="text-center">{{ $bill->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.bills.show', $bill->id) }}">
                                            <button class="btn btn-primary">
                                                Chi tiết
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                {{ $bills->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
