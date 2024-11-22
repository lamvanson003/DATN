@extends('layout_admin')
@section('title','Thông báo')
@section('content_admin')

@push('libs-css')
<link rel="stylesheet" href="{{ asset('/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/select2/css/select2-bootstrap-5-theme.min.css') }}">
@endpush
<style>

    .select2-container .select2-selection--multiple {
        height: auto !important; 
        min-height: 38px; 
        max-height: 150px; 
        overflow-y: auto; 
        border: 1px solid #ced4da; 
        border-radius: 0.25rem;
    }

    .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff; 
        color: #fff; 
        border: none;
        padding: 0.25rem 0.5rem;
        margin-right: 5px;
        border-radius: 0.25rem;
    }

    .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__choice:not(:first-child) {
        margin-left: 5px;
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
                                        <select id="types" class="notification-type form-action form-select required" name="types">
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
                                <div id="notification-customer-select" class="mb-3" style="display: none;">
                                    <label for="user_id" class="form-label"><i class="ti ti-user-plus"></i> Khách hàng</label>
                                    <select name="user_id[]" 
                                            id="user_id" 
                                            class="select2-bs5-ajax form-select"
                                            multiple="multiple" 
                                            data-url="{{ route('admin.search.select.customer') }}">
                                    </select>
                                </div>

                                <!-- Tiêu đề -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="title" class="control-label">
                                            {{ __('Tiêu đề') }} <span style="color: red">*</span>:
                                        </label>
                                        <input type="text" id="title"  class="form-control required" name="title" placeholder="Nhập tiêu đề">
                                    </div>
                                </div>

                                <!-- Nội dung -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="message" class="control-label">
                                            {{ __('Nội dung') }} <span style="color: red">*</span>:
                                        </label>
                                        <textarea id="message"  class="form-control required" name="message" placeholder="Nhập nội dung"></textarea>
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
                            <div class="card-header">Loại</div>
                            <div class="card-body p-2">
                                <select required class="form-select" name="type">
                                    @foreach ($type as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Đường dẫn tĩnh</div>
                            <div class="card-body p-2">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="url" placeholder="Url thông báo">
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </form>    
        </div>
    </div>   
</div>
@push('libs-js')
    <script src="{{ asset('/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/select2/js/i18n/vi.js') }}"></script>
@endpush

@push('custom-js')
@include('notification.scripts.script')
@endpush
@endsection
