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
                        <td>
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                        </td>
                        <td>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#productItem{{ $item->id }}">
                            <i class="fa fa-cogs"></i>
                          </a>
                        </td>                        
                        <td>
                            <div class="row">
                                <div class="image-items d-flex align-items-center gap-2 justify-content-center">
                                    @foreach ($item->product_image_items as $imageItem)
                                        <img class="text-center fix-image" src="{{ asset($imageItem->images) }}" alt="{{ $item->name }}">
                                    @endforeach
                                </div>
                                <a href="{{ route('admin.product.item.index',$item->id) }}">DS Image-items</a>
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

                    <!-- Modal chỉnh sửa sản phẩm -->
                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Chỉnh sửa sản phẩm: {{ $item->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.product.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="id" value="{{ $item->id }}">

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Tên sản phẩm</label>
                                                <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Đường dẫn</label>
                                                <input type="text" name="slug" class="form-control" value="{{ $item->slug }}" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Mô tả ngắn</label>
                                            <textarea name="short_desc" class="form-control">{{ $item->short_desc }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Mô tả chi tiết</label>
                                            <textarea name="description" class="form-control">{{ $item->description }}</textarea>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Danh mục</label>
                                                <select name="category_id" class="form-select" required>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Thương hiệu</label>
                                                <select name="brand_id" class="form-select" required>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ $item->brand_id == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Ảnh đại diện</label>
                                            <input type="file" name="new_image" class="form-control">
                                            <input type="hidden" name="old_image" value="{{ $item->images }}">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="productItem{{ $item->id }}" tabindex="-1" aria-labelledby="productItemLabel{{ $item->id }}" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="productItemLabel{{ $item->id }}">Thông số kỹ thuật: {{ $item->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            @if($item->product_variant->isEmpty())
                              <p>Không có thông số kỹ thuật nào cho sản phẩm này.</p>
                            @else
                              @foreach ($item->product_variant as $variant)
                                <h6>Biến thể: {{ $variant->sku }}</h6>
                                <dl class="row">
                                  <dt class="col-sm-3">Dung lượng</dt>
                                  <dd class="col-sm-9">{{ $variant->storage }}</dd>
                    
                                  <dt class="col-sm-3">Giá</dt>
                                  <dd class="col-sm-9">{{ number_format($variant->price, 0, ',', '.') }} ₫</dd>
                    
                                  <dt class="col-sm-3">Số lượng</dt>
                                  <dd class="col-sm-9">{{ $variant->instock }}</dd>
                    
                                  <dt class="col-sm-3">Thời gian bảo hành</dt>
                                  <dd class="col-sm-9">{{ $variant->memory }} tháng</dd>
                                </dl>
                                <hr>
                              @endforeach
                            @endif
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <a href="{{ route('admin.product.product_item.index', $item->id) }}" class="btn btn-primary">Chi tiết</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- <div class="modal fade" id="productItem{{ $item->id }}" tabindex="-1" aria-labelledby="productItemLabel{{ $item->id }}" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="productItemLabel{{ $item->id }}">Thông số kỹ thuật: {{ $item->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            @if($item->product_variant->isEmpty())
                              <p>Không có thông số kỹ thuật nào cho sản phẩm này.</p>
                            @else
                              <div class="row">
                                @foreach ($item->product_variant as $variant)
                                  <div class="col-md-6 mb-3">
                                    <div class="card">
                                      <div class="card-header">
                                        Biến thể: {{ $variant->sku }}
                                      </div>
                                      <div class="card-body">
                                        <p><strong>Dung lượng:</strong> {{ $variant->storage }}</p>
                                        <p><strong>Giá:</strong> {{ number_format($variant->price, 0, ',', '.') }} ₫</p>
                                        <p><strong>Số lượng:</strong> {{ $variant->instock }}</p>
                                        <p><strong>Thời gian bảo hành:</strong> {{ $variant->memory }} tháng</p>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                              </div>
                            @endif
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <a href="{{ route('admin.product.product_item.index', $item->id) }}" class="btn btn-primary">Chi tiết</a>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                    
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
