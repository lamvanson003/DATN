<div class="card mt-3">
    <div class="card-header">
        <h5 class="red">Thông tin Biến thể</h5>
    </div>
    <div class="row card-body">
       
        <div class="col-md-12 col-sm-12 gap-2 d-flex">
            <!-- storage -->
            <div class="mb-3 col-6">
                <label class="control-label">Dung lượng <span style="color: red">*</span>:</label>
                <input type="text" required class="form-control" name="storage" placeholder="VD: 256GB">
            </div>
        </div>

        <div class="col-md-12 col-sm-12 gap-2 d-flex">
            <!-- price -->
            <div class="mb-3 col-6">
                <label class="control-label">Giá <span style="color: red">*</span>:</label>
                <input type="number" required class="form-control" name="price" placeholder="VND">
            </div>

            <!-- price sale -->
            <div class="mb-3 col-6">
                <label class="control-label">Giá khuyến mãi :</label>
                <input type="number" class="form-control" name="sale" placeholder="VND">
            </div>
        </div>

        <div class="col-md-12 col-sm-12 gap-2 d-flex">
            <!-- memory -->
            <div class="mb-3 col-6">
                <label class="control-label">Gói bảo hành <span style="color: red">*</span>:</label>
                <input type="text" required class="form-control" name="memory" placeholder="VD: 1năm">
            </div>

            <!-- instock -->
            <div class="mb-3 col-6">
                <label class="control-label">Nhập số lượng (cái) <span style="color: red">*</span> :</label>
                <input type="number" required class="form-control" name="instock" placeholder="VD: 1">
            </div>
        </div>

        
            <!-- Color -->
            <div class="col-md-12 col-sm-12">
                <div id="color-select">
                    <label for="color" class="form-label">Màu Sắc</label>
                    <select class="form-select select2 form-control" name="color[]" id="colorSL" multiple style="width: 100% !important;">
                        @foreach ($colors as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-12 col-sm-12 text-center mt-3">
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class="badge rounded-pill badge-danger">Thêm màu sắc</span> 
                </a>
            </div>

    </div>
</div>
