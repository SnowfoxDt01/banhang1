@extends('client.layout.default')

@section('title')
    @parent
    Chi tiết giỏ hàng
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
                        <h2>Giỏ hàng</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- slider Area End-->
      @if(session('success'))
          <div class="alert alert-success" style="font-size:16px; margin-bottom:18px;">{{ session('success') }}</div>
      @endif
  <!--================Cart Area =================-->
  <section class="cart_area section_padding">
   
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Ảnh sản phẩm</th>
                <th scope="col">Giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Tổng giá</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $cart = Auth::check() ? (\App\Models\ShoppingCart::where('user_id', Auth::id())->with('items.variantProduct.product.images')->first()) : null;
                  $cartItems = $cart ? $cart->items : collect();
                  $total = 0;
              @endphp
              @foreach($cartItems as $item)
                  @php
                      $product = $item->variantProduct->product;
                      $variant = $item->variantProduct;
                      $image = $variant->images->image ?? ($product->images->first()->image ?? 'client/img/default.png');
                      $lineTotal = ($product->sale_price > 0 ? $product->sale_price : $product->base_price) * $item->quantity;
                      $total += $lineTotal;
                  @endphp
                  <tr data-item-id="{{ $item->id }}">
                      <td>
                          <div class="media">
                              <div class="d-flex">
                                  <img src="{{ asset($image) }}" alt="" style="width: 70px; height: 70px; object-fit: cover; border-radius: 6px; border: 1px solid #eee;" />
                              </div>
                              <div class="media-body">
                                  <p>{{ $product->name }}<br><small>Màu: {{ $variant->color->name ?? '' }}, Size: {{ $variant->size->name ?? '' }}</small></p>
                              </div>
                          </div>
                      </td>
                      <td>
                          <h5 class="unit-price">{{ number_format($product->sale_price > 0 ? $product->sale_price : $product->base_price, 0, ',', '.') }}₫</h5>
                      </td>
                      <td>
                          <div class="cart-quantity">
                              <input type='button' value='-' class='qtyminus minus' id='qtyminus_{{ $item->id }}'>
                              <input type='text' name='quantity_{{ $item->id }}' value='{{ $item->quantity }}' class='qty' id='qty_{{ $item->id }}' min='1' max='{{ $variant->quantity }}'>
                              <input type='button' value='+' class='qtyplus plus' id='qtyplus_{{ $item->id }}'>
                          </div>
                      </td>
                      <td>
                          <h5 class="line-total">{{ number_format($lineTotal, 0, ',', '.') }}₫</h5>
                      </td>
                  </tr>
              @endforeach
              <tr>
                  <td></td>
                  <td></td>
                  <td>
                      <h5>Tổng tiền thanh toán</h5>
                  </td>
                  <td>
                      <h5 id="cart-total">{{ number_format($total, 0, ',', '.') }}₫</h5>
                  </td>
              </tr>
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right">
            <a class="btn_1" href="{{ route('index') }}">Tiếp tục mua sắm</a>
            <a class="btn_1 checkout_btn_1" href="{{ route('client.checkout') }}">Thanh toán</a>
          </div>
        </div>
      </div>
  </section>
  <!--================End Cart Area =================-->


@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function formatCurrency(num) {
        return num.toLocaleString('vi-VN') + '₫';
    }
    @foreach($cartItems as $item)
        let maxQty{{ $item->id }} = {{ $variant->quantity }};
        let qtyInput{{ $item->id }} = document.getElementById('qty_{{ $item->id }}');
        let minusBtn{{ $item->id }} = document.getElementById('qtyminus_{{ $item->id }}');
        let plusBtn{{ $item->id }} = document.getElementById('qtyplus_{{ $item->id }}');
        let tr{{ $item->id }} = qtyInput{{ $item->id }}.closest('tr');
        let unitPrice{{ $item->id }} = parseInt(tr{{ $item->id }}.querySelector('.unit-price').textContent.replace(/\D/g, ''));
        let lineTotalEl{{ $item->id }} = tr{{ $item->id }}.querySelector('.line-total');

        function updateLineTotal{{ $item->id }}() {
            let qty = parseInt(qtyInput{{ $item->id }}.value) || 1;
            if(qty < 1) qty = 1;
            if(qty > maxQty{{ $item->id }}) qty = maxQty{{ $item->id }};
            qtyInput{{ $item->id }}.value = qty;
            let lineTotal = unitPrice{{ $item->id }} * qty;
            lineTotalEl{{ $item->id }}.textContent = formatCurrency(lineTotal);
            updateCartTotal();
        }

        minusBtn{{ $item->id }}.addEventListener('click', function() {
            let qty = parseInt(qtyInput{{ $item->id }}.value) || 1;
            if(qty > 1) {
                qtyInput{{ $item->id }}.value = qty - 1;
                updateLineTotal{{ $item->id }}();
            }
        });
        plusBtn{{ $item->id }}.addEventListener('click', function() {
            let qty = parseInt(qtyInput{{ $item->id }}.value) || 1;
            if(qty < maxQty{{ $item->id }}) {
                qtyInput{{ $item->id }}.value = qty + 1;
                updateLineTotal{{ $item->id }}();
            }
        });
        qtyInput{{ $item->id }}.addEventListener('change', updateLineTotal{{ $item->id }});
    @endforeach
    function updateCartTotal() {
        let total = 0;
        document.querySelectorAll('.line-total').forEach(function(el) {
            total += parseInt(el.textContent.replace(/\D/g, ''));
        });
        document.getElementById('cart-total').textContent = formatCurrency(total);
    }
});
</script>
@endpush
