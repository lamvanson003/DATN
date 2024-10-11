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
                    <th>Mã SP</th>
                    <th>Dung lượng</th>
                    <th>Giá</th>
                    <th>Khuyến mãi</th>
                    <th>Số lượng</th>
                    <th>Thời gian bảo hành</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Mã SP</th>
                    <th>Dung lượng</th>
                    <th>Giá</th>
                    <th>Khuyến mãi</th>
                    <th>Số lượng</th>
                    <th>Thời gian bảo hành</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($product_variant as $item)
                    <tr>
                      <td><a href="{{ route('admin.product.product_item.edit',[$item->id,$product->id]) }}">{{ $item->sku }}</a></td> 
                      <td>{{ $item->storage }}</td> 
                      <td>{{ number_format($item->price) }}</td> 
                      <td><span class="red">{{ number_format($item->sale)??'N/A' }}</span></td> 
                      <td>{{ $item->instock }}</td> 
                      <td>{{ $item->memory }}</td> 
                      <td>
                        
                        <button type="button" class="btn btn-primary btn-icon" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                          <i class="fa fa-trash-alt"></i>
                        </button>                       
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
                              Bạn đang thêm Biến thể cho <span class="red">{{ $item->name }}</span>
                          </div>
                          <div class="modal-footer">
                          <a href="{{ route('admin.product.product_item.create',[$item->id, $product->id]) }}">
                              <button type="submit" class="btn btn-danger">Tiếp tục</button>
                          </a>
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
