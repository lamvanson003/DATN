<div class="card">
    <div class="card-header">
        <h5 class="red">Thông tin Biến thể</h5>
    </div>
    <div class="row card-body">
        @if (isset($colors))
            <!-- Color -->
            <div class="col-md-12 col-sm-12">
                <div id="color-select">
                    <div class="mb-3 col-6">
                        <label for="color" class="form-label">Chọn Màu Sắc</label>
                        <select class="form-select select2" name="color[]" id="colorSL" multiple>

                            @foreach ($colors as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12 col-sm-12 mb-3">
                <a href="{{ route('admin.color.create') }}" class="red">
                    <span class="badge text-bg-danger">Thêm màu sắc</span>
                </a>
            </div>
        @endif

        <div class="col-md-12 col-sm-12 gap-2 d-flex">
            <!-- storage -->
            <div class="mb-3 col-6">
                <label class="control-label">Dung lượng <span style="color: red">*</span>:</label>
                <input type="text" required class="form-control" name="storage" placeholder="VD: iphone-13-promax">
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
                <input type="number" required class="form-control" name="sale" placeholder="VND">
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
                <label class="control-label">Nhập số lượng (cái) :</label>
                <input type="number" required class="form-control" name="instock" placeholder="VD: 1">
            </div>
        </div>
    </div>
</div>
