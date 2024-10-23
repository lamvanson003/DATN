@extends('layout_admin')
@section('title','Danh mục bài viết')
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
          <a href="#">Danh muc</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Danh mục bài viết</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Danh sách danh mục bài viết</h4>
              <a href="{{ route('admin.post_category.create') }}" class="ms-auto">
                <button type="submit" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addRowModal">
                  <i class="fa fa-plus"></i>
                  Thêm
                </button>
              </a>
            </div>
          </div>
          <div class="card-body">
            <!-- Modal -->
            <div class="table-responsive">
              <table id="add-row" class="display table table-hover fix_table">
                <thead>
                  <tr>
                    <th>Hình ảnh</th>
                    <th>Tên danh mục</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Hình ảnh</th>
                    <th>Tên danh mục</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($postCategories as $category)
                    <tr>
                    <td><img class="text-center fix-image" src="{{ asset($category->images) }}" ></td>

                        <td><a href="{{ route('admin.post_category.edit', $category->id) }}">{{ $category->name }}</a></td>
                        <td>{{ $category->slug }}</td>
                        <td>
                          @switch($category->status)
                          @case(\App\Enums\PostCategory\PostCategoryStatus::Active)
                          <span class="badge rounded-pill badge-success">{{ \App\Enums\PostCategory\PostCategoryStatus::getDescription($category->status) }}</span>
                          @break
                          @case(\App\Enums\PostCategory\PostCategoryStatus::Inactive)
                          <span class="badge rounded-pill badge-warning">{{ \App\Enums\PostCategory\PostCategoryStatus::getDescription($category->status) }}</span>
                          @break
                          @case(\App\Enums\PostCategory\PostCategoryStatus::Deleted)
                          <span class="badge rounded-pill badge-danger">{{ \App\Enums\PostCategory\PostCategoryStatus::getDescription($category->status) }}</span>
                          @break
                          @default
                          @endswitch
                        </td>
                        <td>
                          <div class="form-button-action gap-2">
                              <a href="{{ route('admin.post_category.edit', $category->id) }}">
                                  <button type="button" data-bs-toggle="tooltip" title="Chỉnh sửa" class="btn btn-info btn-icon" data-original-title="Chỉnh sửa">
                                      <i class="fa fa-pencil-alt"></i>
                                  </button>
                              </a>

                              <button type="button" class="btn btn-danger btn-icon" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fa fa-trash-alt"></i>
                              </button>
                          </div>                        
                        </td>
                    </tr>
                     <!-- Modal -->
                     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                            <form action="{{ route('admin.post_category.delete', $category->id) }}" method="POST">
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
