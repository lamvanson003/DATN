<div class="card mt-3">
    <div class="card-header">
        <h5 class="red">Thông tin Biến thể</h5>
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
                        <th>Màu sắc đi kèm</th>
                        <th>Bảo hành</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Mã SP</th>
                        <th>Dung lượng</th>
                        <th>Giá</th>
                        <th>Khuyến mãi</th>
                        <th>Màu sắc đi kèm</th>
                        <th>Bảo hành</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($product_variant as $item)
                    <tr>
                        <td>
                            <a href="{{ route('admin.product.product_item.edit', [$product->id, $item->id]) }}">{{ $item->sku }}</a>
                        </td>
                        <td>{{ $item->storage }}</td>
                        <td>{{ number_format($item->price) }}</td>
                        <td><span class="red">{{ number_format($item->sale) ?? 'N/A' }}</span></td>
                        <td style="flex-direction: column">
                            <div style="text-align: left">
                                <div class="mb-3">
                                    @foreach ($item->variantColor as $variantColor)
                                        <a href="{{ route('admin.color.edit', $variantColor->color->id) }}" class="badge bg-info text-white text-center">{{ $variantColor->color->name }}</a>
                                    @endforeach
                                </div>
                                
                                <span href="#" data-bs-toggle="modal" data-bs-target="#exampleModalColor{{ $item->id }}">
                                    <span class="badge rounded-pill icon-plusss">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                </span>

                                <div class="modal fade" id="exampleModalColor{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalColorLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="exampleModalColorLabel{{ $item->id }}">Thêm màu sắc mới</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.color.storeByVariant') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_variant_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <!-- Tên màu sắc -->
                                                    <div class="mb-3">
                                                        <label class="form-label" for="colorName{{ $item->id }}">Tên màu sắc <span class="text-danger">*</span>:</label>
                                                        <input type="text" id="colorName{{ $item->id }}" required class="form-control" name="name" placeholder="VD: Midnight (Đen)">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Thêm màu</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $item->memory }}</td>
                    </tr>
                @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
</div>
