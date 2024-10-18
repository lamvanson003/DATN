@extends('layout_admin')
@section('title','Thương hiệu')
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
          <a href="#">Brand</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Thuơng hiệu</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">DS thương hiệu</h4>
              <a href="{{ route('admin.brand.create') }}" class="ms-auto">
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
              <table id="add-row" class="display table table-hover fix_table">
                <thead>
                  <tr>
                    <th>Hình ảnh</th>
                    <th>Tên thương hiệu</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Hình ảnh</th>
                    <th>Tên thương hiệu</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($brands as $item)
                    <tr>
                        <td><img class="text-center fix-image" src="{{ asset($item->images) }}" alt="{{ $item->name }}"></td>
                        <td><a href="{{ route('admin.brand.edit',$item->id) }}">{{ $item->name }}</a></td> 
                        <td>{{ $item->slug}}</td> 
                        <td>
                          @switch($item->status->value)
                          @case(\App\Enums\Brand\BrandStatus::Active)
                          <span class="badge rounded-pill badge-success">{{ $item->status->description }}</span>
                          @break
                          @case(\App\Enums\Brand\BrandStatus::Inactive)
                          <span class="badge rounded-pill badge-warning">{{ $item->status->description }}</span>
                          @break
                          @case(\App\Enums\Brand\BrandStatus::Deleted)
                          <span class="badge rounded-pill badge-danger">{{ $item->status->description }}</span>
                          @break
                          @default
                          @endswitch
                        </td>
                        <td>
                          <div class="form-button-action gap-2">
                              <a href="{{ route('admin.brand.edit', $item->id) }}">
                                  <button type="button" data-bs-toggle="tooltip" title="Chỉnh sửa" class="btn btn-info btn-icon" data-original-title="Chỉnh sửa">
                                      <i class="fa fa-pencil-alt"></i>
                                  </button>
                              </a>

                              <button type="button" class="btn btn-danger btn-icon" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                                <i class="fa fa-trash-alt"></i>
                              </button>
                          </div>                        
                        </td>
                    </tr>
                     <!-- Modal -->
                     <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel{{ $item->id }}">Thông báo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              Chuyển trạng thái <strong>{{ $item->name }}</strong> thành đã xóa
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('admin.brand.delete',$item->id) }}" method="POST">
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