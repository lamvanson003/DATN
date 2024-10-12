@extends('layout_admin')
@section('title','Image Items')
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
              <a href="">{{ $product_image_item->name }}</a>
            </li>
          </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.product.item.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">   
                <input type="hidden" name="id" value="{{ $product_image_item->id }}">   
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông tin Items</h3>
                            </div>
                            <div class="row card-body">
                                <!-- name -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3 ">
                                        <label class="control-label">Tên Items<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="name" value={{ $product_image_item->name }} placeholder="VD: Item-1">
                                    </div>
                                </div>

                                <!-- posittion -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Vị trí sắp xếp:</label>
                                        <input type="number" required class="form-control" name="posittion" value="{{ $product_image_item->posittion }}" placeholder="VD: 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2 gap-2">
                                <button type="submit" class="btn btn-primary p-1-2" title="Thêm">
                                    Cập nhật
                                </button>
                            </div>
                        </div>
            
                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                                <select required class="form-select" name="status">
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $key }}" {{ $key == $product_image_item->status->value ? 'selected' : '' }}> {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Ảnh đại diện</div>
                            <div class="card-body p-2">
                                <input type="file" id="fileInput" name="new_image" class="d-none" accept="image/*">
                                <input type="hidden" name="old_image" value="{{ $product_image_item->images }}">
                                <div class="image-container" style="cursor: pointer;">
                                    <img id="imagePreview" src="{{ asset($product_image_item->images ?? 'images/default-image.png') }}" alt="Ảnh đại diện" style="max-width: 100%;">
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                function loadFile(event) {
                                    const imagePreview = document.getElementById('imagePreview');
                                    const file = event.target.files[0];

                                    if (file) {
                                        imagePreview.src = URL.createObjectURL(file);
                                    } else {
                                        imagePreview.src = "{{ asset($product_image_item->images ?? 'images/default-image.png') }}";
                                    }
                                }
                                document.querySelector('.image-container').addEventListener('click', function() {
                                    document.getElementById('fileInput').click();
                                });

                                document.getElementById('fileInput').addEventListener('change', loadFile);
                            });
                        </script>
                    </div>                    
                </div>
            </form>    
        </div>
    </div>   
</div>
@endsection