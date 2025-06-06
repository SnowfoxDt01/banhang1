@extends('client.layout.default')

@section('title')
    @parent
    Thanh toán đơn hàng
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
                            <h2>Thanh toán</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_padding">
        <div class="container">
        <div class="billing_details">
            <div class="row">
                <form class="row contact_form" action="{{ route('client.checkout.process') }}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="col-lg-8">
                        <h3>Địa chỉ</h3>
                        {{-- thông tin khách hàng mua --}}
                        
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="first" name="name" placeholder="Họ Tên"
                                    value="{{ old('name', Auth::user() ? Auth::user()->name : '') }}" />
                                
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="number" name="number" placeholder="Số Điện Thoại" value="{{ old('number') }}" />
                                
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="city" name="city" placeholder="Thành Phố" value="{{ old('city') }}" />
                                
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add1" name="add1" placeholder="Địa chỉ dòng 01" value="{{ old('add1') }}" />
                                
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add2" name="add2" placeholder="Địa chỉ dòng 02" value="{{ old('add2') }}" />
                                
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="Mã Zip" value="{{ old('zip') }}" />
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Ghi chú</h3>
                                </div>
                                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Ghi chú đơn hàng"></textarea>
                            </div>
                        
                    </div>
                    <div class="col-lg-4">
                        {{-- Thông tin sản phẩm được mua --}}
                        <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li>
                                <a href="#">Sản phẩm
                                    <span>Giá</span>
                                </a>
                            </li>
                            {{-- Sử dụng dữ liệu đã xử lý từ controller --}}
                            @foreach($cartDisplayItems as $item)
                                <li style="display: flex; align-items: center;">
                                    <img src="{{ asset($item['image']) }}" alt="variant" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; margin-right: 10px;">
                                    <a href="#" style="flex:1;">
                                        {{ $item['name'] }}
                                        <span class="middle">x {{ $item['quantity'] }}</span>
                                        <span class="last">{{ number_format($item['line_total'], 0, ',', '.') }}₫</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="list list_2">
                            <li>
                            <a href="">Tổng tiền
                                <span>{{ number_format($cartTotal, 0, ',', '.') }}₫</span>
                            </a>
                            </li>
                            <li>
                            <a href="">Thành tiền
                                <span>{{ number_format($cartTotal, 0, ',', '.') }}₫</span>
                            </a>
                            </li>
                        </ul>
                        <div class="payment_item">
                            <div class="radion_btn">
                            <input type="radio" id="f-option5" name="selector" />
                            <label for="f-option5">COD ( thanh toán khi nhận hàng )</label>
                            <div class="check"></div>
                            </div>
                        </div>
                        <div class="payment_item active">
                            <div class="radion_btn">
                            <input type="radio" id="f-option6" name="selector" />
                            <label for="f-option6">VnPay</label>
                            <img src="img/product/single-product/card.html" alt="" />
                            <div class="check"></div>
                            </div>
                        </div>
                        
                        <button class="btn_3" type="submit">Xác nhận thanh toán</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->


@endsection

@push('scripts')

@endpush
