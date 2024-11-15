<!-- Update Modal -->
<form action="{{ route('admin.order.update', $item->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal fade" id="updateModal-{{ $item->id }}" tabindex="-1" aria-labelledby="updateModalLabel-{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white bg-primary">
                    <h5 class="modal-title" id="updateModalLabel-{{ $item->id }}">Cập nhật trạng thái đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add form fields for order update -->
                    <div class="mb-3">
                        <label for="orderName" class="form-label">Đơn hàng</label>
                        <input type="text" class="form-control" name="code" value="{{ $item->code.' - '.$item->fullname }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="orderStatus" class="form-label">Status</label>
                        <select class="form-select" id="orderStatus" name="order_status">
                            <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $item->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>