@extends('admins.layouts.default')

@section('title')
    @parent
    Chi tiết đơn hàng
@endsection

@section('content')
<div class="container-fluid py-2">
    <div class="card my-4">
        <div class="card-header bg-gradient-dark text-white">
            <h5 class="text-white text-capitalize">Chi tiết đơn hàng #{{ $order->id }}</h5>
        </div>
        <div class="card-body">
            <h6>Thông tin khách hàng</h6>
            <ul>
                <li><b>Tên:</b> {{ $order->address->name ?? $order->user->name ?? 'N/A' }}</li>
                <li><b>Số điện thoại:</b> {{ $order->address->phone ?? 'N/A' }}</li>
                <li><b>Địa chỉ:</b> {{ $order->address->address_line1 ?? '' }} {{ $order->address->address_line2 ?? '' }}</li>
            </ul>
            <h6>Sản phẩm trong đơn</h6>
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 ">
                    <thead>
                        <tr>
                            
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Biến thể</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Số lượng</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td>
                                    @if(isset($item->variant->images->image))
                                        <img src="{{ asset($item->variant->images->image) }}" alt="Ảnh biến thể" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 8px; display: inline-block; vertical-align: middle;">
                                    @endif
                                    <span style="vertical-align: middle;">{{ $item->variant->color->name ?? '' }} - {{ $item->variant->size->name ?? '' }}</span>
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-center">{{ number_format($item->order_total_price, 0, ',', '.') }}₫</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <b>Tổng tiền:</b> {{ number_format($order->total_price, 0, ',', '.') }}₫<br>
                <b>Trạng thái:</b> {{ $order->payment_status }}<br>
                <b>Ngày tạo:</b> {{ $order->created_at->format('d/m/Y H:i') }}
            </div>
            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning mt-3">Chỉnh sửa</a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
        </div>
    </div>
</div>
@endsection
