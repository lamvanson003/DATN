<div class="card mt-3">
    <div class="card-header">
        <h5 class="red">Thông tin Sản phẩm</h5>
    </div>
    <div class="card-body">
        <!-- Name and Slug in the same row -->
        <div class="col-md-12 col-sm-12 d-flex mb-3">
            <div class="me-2 flex-grow-1">
                <label class="control-label">Tên sản phẩm<span style="color: red">*</span>:</label>
                <input type="text" required class="form-control" name="name" value="{{ $product->name }}" placeholder="VD: Iphone 13 Pro Max">
            </div>
            <div class="flex-grow-1">
                <label class="control-label">Đường dẫn<span style="color: red">*</span>:</label>
                <input type="text" required class="form-control" name="slug" value="{{ $product->slug }}" placeholder="VD: iphone-13-promax">
            </div>
        </div>
       <!-- Category ID and Brand ID in the same row -->
        <div class="col-md-12 col-sm-12 d-flex mb-3">
            <div class="me-2 flex-grow-1">
                <label class="control-label">Danh mục<span style="color: red">*</span>:</label>
                <select class="form-select" name="category_id" required>
                    @foreach ($categories as $category)
                        <option {{ $category->id == $product->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-grow-1">
                <label class="control-label">Thương hiệu<span style="color: red">*</span>:</label>
                <select class="form-select" name="brand_id" required>
                    @foreach ($brands as $brand)
                        <option {{ $brand->id == $product->brand_id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Short Description -->
        <div class="col-md-12 col-sm-12">
            <div class="mb-3">
                <label class="control-label">Mô tả ngắn:</label>
                <input type="text" class="form-control" name="short_desc" value="{{ $product->short_desc }}" placeholder="Mô tả ngắn về sản phẩm">
            </div>
        </div>

        <!-- Description -->
        <div class="col-md-12 col-sm-12">
            <div class="mb-3">
                <label class="control-label">Mô tả chi tiết:</label>
                <textarea class="form-control" name="description" rows="0" placeholder="Mô tả chi tiết về sản phẩm">
                    {{ $product->description }}
                </textarea>
            </div>
        </div>

        <!-- Image-item -->
        <div class="col-md-12 col-sm-12">
            <div class="mb-3">
                <label class="control-label">Hình ảnh chi tiết:</label>
                <div class="card-body">
                    <div class="table-responsive">
                      <table id="add-row" class="display table table-hover fix_table">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Tên sản phẩm</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th style="width: 10%">Hành động</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th></th>
                            <th>Tên sản phẩm</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th style="width: 10%">Hành động</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          @foreach ($product_image_item as $item)
                            <tr>
                              <td><img class="text-center fix-image" src="{{ asset($item->images) }}" alt=""></td> 
                              <td><a href="{{ route('admin.product.item.edit',$item->id) }}">{{ $item->name ?? 'N/A'}}</a></td> 
                              <td><span>{{ $item->posittion ?? 'N/A' }}</span></td> 
                             
                              <td>
                                @switch($item->status->value)
                                  @case(\App\Enums\Status::Active)
                                  <span class="badge rounded-pill badge-success">{{ $item->status->description }}</span>
                                  @break
                                  @case(\App\Enums\Status::Inactive)
                                  <span class="badge rounded-pill badge-warning">{{ $item->status->description }}</span>
                                  @break
                                  @default
                                @endswitch
                              </td> 
                              <td>
                                <div class="form-button-action gap-2">
                                  <a href="{{ route('admin.product.item.edit', $item->id) }}">
                                    <button type="button" data-bs-toggle="tooltip" title="Chỉnh sửa" class="btn btn-info btn-icon">
                                      <i class="fa fa-pencil-alt"></i>
                                    </button>
                                  </a>
        
                                  <button type="button" class="btn btn-danger btn-icon" data-bs-toggle="modal" data-bs-target="#deleteMyModal{{ $item->id }}">
                                    <i class="fa fa-trash-alt"></i>
                                  </button>
                                </div>                        
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
