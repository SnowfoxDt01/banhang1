@extends('admins.layouts.default')

@section('title')
    @parent
     Danh sách biến thể
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
                <h6 class="text-white text-capitalize">Danh sách sản phẩm biến thể</h6>
                {{-- <a href="#" class= "btn btn-light">Thêm sản phẩm</a> --}}
              </div>
            </div>            
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="w-15 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên biến thể</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Hình ảnh</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sản phẩm chính</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số lượng</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giá tiền</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                    @foreach($variants as $key => $value)
                      <tr>
                        <td>  {{--tên--}}
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm" style="max-width: 200px; word-break: break-word; white-space: normal;">
                                {{ $value->name }}
                              </h6>
                            </div>
                          </div>
                        </td>

                        <td> {{--ảnh--}}
                            <div class="text-center">
                              <img src="{{ asset($value->images->image) }}" style="width: 100px; height: 100px; object-fit: cover;" class="border-radius-lg" alt="{{ $value->images->alt }}">
                            </div>
                        </td>
                        <td>{{--sản phẩm chính--}}
                          <p class="text-xs font-weight-bold mb-0">
                              {{ $value->product->name }}
                          </p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            {{ $value->sum('quantity') ?? 0 }}
                        </td>


                        <td class="align-middle text-center">{{--giá tiền--}}
                          <span class="text-secondary text-xs font-weight-bold">
                            {{ number_format($value->variant_price, 0, ',', '.') }}₫
                          </span>
                        </td>
                        

                        <td class="align-middle text-center" style="width: 15%; white-space: normal;">
                          <div class="d-inline-flex flex-wrap justify-content-center">
                            <a href="{{ route('admin.variants.updateVariant', $value->id) }}" class="btn btn-warning btn-sm me-1 ">Sửa</a>
                            <form action="{{ route('admin.variants.deleteVariant', $value->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Xóa
                                </button>
                            </form>
                            <a href="{{ route('admin.variants.detailVariant', $value->id) }}" class="btn btn-info btn-sm">Chi tiết</a>
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
                {{ $variants->links('pagination::bootstrap-5') }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Table 1 -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Bạn có chắc muốn xóa sản phẩm này không</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-sm">Nếu bạn xóa sản phẩm này, tất cả các thông tin liên quan đến sản phẩm sẽ bị xóa.</p>
        <p class="text-sm">Bạn có chắc chắn muốn xóa không?</p>
        <p class="text-sm">Nếu bạn không chắc chắn, hãy nhấn nút "Đóng" để quay lại.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-danger">Xóa sản phẩm</button>
      </div>
    </div>
  </div>
</div>
        

@endsection


@push('scripts')
    <script>
      var deleteModal = document.getElementById('deleteModal');
      deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Nút bấm kích hoạt modal
        var id = button.getAttribute('data-bs-id'); // Lấy giá trị data-bs-id
        console.log('ID sản phẩm:', id); // Kiểm tra giá trị ID trong console

        // Bạn có thể gán ID này vào một input ẩn hoặc xử lý logic khác tại đây
        var modalBody = deleteModal.querySelector('.modal-body');
        modalBody.textContent = 'Bạn có chắc muốn xóa sản phẩm với ID: ' + id + ' không?';
      });
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
          form.addEventListener('submit', function (event) {
            event.preventDefault(); // Ngăn chặn gửi form ngay lập tức

            const confirmDelete = confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');

            if (confirmDelete) {
              form.submit(); // Gửi form nếu người dùng xác nhận
            }
          });
        });
      });
    </script>
@endpush