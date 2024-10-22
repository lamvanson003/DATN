@extends('layout_admin')

@section('title', 'Thêm slider')

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
                    <a href="{{ route('admin.slider.index') }}">Sản phẩm</a>
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
            <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông Tin Slider</h3>
                            </div>
                            <div class="card-body">
                                <!-- Name and Slug in the same row -->
                                <div class="col-md-12 col-sm-12 d-flex mb-3">
                                    <div class="me-2 flex-grow-1">
                                        <label class="control-label">Tên slider<span style="color: red">*</span>:</label>
                                        <input type="text" required class="form-control" name="name" placeholder="VD: Khuyến mãi tháng 11">
                                    </div>
                                </div>
                        
                                <!-- Description -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Mô tả chi tiết:</label>
                                        <textarea class="form-control" name="desc" rows="4" placeholder="Mô tả về slider"></textarea>
                                    </div>
                                </div>
                        
                                <!-- Image-item -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Hình ảnh chi tiết:</label>
                                        <div class="wrap">
                                            <div class="dandev-reviews" >
                                                <div class="form_upload">
                                                    <label class="dandev_insert_attach">
                                                        <span  style=" background: url('{{ asset('images/camera.png') }}') no-repeat;">Đính kèm ảnh</span>
                                                    </label>
                                                </div>
                                                <div class="list_attach">
                                                    <ul class="dandev_attach_view">
                                    
                                                    </ul>
                                                    <span class="dandev_insert_attach"><i class="dandev-plus">+</i></span>
                                                </div>
                                            </div>
                                        </div>
                                        
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
                                <input required type="file" id="fileInput" name="image" class="d-none" accept="images/*">
                                <input type="hidden" name="image" id="imageUrl" value="">
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
