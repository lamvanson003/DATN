@extends('layout_admin')

@section('title', 'Bảng màu')

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
          <a href="#">DS bảng màu</a>
        </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">DS bảng màu</h4>
              <a href="{{ route('admin.color.create')}}" class="ms-auto">
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
                    <th>DS màu</th>
                    <th>Ảnh minh họa</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>DS màu</th>
                    <th>Ảnh minh họa</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($color as $item)
                    <tr>
                      <td><a href="{{ route('admin.color.edit', $item->id) }}">{{ $item->name }}</a></td> 
                      <td><img class="text-center fix-image" src="{{ asset($item->images) }}" alt=""></td> 
                      <td>
                        @switch($item->status->value)
                          @case(\App\Enums\Status::Active)
                          <span class="badge rounded-pill badge-success">{{ $item->status->description }}</span>
                          @break
                          @case(\App\Enums\Status::Inactive)
                          <span class="badge rounded-pill badge-warning">{{ $item->status->description }}</span>
                          @break
                          @default
                          <span class="badge rounded-pill badge-primary">N/A</span>
                          @break
                        @endswitch
                      </td>
                      <td>
                        <div class="form-button-action gap-2">
                          <a href="{{ route('admin.color.edit', $item->id) }}">
                            <button type="button" data-bs-toggle="tooltip" title="Chỉnh sửa" class="btn btn-info btn-icon">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                          </a>

                          <button type="button" class="btn btn-danger btn-icon" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                            <i class="fa fa-trash-alt"></i>
                          </button>
                        </div>                        
                      </td>
                    </tr>

                    <!-- Modal Xóa sản phẩm -->
                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              Xóa dữ liệu này khỏi dữ liệu hệ thống?
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('admin.color.delete', $item->id) }}" method="POST">
                              @csrf
                              <input type="hidden" name="_method" value="DELETE">
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
