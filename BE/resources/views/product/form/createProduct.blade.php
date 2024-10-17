<div class="card mt-3">
    <div class="card-header">
        <h5 class="red">Thông tin Sản phẩm</h5>
    </div>
    <div class="card-body">
        <!-- Name and Slug in the same row -->
        <div class="col-md-12 col-sm-12 d-flex mb-3">
            <div class="me-2 flex-grow-1">
                <label class="control-label">Tên sản phẩm<span style="color: red">*</span>:</label>
                <input type="text" required class="form-control" name="name" placeholder="VD: Iphone 13 Pro Max">
            </div>
            <div class="flex-grow-1">
                <label class="control-label">Đường dẫn<span style="color: red">*</span>:</label>
                <input type="text" required class="form-control" name="slug" placeholder="VD: iphone-13-promax">
            </div>
        </div>
       <!-- Category ID and Brand ID in the same row -->
        <div class="col-md-12 col-sm-12 d-flex mb-3">
            <div class="me-2 flex-grow-1">
                <label class="control-label">Danh mục<span style="color: red">*</span>:</label>
                <select class="form-select" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-grow-1">
                <label class="control-label">Thương hiệu<span style="color: red">*</span>:</label>
                <select class="form-select" name="brand_id" required>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Short Description -->
        <div class="col-md-12 col-sm-12">
            <div class="mb-3">
                <label class="control-label">Mô tả ngắn:</label>
                <input type="text" class="form-control" name="short_desc" placeholder="Mô tả ngắn về sản phẩm">
            </div>
        </div>

        <!-- Description -->
        <div class="col-md-12 col-sm-12">
            <div class="mb-3">
                <label class="control-label">Mô tả chi tiết:</label>
                <textarea class="form-control" name="description" rows="4" placeholder="Mô tả chi tiết về sản phẩm"></textarea>
            </div>
        </div>

        <!-- Image-item -->
        <div class="col-md-12 col-sm-12">
            <div class="mb-3">
                <label class="control-label">Hình ảnh chi tiết:</label>
                <div class="wrap">
                    <div class="dandev-reviews" >
                        <div class="form_upload">
                            <label class="dandev_insert_attach">
                                <span  style=" background: url('{{ asset('images/camera.png') }}') no-repeat;">Đính kèm ảnh</span>
                            </label>
                        </div>
                        <div class="list_attach">
                            <ul class="dandev_attach_view">
            
                            </ul>
                            <span class="dandev_insert_attach"><i class="dandev-plus">+</i></span>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
</div>
