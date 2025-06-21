@extends('client.layout.default')

@section('title')
    @parent
    Chi tiết đơn hàng
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
                            <h2>Chi tiết đơn hàng</h2>
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
                <span>Cảm ơn bạn đã mua hàng. Đơn hàng của bạn sẽ được giao sớm nhất có thể.</span>
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
            <div class="col-lg-6 col-lx-4">
            <div class="single_confirmation_details">
                <h4>Thông tin đơn hàng</h4>
                <ul>
                <li>
                    <p>Đơn hàng số</p><span>: {{ $order->id }}</span>
                </li>
                <li>
                    <p>Ngày tạo đơn</p><span>: {{ $order->created_at }}</span>
                </li>
                <li>
                    <p>Tổng tiền</p><span>: {{ $order->total_price }}</span>
                </li>
                <li>
                    <p>Phương thức thanh toán</p><span>: {{ $order->payment_method }}</span>
                </li>
                
                </ul>
            </div>
            </div>
            <div class="col-lg-6 col-lx-4">
            <div class="single_confirmation_details">
                <h4>Địa chỉ giao hàng</h4>
                <ul>
                <li>
                    <p>Người nhận</p><span>: {{ $order->address->name }}</span>
                </li>
                <li>
                    <p>Địa chỉ dòng 1</p><span>: {{ $order->address->address_line1 }}</span>
                </li>
                <li>
                    <p>Địa chỉ dòng 2</p><span>: {{ $order->address->address_line2 }}</span>
                </li>
                <li>
                    <p>Mã bưu điện (mã zip)</p><span>: {{ $order->address->zip_code }}</span>
                </li>
                </ul>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <div class="order_details_iner">
                <h3>Chi tiết đơn hàng</h3>
                <table class="table table-borderless">
                <thead>
                    <tr>
                    <th scope="col" colspan="2">Sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá tiền</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Hiển thị từng sản phẩm trong đơn hàng --}}
                    @foreach($items as $item)
                    
                    <tr>
                        
                        <th colspan="2">
                            @php
                                $variantImage = $item->variant->images->image ?? 'client/img/default.png';
                            @endphp
                            <img src="{{ asset($variantImage) }}" alt="variant" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; margin-right: 10px;">
                            <span>{{ $item->variant->name }}</span>
                        </th>
                        <th>x{{ $item->quantity }}</th>
                        <th><span>{{ number_format($item->order_total_price, 0, ',', '.') }}₫</span></th>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="3">Tổng tiền</th>
                        <th><span>{{ number_format($order->total_price, 0, ',', '.') }}₫</span></th>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                    <th scope="col" colspan="3"></th>
                    <th scope="col">Thành tiền: {{ number_format($order->total_price, 0, ',', '.') }}₫</th>
                    </tr>
                </tfoot>
                </table>
            </div>
            </div>
        </div>
        </div>
    </section>
    <!--================ confirmation part end =================-->

    

@endsection

@push('scripts')

@endpush
