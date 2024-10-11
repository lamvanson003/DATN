@extends('layout_admin')

@section('title', 'Các biến thể')

@section('content_admin')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">CloudLab</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="{{ route('admin.dashboard.index') }}">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-home">
          <a href="{{ route('admin.product.index') }}">
            Sản phẩm
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.product.edit',$product->id) }}">{{ $product->name }}</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Danh sách biến thể</a>
        </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title red">Danh sách biến thể</h4>
              <a href="{{ route('admin.product.product_item.create',$product->id )}}" class="ms-auto">
                <button type="button" class="btn btn-primary btn-round">
                  <i class="fa fa-plus"></i>
                  Thêm
                </button>
              </a>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table id="add-row" class="display table table-hover fix_table">
                <thead>
                  <tr>
                    <th>Hình ảnh</th>
                    <th>Tên biến thể</th>
                    <th>Dung lượng</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thời gian bảo hành</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Hình ảnh</th>
                    <th>Tên biến thể</th>
                    <th>Dung lượng</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thời gian bảo hành</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($product_variant as $item)
                    <tr>
                      <td><a href="{{ route('admin.product.product_item.edit',$item->id) }}">{{ $item->sku }}</a></td> 
                      <td>{{ $item->storage }}</td> 
                      <td>{{ $item->price }}</td> 
                      <td>{{ $item->sale }}</td> 
                      <td>{{ $item->instock }}</td> 
                      <td>{{ $item->memory }}</td> 
                      <td>
                        <div class="form-button-action gap-2">
                          <a href="{{ route('admin.product.product_item.edit', $item->id) }}">
                            <button type="button" data-bs-toggle="tooltip" title="Chỉnh sửa" class="btn btn-info btn-icon">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                          </a>
                        </div>                        
                      </td>
                    </tr>

                    <!-- Modal Xóa sản phẩm -->
                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              Xóa dữ liệu này khỏi dữ liệu hệ thống?
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('admin.product.product_item.delete',[$item->id,$product->id]) }}" method="POST">
                              @csrf
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
