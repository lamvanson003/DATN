@extends('layout_admin')
@section('title', 'Mã giảm giá')
@section('content_admin')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">CloudLab</h3>
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
          <a href="#">Mã giảm giá</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">DS Mã giảm giá</h4>
              <a href="{{ route('admin.discount.create') }}" class="ms-auto">
                <button type="submit" class="btn btn-primary btn-round">
                  <i class="fa fa-plus"></i>
                  Thêm
                </button>
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="add-row" class="fontTable display table table-hover fix_table">
                <thead>
                  <tr>
                    <th>Mã</th>
                    <th>Giá trị giảm</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Mô tả</th>
                    <th>Số lượng</th>
                    <th>Loại</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Mã</th>
                    <th>Giá trị giảm</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Mô tả</th>
                    <th>Số lượng</th> 
                    <th>Loại</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach ($discounts as $item)
                      <tr>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->discount_value }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $item->date_start)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $item->date_end)->format('d/m/Y') }}</td>
                        <td>{{ $item->desc }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>
                            <span class="badge rounded-pill 
                                @switch($item->type->value)
                                    @case(\App\Enums\Discount\DiscountType::Percent)
                                        badge-secondary
                                    @break
                                    @case(\App\Enums\Discount\DiscountType::Fixed)
                                        badge-primary
                                    @break
                                    @default
                                        badge-secondary
                                @endswitch">
                                {{ $item->type->description }}
                            </span>
                        </td>
                        <td>
                          <span class="badge rounded-pill 
                            @switch($item->status->value)
                              @case(\App\Enums\Discount\DiscountStatus::Active)
                                badge-success
                              @break
                              @case(\App\Enums\Discount\DiscountStatus::Expired)
                                badge-danger
                              @break
                              @default
                                badge-secondary
                          @endswitch">
                          {{ $item->status->description }}
                          </span>
                        </td>
                        <td>
                          <div class="form-button-action gap-2">
                            <a href="{{ route('admin.discount.edit', $item->id) }}">
                              <button type="button" data-bs-toggle="tooltip" title="Chỉnh sửa" class="btn btn-info btn-icon" data-original-title="Chỉnh sửa">
                                <i class="fa fa-pencil-alt"></i>
                              </button>
                            </a>
                            <button type="button" class="btn btn-danger btn-icon" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                              <i class="fa fa-trash-alt"></i>
                            </button>
                          </div>
                        </td>
                      </tr>

                  
                      <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="deleteModalLabel{{ $item->id }}">Thông báo</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Bạn có chắc chắn muốn xóa mã giảm giá này?
                            </div>
                            <div class="modal-footer">
                              <form action="{{ route('admin.discount.delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE') 
                                <button type="submit" class="btn btn-danger">Xóa</button>
                              </form>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
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
