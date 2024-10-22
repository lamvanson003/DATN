@extends('layout_admin')

@section('title', 'Slider')

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
          <a href="{{ route('admin.slider.index') }}">Sản phẩm</a>
        </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Danh sách sản phẩm</h4>
              <a href="{{ route('admin.slider.create') }}" class="ms-auto">
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
                    <th>Ảnh đại diện</th>
                    <th>Sản phẩm</th>
                    <th>Mô tả</th>
                    <th >Hình ảnh </th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Ảnh đại diện</th>
                    <th>Sản phẩm</th>
                    <th>Mô tả</th>
                    <th >Hình ảnh </th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($sliders as $item)
                    <tr>
                      <td><img class="text-center fix-image" src="{{ asset($item->image) }}" alt="{{ $item->name }}"></td>
                      <td><a href="{{ route('admin.slider.edit', $item->id) }}">{{ $item->name }}</a></td> 
                      <td>{{ $item->desc }}</td> 
                      <td>
                        <div class="row">
                            <div class="image-items d-flex align-items-center gap-2 justify-content-center mb-3">
                              @foreach ($item->slider_items as $imageItem)
                                <img class="text-center fix-image" src="{{ asset($imageItem->images) }}" alt="{{ $item->name }}">
                              @endforeach
                            </div>
                            <a href="{{ route('admin.product.item.index',$item->id) }}">DS hình ảnh</a>
                        </div>                  
                    </td>
                      <td>
                        @switch($item->status)
                            @case(\App\Enums\Slider\SliderStatus::Active)
                                <span class="badge rounded-pill badge-success">{{ \App\Enums\Slider\SliderStatus::getDescription($item->status) }}</span>
                            @break
                            @case(\App\Enums\Slider\SliderStatus::Inactive)
                                <span class="badge rounded-pill badge-warning">{{ \App\Enums\Slider\SliderStatus::getDescription($item->status) }}</span>
                            @break
                            @case(\App\Enums\Slider\SliderStatus::Deleted)
                                <span class="badge rounded-pill badge-danger">{{ \App\Enums\Slider\SliderStatus::getDescription($item->status) }}</span>
                            @break
                            @default
                                <span class="badge rounded-pill badge-secondary">Không xác định</span>
                        @endswitch
                    </td>
                    <td>
                        <div class="form-button-action gap-2">
                          <a href="{{ route('admin.slider.edit', $item->id) }}">
                              <button type="button" data-bs-toggle="tooltip" title="Chỉnh sửa" class="btn btn-info btn-icon" data-original-title="Chỉnh sửa">
                                  <i class="fa fa-pencil-alt"></i>
                              </button>
                          </a>
                          <button type="button" data-bs-toggle="modal" title="Chỉnh sửa" class="btn btn-danger btn-icon" data-bs-target="#exampleModal{{ $item->id }}">
                            <i class="fa fa-trash-alt"></i>
                          </button>
                      </div> 
                    </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              Chuyển trạng thái <strong>{{ $item->name }}</strong> thành đã xóa
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('admin.slider.delete',$item->id) }}" method="POST">
                              @csrf
                              <input type="hidden" name="_method" value="DELETE">
                              <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
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
