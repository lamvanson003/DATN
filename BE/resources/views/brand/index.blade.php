@extends('layout_admin')
@section('title','Thương hiệu')
@section('content_admin')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">DataTables.Net</h3>
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
              <h4 class="card-title">DS danh mục</h4>
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
                    <th>Tên danh mục</th>
                    <th>Hình ảnh</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Tên danh mục</th>
                    <th>Hình ảnh</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th style="width: 10%">Hành động</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($brands as $item)
                    <tr>
                        <td>{{ $item->name}}</td> 
                        <td><img class="text-center fix-image" src="{{ asset($item->images) }}" alt="{{ $item->name }}"></td>
                        <td>{{ $item->slug}}</td> 
                        <td>{{ $item->status}}</td> 
                        <td>
                          <div class="form-button-action">
                              <a href="{{ route('admin.brand.edit', $item->id) }}">
                                  <button type="button" data-bs-toggle="tooltip" title="Chỉnh sửa" class="btn btn-info btn-icon" data-original-title="Chỉnh sửa">
                                      <i class="fa fa-pencil-alt"></i>
                                  </button>
                              </a>
                          </div>                        
                        </td>
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