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
          <a href="#">Sản phẩm</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Danh sách sản phẩm</a>
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
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Các biến thể</th>
                    <th >Image-items</th>
                    <th>Trạng thái</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Các biến thể</th>
                    <th >Image-items</th>
                    <th>Trạng thái</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($products as $item)
                    <tr>
                      <td><img class="text-center fix-image" src="{{ asset($item->images) }}" alt="{{ $item->name }}"></td>
                      <td><a href="{{ route('admin.product.edit', $item->id) }}">{{ $item->name }}</a></td> 
                      <td><a href="{{ route('admin.product_variant.getId',$item->id) }}">DS biển thể</a></td> 
                      <td>
                        <div class="row">
                            <div class="image-items d-flex align-items-center gap-2 justify-content-center">
                              @foreach ($item->product_image_items as $imageItem)
                                <img class="text-center fix-image" src="{{ asset($imageItem->image) }}" alt="{{ $item->name }}">
                              @endforeach
                            </div>
                            <a href="{{ route('admin.product_image_item.imageItem',$item->id) }}">DS Image-items</a>
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
                    </tr>
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
