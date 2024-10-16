@extends('layout_admin')
@section('title', 'Bình luận')
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
          <a href="#">Bình luận</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">DS bình luận</h4>
              <a href="{{ route('admin.comment.create') }}" class="ms-auto">
                <button type="submit" class="btn btn-primary btn-round">
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
                    <th>Hình ảnh sản phẩm</th>
                    <th>Nội dung</th>
                    <th>Người dùng</th>
                    <th>Đánh giá</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Hình ảnh sản phẩm</th>
                    <th>Nội dung</th>
                    <th>Người dùng</th>
                    <th>Đánh giá</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($comments as $item)
                    <tr>
                      <td>
                        <img class="text-center fix-image" src="{{ asset($item->productVariant->images) }}" alt="{{ $item->productVariant->name }}">
                      </td>
                      <td>{{ $item->content }}</td>
                      <td>{{ $item->user->fullname }}</td>
                      <td>{{ $item->rating }} ⭐</td>
                      <td>
                        <span class="badge rounded-pill 
                          @switch($item->status)
                            @case(\App\Enums\Comment\CommentStatus::Approved)
                              badge-success
                            @break
                            @case(\App\Enums\Comment\CommentStatus::Pending)
                              badge-warning
                            @break
                            @case(\App\Enums\Comment\CommentStatus::Rejected)
                              badge-danger
                            @break
                            @case(\App\Enums\Comment\CommentStatus::Spam)
                              badge-secondary
                            @break
                            @default
                              badge-secondary
                        @endswitch">
                          {{ \App\Enums\Comment\CommentStatus::getDescription($item->status) }}
                        </span>
                      </td>
                      <td>
                        <div class="form-button-action gap-2">
                          <a href="{{ route('admin.comment.edit', $item->id) }}">
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

                    <!-- Modal xác nhận xóa -->
                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModalLabel{{ $item->id }}">Thông báo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Bạn có chắc chắn muốn xóa bình luận này?
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('admin.comment.delete', $item->id) }}" method="POST">
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
