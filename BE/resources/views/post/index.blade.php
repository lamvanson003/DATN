@extends('layout_admin')

@section('title', 'Danh sách bài viết')

@section('content_admin')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Quản lý bài viết</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="{{ route('admin.dashboard.index') }}">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-home">
          <a href="{{ route('admin.post.index') }}">Bài viết</a>
        </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Danh sách bài viết</h4>
              <a href="{{ route('admin.post.create') }}" class="ms-auto">
                <button type="button" class="btn btn-primary btn-round">
                  <i class="fa fa-plus"></i>
                  Thêm bài viết
                </button>
              </a>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table id="post-table" class="display table table-hover">
                <thead>
                  <tr>
 
                    <th>Tiêu đề</th>
                    <th>Slug</th>
                    <th>Hình ảnh</th>
                    <th>Lượt xem</th>
                    <th>Trạng thái</th>
                    <th>Người tạo</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>

                    <th>Tiêu đề</th>
                    <th>Slug</th>
                    <th>Hình ảnh</th>
                    <th>Lượt xem</th>
                    <th>Trạng thái</th>
                    <th>Người tạo</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $post->images) }}" alt="Hình ảnh" width="50">
                        </td>
                        <td>{{ $post->views }}</td>
                        <td>{{ $post->status == 1 ? 'Hiển thị' : 'Ẩn' }}</td>
                        <td>{{ $post->user->fullname }}</td>
                        <td>
                  
                            @foreach ($post->categories as $category)
                                <span class="badge bg-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>


                    <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Thông báo</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Chuyển trạng thái thành đã xóa
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('admin.post.delete', $post->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
