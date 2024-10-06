@extends('layout_admin')
@section('title','Khách hàng ')
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
          <a href="#">DS admin</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">DS admin</h4>
              <a href="{{ route('admin.admin.create') }}" class="ms-auto">
                <button  type="submit" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addRowModal" >
                  <i class="fa fa-plus"></i>
                  Thêm
                </button>
              </a>
            </div>
          </div>
          <div class="card-body">
            <!-- Modal -->
            <div class="table-responsive">
              <table id="add-row" class="display table table-hover fix_table text-center">
                <thead>
                  <tr>
                    <th>Avatar</th>
                    <th>Tên Amdin</th>
                    <th>Tên hiển thị</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đăng ký</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Avatar</th>
                    <th>Tên Amdin</th>
                    <th>Tên hiển thị</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đăng ký</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($admin as $item)
                  <tr>
                    <td>
                      <img class="text-center fix-image mx-auto" src="{{ asset($item->avatar ?? 'N/A' ) }}" alt="{{ $item->name }}">
                    </td>
                    <td>
                      <a class="fix_size_text" href="{{ route('admin.admin.edit',$item->id) }}">
                        {{ $item->fullname }}
                      </a>
                    </td>
                    <td>
                        {{ $item->username }}
                    </td>
                    <td>
                        {{ $item->email }}
                    </td>
                    <td>
                        {{ $item->phone }}
                    </td>
                    <td>
                        {{ $item->address }}
                    </td>
                    <td>
                        {{ $item->created_at ?? 'N/A' }}
                    </td>
                    <td>
                      @switch($item->status->value)
                      @case(\App\Enums\User\UserStatus::Active)
                      <span class="badge rounded-pill badge-success">{{ $item->status->description }}</span>
                      @break
                      @case(\App\Enums\User\UserStatus::Inactive)
                      <span class="badge rounded-pill badge-warning">{{ $item->status->description }}</span>
                      @break
                      @case(\App\Enums\User\UserStatus::Deleted)
                      <span class="badge rounded-pill badge-danger">{{ $item->status->description }}</span>
                      @break
                      @default
                      @endswitch
                    </td>
                    <td>
                      <div class="form-button-action gap-2">
                        <a href="{{ route('admin.admin.edit',$item->id) }}">
                          <button type="button" data-bs-toggle="tooltip" class="btn btn-info btn-icon" title="Chỉnh sửa">
                            <i class="fa fa-pencil-alt"></i>
                          </button>
                        </a>
                        
                          <button type="button" class="btn btn-danger btn-icon" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-trash-alt"></i>
                          </button>

                      </div>
                    </td>
                  </tr>

                  <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              Chuyển trạng thái thành đã xóa
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('admin.admin.delete',$item->id) }}" method="POST">
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