@extends('layout_admin')
@section('title','Danh mục')
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
          <a href="#">Category</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">DS danh mục</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">DS danh mục</h4>
              <a href="{{ route('admin.category.create') }}" class="ms-auto">
                <button type="submit" class="btn btn-primary btn-round">
                  <i class="fa fa-plus"></i> Thêm
                </button>
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="add-row" class="display table table-hover text-center">
                <thead>
                  <tr>
                    <th>Hình ảnh</th>
                    <th>Tên danh mục</th>
                    <th>Đường dẫn</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($category as $item)
                  <tr>
                    <td><img class="fix-image mx-auto" src="{{ asset($item->images) }}" alt="{{ $item->name }}"></td>
                    <td><a href="{{ route('admin.category.edit',$item->id) }}">{{ $item->name }}</a></td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                      @switch($item->status->value)
                        @case(\App\Enums\Category\CategoryStatus::Active)
                          <span class="badge rounded-pill badge-success">{{ $item->status->description }}</span>
                        @break
                        @case(\App\Enums\Category\CategoryStatus::Inactive)
                          <span class="badge rounded-pill badge-warning">{{ $item->status->description }}</span>
                        @break
                        @case(\App\Enums\Category\CategoryStatus::Deleted)
                          <span class="badge rounded-pill badge-danger">{{ $item->status->description }}</span>
                        @break
                      @endswitch
                    </td>
                    <td>
                      <div class="form-button-action gap-2">
                        <a href="{{ route('admin.category.edit',$item->id) }}">
                          <button type="button" class="btn btn-info btn-icon" title="Chỉnh sửa">
                            <i class="fa fa-pencil-alt"></i>
                          </button>
                        </a>
                        <button type="button" class="btn btn-danger btn-icon" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                          <i class="fa fa-trash-alt"></i>
                        </button>
                      </div>
                    </td>
                  </tr>

                  <!-- Modal xóa riêng cho mỗi danh mục -->
                  <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Xác nhận xóa danh mục</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Chuyển trạng thái <strong>{{ $item->name }}</strong> thành đã xóa.
                        </div>
                        <div class="modal-footer">
                          <form action="{{ route('admin.category.delete', $item->id) }}" method="POST">
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