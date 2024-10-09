@extends('layout_admin')
@section('title','Profile_Admin')
@section('content_admin')
<div class="container">
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.admin.update',$admin->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{$admin->id}}">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Chỉnh sửa thông tin</h3>
                            </div>
                            <div class="row card-body">
                                <!-- name -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Tên <span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control text-capitalize" name="name" value="{{ $admin->name }}" placeholder="Nhập tên">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Email<span style="color: red">*</span>:</label>
                                        <input type="email" required class="form-control text-capitalize" name="slug" value="{{ $admin->email }}" placeholder="Nhập email">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2 gap-2">
                                <button type="submit" class="btn btn-primary p-1-2" title="Sửa">
                                    Sửa
                                </button>
                                <button type="submit" class="btn btn-primary p-1-2" title="Xóa">
                                    Xóa
                                </button>
                            </div>
                        </div>
            
                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                                <select class="form-select" name="status">
                                    @foreach ($status as $key => $value)
                                        <option {{ $key == $admin->status->value ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>                                
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Ảnh đại diện</div>
                            <div class="card-body p-2">
                                <!-- Input ẩn để chọn file -->
                                <input type="file" id="fileInput" name="new_image" class="d-none" accept="image/*">
                                <!-- Input ẩn để lưu URL hình ảnh ban đầu -->
                                <input type="hidden" name="old_image" value="{{ $admin->images }}">
                                <div class="image-container" style="cursor: pointer;">
                                    <!-- Hình ảnh đại diện ban đầu -->
                                    <img id="imagePreview" 
                                         src="{{ asset($admin->images ?? 'images/default-image.png') }}" 
                                         alt="Ảnh đại diện" style="max-width: 100%;">
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
                                        imagePreview.src = "{{ asset($admin->images ?? 'images/default-image.png') }}";
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
            <form action="{{ route('admin.admin.delete',$admin->id) }}" method="POST">
              @csrf
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-danger">Xóa</button>
            </form>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
@endsection