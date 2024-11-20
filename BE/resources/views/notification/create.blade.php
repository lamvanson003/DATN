@extends('layout_admin')

@section('title','Thông báo')

@section('content_admin')
@include('notification.scripts.script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<style>
   /* Tùy chỉnh cho select2 */
    #user_id {
        width: 100% !important; /* Đảm bảo rằng select2 chiếm toàn bộ chiều rộng */
    }

    .select2-container {
        width: 100% !important; /* Đảm bảo container của select2 không bị giới hạn */
    }

    .select2-dropdown {
        max-height: 300px !important; /* Điều chỉnh chiều cao tối đa của dropdown */
        overflow-y: auto !important; /* Cho phép cuộn dọc nếu cần thiết */
        border-radius: 4px; /* Bo góc dropdown */
        border: 1px solid #ccc; /* Thêm viền cho dropdown */
    }

    .select2-selection {
        height: auto !important; /* Điều chỉnh chiều cao của ô chọn */
        min-height: 40px !important; /* Tạo khoảng cách cho nội dung */
    }

    .select2-selection__rendered {
        padding: 6px 12px !important; /* Tùy chỉnh khoảng cách bên trong */
    }

    /* Tùy chỉnh khi select2 có nhiều lựa chọn */
    .select2-selection--multiple {
        min-height: 40px !important; /* Tăng chiều cao cho select2 với lựa chọn nhiều */
    }

    /* Tùy chỉnh khi đang chọn */
    .select2-selection__choice {
        background-color: #007bff !important; /* Màu nền của lựa chọn */
        color: white !important; /* Màu chữ */
        border-radius: 3px;
        margin: 2px;
    }

    .select2-search__field {
        padding: 5px 10px !important; /* Tùy chỉnh khoảng cách cho ô tìm kiếm */
    }

</style>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">CloubLab</h3>
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
                    <a href="{{ route('admin.notification.index') }}">DS Thông báo</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Thêm Thông báo</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.notification.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông tin Thông báo</h3>
                            </div>
                            <div class="row card-body">
                                <!-- Đối tượng -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <i class="fa fa-user"></i>
                                        <label for="types">{{ __('Đối tượng') }}</label>
                                        <select id="types" class="notification-type form-action form-select" name="types" required>
                                            <option value="">{{ __('Chọn đối tượng') }}</option>
                                            @foreach ($types as $key => $value)
                                                <option value="{{ $key }}">
                                                    {{ \App\Enums\Notification\NotificationTypes::getDescription($key) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Loại thông báo -->
                                <div id="notification-option-select" class="col-12" style="display: none;">
                                    <div class="mb-3">
                                        <i class="ti ti-moped"></i>
                                        <label for="option">{{ __('Loại') }}</label>
                                        <select id="option" class="notification-option-select-value form-action form-select" name="option">
                                            <option value="100" title="{{ __('Chọn loại thông báo') }}" selected>
                                                {{ __('Chọn loại thông báo') }}
                                            </option>
                                            @foreach ($options as $key => $value)
                                                <option value="{{ $key }}">
                                                    {{ \App\Enums\Notification\NotificationOption::getDescription($key) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Khách hàng -->
                                <div id="notification-customer-select" class="col-12" style="display: none;">
                                    <div class="mb-3">
                                        <i class="ti ti-user-plus"></i>
                                        <label for="user_id">{{ __('Khách hàng') }}</label>
                                        <br>
                                        <select
                                            name="user_id[]"
                                            id="user_id"
                                            class="js-example-basic-single form-action form-select"
                                            data-url="{{ route('admin.search.select.customer') }}"
                                            multiple="multiple">
                                        </select>
                                    </div>
                                </div>

                                <!-- Tiêu đề -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="title" class="control-label">
                                            {{ __('Tiêu đề') }} <span style="color: red">*</span>:
                                        </label>
                                        <input type="text" id="title" required class="form-control" name="title" placeholder="Nhập tiêu đề">
                                    </div>
                                </div>

                                <!-- Nội dung -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="message" class="control-label">
                                            {{ __('Nội dung') }} <span style="color: red">*</span>:
                                        </label>
                                        <textarea id="message" required class="form-control" name="message" placeholder="Nhập nội dung"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">Hành động</div>
                            <div class="card-body p-2">
                                <button type="submit" class="btn btn-primary p-1-2" title="Thêm">
                                    Thêm
                                </button>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Trạng thái</div>
                            <div class="card-body p-2">
                                <select required class="form-select" name="status">
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Loại</div>
                            <div class="card-body p-2">
                                <select required class="form-select" name="type">
                                    @foreach ($type as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>                    
                </div>
            </form>    
        </div>
    </div>   
</div>

@endsection
