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
                        <td> {{ $item->color }} </td>
                        <td>{{ $item->memory }}</td>
                    </tr>
                @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
</div>
