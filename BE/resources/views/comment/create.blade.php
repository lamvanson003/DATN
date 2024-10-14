@extends('layout_admin')
@section('title', 'Thêm Bình Luận')
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
                    <a href="{{ route('admin.comment.index') }}">Bình luận</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Thêm Bình Luận</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.comment.store') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h3 class="mb-0 strong text-center">Thông Tin Bình Luận</h3>
                            </div>
                            <div class="row card-body">
                                <!-- Nội dung bình luận -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Nội dung<span style="color: red">*</span>:</label>
                                        <textarea required class="form-control" name="content" placeholder="Nhập nội dung bình luận" rows="4"></textarea>
                                    </div>
                                </div>

                                <!-- Đánh giá -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Đánh giá<span style="color: red">*</span>:</label>
                                        <select required class="form-select" name="rating">
                                            <option value="5">5 ⭐</option>
                                            <option value="4">4 ⭐</option>
                                            <option value="3">3 ⭐</option>
                                            <option value="2">2 ⭐</option>
                                            <option value="1">1 ⭐</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Chọn Người Dùng -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Người Dùng<span style="color: red">*</span>:</label>
                                        <select required class="form-select" name="user_id">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-3">
                                        <label class="control-label">Sản Phẩm<span style="color: red">*</span>:</label>
                                        <select required class="form-select" name="product_variant_id">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->id }}</option>
                                            @endforeach
                                        </select>
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
                                <select required class="form-select" name="status">
                                    @foreach (\App\Enums\Comment\CommentStatus::asSelectArray() as $key => $value)
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
