@extends('layout_admin')

@section('title', 'Sản phẩm')

@section('content_admin')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">CloudLab.Net</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="{{ route('admin.dashboard.index') }}">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.product.index') }}">Sản phẩm</a>
        </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Danh sách sản phẩm</h4>
              <a href="{{ route('admin.product.create') }}" class="ms-auto">
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
                    <th></th>
                    <th>Sản phẩm</th>
                    <th>Biến thể</th>
                    <th >Hình ảnh </th>
                    <th>Trạng thái</th>
                    <th>Lượt bán</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Sản phẩm</th>
                    <th>Biến thể</th>
                    <th >Hình ảnh </th>
                    <th>Trạng thái</th>
                    <th>Lượt bán</th>
                    <th>Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($products as $item)
                    <tr>
                      <td><img class="text-center fix-image" src="{{ asset($item->images) }}" alt="{{ $item->name }}"></td>
                      <td><a href="{{ route('admin.product.edit', $item->id) }}">{{ $item->name }}</a></td> 
                      <td>
                        <div class="d-flex" style="flex-direction: column ; align-items: flex-start">
                          <div class="product_variant">
                            <a  href="{{ route('admin.product.product_item.index',$item->id) }}" data-bs-toggle="modalView" data-bs-target="#exampleModalView">
                              DS biến thể 
                            </a>
                          </div>
                        </div>
                      </td> 
                      <td>
                        <div class="row">
                            <div class="image-items d-flex align-items-center gap-2 justify-content-center mb-3">
                              @foreach ($item->product_image_items as $imageItem)
                                <img class="text-center fix-image" src="{{ asset($imageItem->images) }}" alt="{{ $item->name }}">
                              @endforeach
                            </div>
                            <a href="{{ route('admin.product.item.index',$item->id) }}">DS hình ảnh</a>
                        </div>                  
                    </td>
                      <td>
                        @switch($item->status)
                            @case(\App\Enums\Product\ProductStatus::Active)
                                <span class="badge rounded-pill badge-success">{{ \App\Enums\Product\ProductStatus::getDescription($item->status) }}</span>
                            @break
                            @case(\App\Enums\Product\ProductStatus::Inactive)
                                <span class="badge rounded-pill badge-warning">{{ \App\Enums\Product\ProductStatus::getDescription($item->status) }}</span>
                            @break
                            @case(\App\Enums\Product\ProductStatus::Deleted)
                                <span class="badge rounded-pill badge-danger">{{ \App\Enums\Product\ProductStatus::getDescription($item->status) }}</span>
                            @break
                            @default
                                <span class="badge rounded-pill badge-secondary">Không xác định</span>
                        @endswitch
                    </td>
                    <td>{{ $item->product_variant->sum('sold') }}</td>
                    <td>
                      <div class="form-button-action gap-2">
                        <a href="{{ route('admin.product.edit', $item->id) }}">
                          <button type="button" data-bs-toggle="tooltip" title="Chỉnh sửa" class="btn btn-info btn-icon">
                            <i class="fa fa-pencil-alt"></i>
                          </button>
                        </a>
                      </div>   
                    </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              Chuyển trạng thái thành đã xóa
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('admin.category.delete',$item->id) }}" method="POST">
                              @csrf
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
