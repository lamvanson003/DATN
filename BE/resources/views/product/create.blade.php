@extends('layout_admin')

@section('title', 'Sản phẩm')

@section('content_admin')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">DataTables</h3>
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
                    <a href="{{ route('admin.product.index') }}">Sản phẩm</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Thêm sản phẩm</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông tin sản phẩm và Thông tin Biến thể</h3>
                            </div>
                            <div class="card-body"> 
                                <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <li class="nav-item">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                            Thông tin sản phẩm
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                                            Thông tin biến thể
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                        @include('product.form.createProduct')
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                        @include('product.form.createProductVariant')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Đăng</div>
                            <div class="card-body p-2">
                                <button type="submit" class="btn btn-primary p-1-2" title="Thêm">
                                    Thêm
                                </button>
                            </div>
                        </div>
            
                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                                <select class="form-select" name="status">
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Ảnh đại diện <span style="color: red">*</span></div>
                            <div class="card-body p-2">
                                <input required type="file" id="fileInput" name="images" class="d-none" accept="image/*">
                                <input type="hidden" name="images" id="imageUrl" value="">
                                <div class="image-container" style="cursor: pointer; display: inline-block;">
                                    <img id="imagePreview" src="{{ asset('/images/default-image.png') }}" alt="Ảnh đại diện" style="max-width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">Thêm màu sắc mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.color.create') }}" method="POST">
                    @csrf
                    <!-- Tên màu sắc -->
                    <div class="mb-3">
                        <label class="form-label" for="colorName">Tên màu sắc <span class="text-danger">*</span>:</label>
                        <input type="text" id="colorName" required class="form-control" name="name" placeholder="VD: Midnight (Đen)">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Thêm màu</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.dandev_insert_attach').click(function() {
        if ($('.list_attach').hasClass('show-btn') === false) {
            $('.list_attach').addClass('show-btn');
        }
        var _lastimg = jQuery('.dandev_attach_view li').last().find('input[type="file"]').val();

        if (_lastimg != '') {
            var d = new Date();
            var _time = d.getTime();
            var _html = '<li id="li_files_' + _time + '" class="li_file_hide">';
            _html += '<div class="img-wrap">';
            _html += '<span class="close" onclick="DelImg(this)">×</span>';
            _html += ' <div class="img-wrap-box"></div>';
            _html += '</div>';
            _html += '<div class="' + _time + '">';
            _html += '<input type="file" name="image_items[]" class="hidden"  onchange="uploadImg(this)" id="files_' + _time + '"   />';
            _html += '</div>';
            _html += '</li>';
            jQuery('.dandev_attach_view').append(_html);
            jQuery('.dandev_attach_view li').last().find('input[type="file"]').click();
        } else {
            if (_lastimg == '') {
                jQuery('.dandev_attach_view li').last().find('input[type="file"]').click();
            } else {
                if ($('.list_attach').hasClass('show-btn') === true) {
                    $('.list_attach').removeClass('show-btn');
                }
            }
        }
    });

    function uploadImg(el) {
        var file_data = $(el).prop('files')[0];
        var type = file_data.type;
        var fileToLoad = file_data;

        var fileReader = new FileReader();

        fileReader.onload = function(fileLoadedEvent) {
            var srcData = fileLoadedEvent.target.result;

            var newImage = document.createElement('img');
            newImage.src = srcData;
            var _li = $(el).closest('li');
            if (_li.hasClass('li_file_hide')) {
                _li.removeClass('li_file_hide');
            }
            _li.find('.img-wrap-box').append(newImage.outerHTML);


        }
        fileReader.readAsDataURL(fileToLoad);

    }

    function DelImg(el) {
        jQuery(el).closest('li').remove();

    }
</script>

@endsection
