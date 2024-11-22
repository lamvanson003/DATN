@extends('layout_admin')

@section('title', 'Sản phẩm')

@section('content_admin')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">CloudLab.Net</h3>
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
          <a href="{{ route('admin.notification.index') }}">Thông báo</a>
        </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Danh sách Thông báo</h4>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table id="add-row" class="fontTable display table table-hover fix_table">
                <thead>
                  <tr>
                    <th>Tiêu đề</th>
                    <th>Khách hàng</th>
                    <th>Admin</th>
                    <th>Nội dung</th>
                    <th>Trạng thái</th>
                    <th>Loại </th>
                    <th>Ngày tạo </th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                 
                  @foreach ($notification as $item)
                    <tr>
                      <td><a href="">{{ $item->title }}</a></td>
                      <td>
                        @if ($item->user->roles == 2)
                            <a href="{{ route('admin.user.edit',$item->user->id) }}">
                              {{ $item->user->fullname }}
                            </a>                                                        
                        @endif
                        
                      </td> 
                      <td>
                        @if ($item->user->roles == 1)
                            <a href="{{ route('admin.admin.edit',$item->user->id) }}">
                              {{ $item->user->fullname }}
                            </a>
                        @endif
                      </td> 
                      <td>{{ $item->message }}</td> 
                        <td>
                            @switch($item->read_at)
                                @case(\App\Enums\Notification\NotificationReadAt::Read)
                                    <span class="badge rounded-pill badge-success">{{ \App\Enums\Notification\NotificationReadAt::getDescription($item->read_at) }}</span>
                                @break
                                @case(\App\Enums\Notification\NotificationReadAt::Not_Read)
                                    <span class="badge rounded-pill badge-secondary">{{ \App\Enums\Notification\NotificationReadAt::getDescription($item->read_at) }}</span>
                                @break
                                @default
                                    <span class="badge rounded-pill badge-danger">Không xác định</span>
                            @endswitch
                        </td>
                        <td>
                            @switch($item->type)
                                @case(\App\Enums\Notification\NotificationType::ORDER)
                                    <span class="badge rounded-pill badge-success">{{ \App\Enums\Notification\NotificationType::getDescription($item->type) }}</span>
                                @break
                                @case(\App\Enums\Notification\NotificationType::VOUCHER)
                                    <span class="badge rounded-pill badge-danger">{{ \App\Enums\Notification\NotificationType::getDescription($item->type) }}</span>
                                @break
                                @default
                                    <span class="badge rounded-pill badge-primary">Không xác định</span>
                            @endswitch
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                          <button type="button" data-bs-toggle="modal" title="Chỉnh sửa" class="btn btn-danger btn-icon" data-bs-target="#exampleModal{{ $item->id }}">
                            <i class="fa fa-trash-alt"></i>
                          </button>
                      </td>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Xóa khỏi thông báo khỏi dữ liệu hệ thống ?
                            </div>
                            <div class="modal-footer">
                              <form action="{{ route('admin.notification.delete',$item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Xóa</button>
                              </form>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </tr>
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
