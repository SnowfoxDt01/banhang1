@extends('client.layout.default')

@section('title')
    @parent
    Danh sách đơn hàng
@endsection

@push('style')


@endpush


@section('content')

    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('client/img/hero/category.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Danh sách đơn hàng</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->    

    <!--================ confirmation part start =================-->
    <section class="confirmation_part section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="confirmation_tittle">
                        <h2>Danh sách đơn hàng của bạn</h2>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="order_details_iner">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Địa chỉ giao hàng</th>
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>
                                            @php
                                                $firstItem = $order->orderItems->first();
                                                $variantImage = $firstItem && $firstItem->variant && $firstItem->variant->images ? $firstItem->variant->images->image : 'client/img/default.png';
                                                $variantName = $firstItem && $firstItem->variant ? $firstItem->variant->name : '';
                                                $displayName = mb_strlen($variantName) > 20 ? mb_substr($variantName, 0, 20) . '...' : $variantName;
                                            @endphp
                                            <img src="{{ asset($variantImage) }}" alt="variant" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; margin-right: 10px;">
                                            <span>{{ $displayName }}</span>
                                        </td>
                                        <td>{{ number_format($order->total_price, 0, ',', '.') }}₫</td>
                                        <td>{{ [
                                            'confirming' => 'Chờ xác nhận',
                                            'confirmed' => 'Đã xác nhận',
                                            'preparing' => 'Đang chuẩn bị',
                                            'shipping' => 'Đang giao hàng',
                                            'delivered' => 'Đã giao hàng',
                                            'completed' => 'Hoàn thành',
                                            'canceled' => 'Đã hủy',
                                            'pending' => 'Chờ xử lý',
                                        ][$order->payment_status] ?? ucfirst($order->payment_status) }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>{{ $order->address->address_line1 ?? '' }} {{ $order->address->address_line2 ?? '' }}</td>
                                        <td>
                                            <a href="{{ route('client.orderDetail', $order->id) }}" class="btn btn-info btn-sm">Xem</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex align-items-center justify-content-end py-1">
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ confirmation part end =================-->

    

@endsection

@push('scripts')

@endpush
