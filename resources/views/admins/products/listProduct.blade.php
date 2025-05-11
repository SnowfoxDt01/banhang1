@extends('admins.layouts.default')

@section('title')
    @parent
     Danh sách sản phẩm
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
        {{-- table 1 --}}
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-3">
                <h6 class="text-white text-capitalize">Danh sách sản phẩm</h6>
                <a href="{{ route('admin.products.addProduct') }}" class= "btn btn-light">Thêm sản phẩm</a>
              </div>
            </div>            
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="w-15 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên sản phẩm</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Hình ảnh</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mô tả</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số lượng</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giá tiền</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                    @foreach($listProduct as $key => $value)
                      <tr>
                        <td>{{--name--}}
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $value -> name }}</h6> 
                              
                            </div>
                          </div>
                        </td>
                        <td> {{--ảnh--}}
                            <div class="text-center">
                                @if ($value->images->count() > 0)
                                    <img src="{{ asset($value->images->first()->image) }}"
                                        alt="{{ $value->images->first()->alt }}" class="img-thumbnail" style="width: 125px; height: 125px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('default_image.jpg') }}" alt="No Image"
                                        class="img-thumbnail" style="width: 125px; height: 125px; object-fit: cover;">
                                @endif
                            </div>
                        </td>
                        <td>{{--mô tả--}}
                          <p class="text-xs font-weight-bold mb-0">
                              {{ Str::limit($value->description, 150, '...') }}
                          </p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            {{ $value->variantProducts->sum('quantity') ?? 0 }}
                        </td>


                        <td class="align-middle text-center">{{--giá tiền--}}
                          <span class="text-secondary text-xs font-weight-bold">
                            {{ number_format($value->sale_price ?: $value->base_price, 0, ',', '.') }}₫
                          </span>
                        </td>
                        

                        <td class="align-middle text-center" style="width: 15%; white-space: normal;">
                          <div class="d-inline-flex flex-wrap justify-content-center">
                            <a href="#" class="btn btn-warning btn-sm me-1 mb-1">Sửa</a>
                            <a href="#" class="btn btn-danger btn-sm me-1 mb-1">Xóa</a>
                            <a href="#" class="btn btn-info btn-sm">Chi tiết</a>
                          </div>
                        </td>


                      </tr>
                    @endforeach
                    {{-- <tr> mẫu bảng
                      <td>name
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">John Michael</h6> 
                            <p class="text-xs text-secondary mb-0"><a href="https://demos.creative-tim.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="274d484f496744554246534e51420a534e4a0944484a">[email&#160;protected]</a></p>
                          </div>
                        </div>
                      </td>
                      <td> ảnh
                        
                          <div class="text-center">
                            <img src="{{ asset('../admin/img/team-2.jpg') }}" style="width: 100px; height: 100px;" class="border-radius-lg" alt="user1">
                          </div> 
                      </td>
                      <td>mô tả
                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                        <p class="text-xs text-secondary mb-0">Organization</p>
                      </td>
                      <td class="align-middle text-center text-sm">số lượng
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                      </td>
                      <td class="align-middle text-center">giá tiền
                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                      </td>
                      <td class="align-middle">hành động
                        <div class="text-center">
                          <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                        </div>
                        
                      </td>
                    </tr> --}}
                  </tbody>
                </table>
                {{ $listProduct->links('pagination::bootstrap-5') }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Table 1 -->

        

@endsection


@push('scripts')

@endpush