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
              <table id="basic-datatables" class="fontTable table table-hover fix_table">
                <thead>
                  <tr>
                    <th></th>
                    <th>Mã SP</th>
                    <th>Dung lượng</th>
                    <th>Giá</th>
                    <th>Khuyến mãi</th>
                    <th>Số lượng</th>
                    <th>Lượt mua </th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Mã SP</th>
                    <th>Dung lượng</th>
                    <th>Giá</th>
                    <th>Khuyến mãi</th>
                    <th>Số lượng</th>
                    <th>Lượt mua </th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($product_variant as $item)
                    <tr>
                      <td><img class="text-center fix-image" src="{{ asset($item->images) }}" alt="{{ $item->name }}"></td>
                      <td><a href="{{ route('admin.product.product_item.edit',[$product->id,$item->id]) }}">{{ $item->sku }}</a></td> 
                      <td><strong>{{ $item->storage }}</strong></td> 
                      <td>{{ number_format($item->price) }}</td> 
                      <td><span class="red">{{ number_format($item->sale)??'N/A' }}</span></td> 
                      <td>{{ $item->instock }}</td> 
                      <td>
                        @if($item->sold > 0)
                            {{ $item->sold }}
                        @else
                            <span class="badge text-danger">Chưa có lượt mua</span>
                        @endif
                      </td>
                      <td>
                        @switch($item->status->value)
                            @case(\App\Enums\DefaultStatus::Active)
                                <span class="badge rounded-pill badge-success">{{ \App\Enums\DefaultStatus::getDescription($item->status->value) }}</span>
                            @break
                            @case(\App\Enums\DefaultStatus::Inactive)
                                <span class="badge rounded-pill badge-warning">{{ \App\Enums\DefaultStatus::getDescription($item->status->value) }}</span>
                            @break
                            @case(\App\Enums\DefaultStatus::Deleted)
                                <span class="badge rounded-pill badge-danger">{{ \App\Enums\DefaultStatus::getDescription($item->status->value) }}</span>
                            @break
                            @default
                                <span class="badge rounded-pill badge-secondary">Không xác định</span>
                        @endswitch
                      </td> 
                      
                      <td >
                        <div class="d-flex align-items-center gap-3">
                          <button type="button" class="btn btn-danger btn-icon" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                            <i class="fa fa-trash"></i>
                          </button>             
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
                              Xóa biến thể  <span class="red">{{ $item->storage }} </span> khỏi dữ liệu hệ thống ?.
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('admin.product.product_item.delete',[$product->id,$item->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Tiếp tục</button>
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
